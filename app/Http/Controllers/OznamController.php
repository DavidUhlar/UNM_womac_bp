<?php

namespace App\Http\Controllers;
use App\Models\Komentar;
use App\Models\Reakcia;
use Illuminate\Http\Request;
use App\Models\Oznam;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class OznamController extends Controller
{
    public function show($id) {
        $oznam = Oznam::with('komentare', 'reakcie')->find($id);

       //dd($oznam->komentare->all());
        return view('oznam.oznamShow' , compact('oznam'));
    }


    public function index()
    {
        $oznam = Oznam::all();
        return view('oznam.oznam', compact('oznam'));
    }


    public function store(Request $request)
    {
//        dd($request);
        $request->validate([
            'nazov' => 'required|min:4|max:255',
            'obsah' => 'required',
        ]);


        $user = Auth::user();


        $oznam = new Oznam([
            'nazov' => $request->input('nazov'),
            'obsah' => $request->input('obsah'),
            'autor' => $user->username,
        ]);


        $oznam->save();

        return redirect()->route('oznam.oznam')->with('success', 'Oznam created');
    }

    public function storeComment(Request $request)
    {
//        dd($request);
//        $request->validate([
//            'nazov' => 'required|min:4|max:255',
//            'obsah' => 'required',
//        ]);


        $user = Auth::user();


        $komentar = new Komentar([
            'id_prispevku' => $request->id,
            'obsah' => $request->input('obsah'),
            'autor' => $user->username,
        ]);


        $komentar->save();

        return back()->with('success', 'Komentar created');
    }

    public function destroyComment($id)
    {

        $komentar = Komentar::find($id);
        if($komentar->autor == auth()->user()->username) {
            $komentar->delete();
        }


        return back()->with('success', 'Komentar deleted');
    }

    public function updateComment(Request $request, $id) {
        $comment = Komentar::findOrFail($id);


        $request->validate([
            'editedObsah' => 'required',
        ]);

        $comment->obsah = $request->input('editedObsah');
        $comment->save();

        return redirect()->back()->with('success', 'Comment updated successfully');
    }


    public function likeOznam($id) {
        $oznam = Oznam::find($id);


        $reakcie = Reakcia::where('id_prispevku', $oznam->id)->get();


        $userReaction = $reakcie->where('autor_reakcie', auth()->user()->username)->first();

        if ($userReaction) {
            $userReaction->reakcia = !$userReaction->reakcia;
            $userReaction->save();

        } else {

            $reakcia = Reakcia::create([
                'id_prispevku' => $oznam->id,
                'autor_reakcie' => auth()->user()->username,
                'reakcia' => true,
            ]);
            $reakcia->save();

        }

        return back()->with('success', 'Reakcia created');
    }





    public function update(Request $request, $id)
    {

        //dd($request->all());
        $request->validate([
            'nazov' => 'required|min:4|max:255',
            'obsah' => 'required',
        ]);

        $oznam = Oznam::find($id);

        if($oznam->autor == auth()->user()->username) {
            $oznam->update([
                'nazov' => $request->input('nazov'),
                'obsah' => $request->input('obsah'),
            ]);
        }

        return redirect()->route('oznam.oznam')->with('success', 'Oznam updated');
    }


    public function destroy($id)
    {

        $oznam = Oznam::find($id);
        if($oznam->autor == auth()->user()->username) {
            $oznam->delete();
        }


        return redirect()->route('oznam.oznam')
            ->with('success', 'Oznam deleted');
    }

    public function edit($id)
    {
        $oznam = Oznam::find($id);

        return view('oznam.OznamEdit', compact('oznam'));



    }

    public function create()
    {
        return view('oznam.oznamCreate');
    }
}
