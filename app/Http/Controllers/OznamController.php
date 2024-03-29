<?php

namespace App\Http\Controllers;
use App\Models\Komentar;
use App\Models\Reakcia;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Models\Oznam;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class OznamController extends Controller
{
    /**
     * vráti pohľad oznam.oznamShow kde sa pošle aktuálny oznam a v pohľade sa zobrazia informácie o ňom.
     *
     * @param mixed $id id daného oznamu
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id) {
        $oznam = Oznam::find($id);

        return view('oznam.oznamShow' , compact('oznam'));
    }


    /**
     * vráti pohľad oznam.oznam, v ktorom sa zobrazujú všetky oznamy vo forme zoznamu pričom sa ich zobrazí len určitý počet. Ďalšie oznamy sa načítavajú pri stláčaní tlačidla pre načítanie ďalších oznamov.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {

        $oznam = Oznam::orderBy('created_at', 'desc')->paginate(6);
        $oznamCount = Oznam::all()->count();

        return view('oznam.oznam', compact('oznam', 'oznamCount'));
    }


    /**
     * slúži na vypísanie ďalších oznamov po stlačení tlačidla.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function loadMoreOznam()
    {

        $oznam = Oznam::orderBy('created_at', 'desc')->paginate(6);

        return view('oznam.ajax-oznam', compact('oznam'));
    }

    /**
     * podobne ako pri oznamoch, aj tu metóda slúži na vypísanie ďalších komentárov
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function loadMoreComments(Request $request, $id)
    {
        $page = $request->input('page', 1);
        $oznam = Oznam::findOrFail($id);
        $comments = $oznam->komentare()->orderBy('created_at', 'desc')->paginate(5, ['*'], 'page', $page);

        return view('oznam.ajax-comments', compact('comments'));
    }

    /**
     * uloží nový oznam s jeho názvom, obsahom prípadne obrázkom. Pred uložením do databázy sa vstupy z formulára zvalidujú podľa určených pravidiel.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'nazov' => 'required|min:4|max:255',
            'obsah' => 'required|max:20000',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        $user = Auth::user();
        $imagePath = null;

        if ($request->hasFile('image')) {

            $imagePath = $request->file('image')->store('uploads', 'public');

        }

        $oznam = new Oznam([
            'nazov' => $request->input('nazov'),
            'obsah' => $request->input('obsah'),
            'autor' => $user->id,

        ]);

        $oznam->image_path = $imagePath;


        $oznam->save();

        return redirect()->route('oznam.oznam')->with('success', 'Oznam created');
    }


    /**
     * po zvalidovaní vstupov sa nový komentár pridá do databázy.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeComment(Request $request)
    {
//        dd($request);
        $request->validate([

            'obsah' => 'required|max:255',
        ]);


        $user = Auth::user();


        $komentar = new Komentar([
            'id_prispevku' => $request->id,
            'obsah' => $request->input('obsah'),
            'autor' => $user->id,
        ]);


        $komentar->save();

        return back()->with('success', 'Komentar created');
    }

    /**
     * na základe id komentára sa komentár vyhľadá a pokiaľ má daný používateľ práva, može komentár z databázy zmazať.
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyComment($id)
    {

        $komentar = Komentar::find($id);
        if($komentar->user->id == auth()->user()->id || auth()->user()->hasAnyRole(['admin', 'superuser'])) {
            $komentar->delete();
        }


        return back()->with('success', 'Komentar deleted');
    }

    /**
     * na základe id komentára sa vyhľadá a s požadovanými právami môže byť komentár upravený.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateComment(Request $request, $id) {
        $komentar = Komentar::findOrFail($id);


        $request->validate([
            'editedObsah' => 'required|max:255',
        ]);

//        dd($komentar->user->id);
        if($komentar->user->id == auth()->user()->id || auth()->user()->hasAnyRole(['admin', 'superuser'])) {
            $komentar->obsah = $request->input('editedObsah');
            $komentar->save();
        }
        return redirect()->back()->with('success', 'Comment updated successfully');
    }


    /**
     * ku konkrétnemu príspevku sa vytvorí reakciu konkrétneho používateľa. V prípade že záznam existuje, zmení sa jeho hodnota. Hodnoty sa menia v reálnom čase a asynchronne pomocou ajax.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function likeOznam($id) {
        $oznam = Oznam::find($id);

        $userReaction = $oznam->reakcie->where('autor_reakcie', auth()->user()->id)->first();
        if ($userReaction) {
            $userReaction->reakcia = !$userReaction->reakcia;
            $userReaction->save();
        } else {
            $reakcia = Reakcia::create([
                'id_prispevku' => $oznam->id,
                'autor_reakcie' => auth()->user()->id,
                'reakcia' => true,
            ]);
            $reakcia->save();
            $userReaction = $reakcia;
        }



        $liked = ($userReaction && $userReaction->reakcia) ? true : false;
        $likeCount = Reakcia::where('id_prispevku', $oznam->id)->where('reakcia', true)->count();


        return response()->json(['success' => 'Reakcia created', 'liked' => $liked, 'likeCount' => $likeCount,]);
    }


    /**
     * slúži na úpravu oznamu. Po zvalidovaní vstupov z formuláru a overením práv sa na základe vstupov zmenia hodnoty.
     *
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'nazov' => 'required|min:4|max:255',
            'obsah' => 'required|max:20000',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $oznam = Oznam::find($id);
        if($oznam->user->id == auth()->user()->id || auth()->user()->hasAnyRole(['admin', 'superuser'])) {
            $oznam->update([
                'nazov' => $request->input('nazov'),
                'obsah' => $request->input('obsah'),
            ]);

            if ($request->input('delete_image') == 1 && $oznam->image_path) {
                Storage::disk('public')->delete($oznam->image_path);

                $oznam->image_path = null;

            }

            if ($request->hasFile('image')) {

                if ($oznam->image_path) {
                    Storage::disk('public')->delete($oznam->image_path);
                }

                $imagePath = $request->file('image')->store('uploads', 'public');
                $oznam->image_path = $imagePath;
            }

            $oznam->save();
        }



        return redirect()->route('oznam.oznam')->with('success', 'Oznam updated');
    }


    /**
     * Po overení potrebných povolení sa na základe id oznamu sa daný oznam spolu s prípadným obrázkom a inými súvisiacimi časťami vymaže z databázy.
     *
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {

        $oznam = Oznam::find($id);
        if($oznam->user->id == auth()->user()->id || auth()->user()->hasAnyRole(['admin', 'superuser'])) {
            if ($oznam->image_path) {
                Storage::disk('public')->delete($oznam->image_path);
            }

            $oznam->delete();
        }


        return redirect()->route('oznam.oznam')
            ->with('success', 'Oznam deleted');
    }

    /**
     * otvorí pohľad ktorý obsahuje formulár pre úpravu oznamov. Súčasťou formuláru je názov oznamu, jeho obsah a prípadný obrázok.
     * Taktiež ak už oznam obrázok obsahuje a nechceme ho nahradiť iným ale odstrániť ho, tak je to možné.
     *
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $oznam = Oznam::find($id);
        return view('oznam.OznamEdit', compact('oznam'));
    }

    /**
     * otvorí pohľad ktorý obsahuje formulár pre vytvorenie nového oznamu. Súčasťou formuláru je názov oznamu, jeho obsah a prípadný obrázok.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('oznam.oznamCreate');
    }
}
