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
    public function show($id) {
        $oznam = Oznam::with('komentare', 'reakcie')->find($id);
        return view('oznam.oznamShow' , compact('oznam'));
    }



    public function index()
    {

        $oznam = Oznam::orderBy('created_at', 'desc')->paginate(6);
        $oznamCount = Oznam::all()->count();

        return view('oznam.oznam', compact('oznam', 'oznamCount'));
    }



    public function loadMorePosts(Request $request)
    {
        $page = $request->input('page', 1);
        $oznam = Oznam::orderBy('created_at', 'desc')->paginate(6, ['*'], 'page', $page);

        return view('oznam.ajax-posts', compact('oznam'));
    }

    public function loadMoreComments(Request $request, $id)
    {
        $page = $request->input('page', 1);
        $oznam = Oznam::findOrFail($id);
        $comments = $oznam->komentare()->orderBy('created_at', 'desc')->paginate(5, ['*'], 'page', $page);

        return view('oznam.ajax-comments', compact('comments'));
    }

    public function store(Request $request)
    {
//        dd($request);
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
            'autor' => $user->username,

        ]);

        $oznam->image_path = $imagePath;


        $oznam->save();

        return redirect()->route('oznam.oznam')->with('success', 'Oznam created');
    }

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
            'autor' => $user->username,
        ]);


        $komentar->save();

        return back()->with('success', 'Komentar created');
    }

    public function destroyComment($id)
    {

        $komentar = Komentar::find($id);
        if($komentar->autor == auth()->user()->username || auth()->user()->hasAnyRole(['admin', 'superuser'])) {
            $komentar->delete();
        }


        return back()->with('success', 'Komentar deleted');
    }

    public function updateComment(Request $request, $id) {
        $komentar = Komentar::findOrFail($id);


        $request->validate([
            'editedObsah' => 'required|max:255',
        ]);

        if($komentar->autor == auth()->user()->username || auth()->user()->hasAnyRole(['admin', 'superuser'])) {
            $komentar->obsah = $request->input('editedObsah');
            $komentar->save();
        }
        return redirect()->back()->with('success', 'Comment updated successfully');
    }


    public function likeOznam($id) {
        $oznam = Oznam::find($id);
//        dd($request->all());

//        return response()->json(['success' => $request->all()]);
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
            $userReaction = $reakcia;
        }


        $liked = ($userReaction && $userReaction->reakcia) ? true : false;
        $likeCount = $oznam->reakcie->where('reakcia', true)->count();


        return response()->json(['success' => 'Reakcia created', 'liked' => $liked, 'likeCount' => $likeCount,]);
    }





    public function update(Request $request, $id)
    {

        //dd($request->all());
        $request->validate([
            'nazov' => 'required|min:4|max:255',
            'obsah' => 'required|max:20000',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $oznam = Oznam::find($id);

        if($oznam->autor == auth()->user()->username || auth()->user()->hasAnyRole(['admin', 'superuser'])) {
            $oznam->update([
                'nazov' => $request->input('nazov'),
                'obsah' => $request->input('obsah'),
            ]);

            if ($request->input('delete_image') == 1 && $oznam->image_path) {
                Storage::disk('public')->delete($oznam->image_path);

                $oznam->image_path = null;
//                $oznam->save();
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


    public function destroy($id)
    {

        $oznam = Oznam::find($id);
        if($oznam->autor == auth()->user()->username || auth()->user()->hasAnyRole(['admin', 'superuser'])) {
            if ($oznam->image_path) {
                Storage::disk('public')->delete($oznam->image_path);
            }

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
