<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Oznam;
use Illuminate\Support\Facades\Auth;

class OznamController extends Controller
{
    public function show($id) {
        $oznam = Oznam::find($id);
        return view('oznam.oznamShow')->with('oznam', $oznam);
    }


    public function index()
    {
        $oznam = Oznam::all();
        return view('oznam.oznam', compact('oznam'));
    }

/*
    public function store(Request $request)
    {
        $request->validate([
            'nazov' => 'required|max:255',
            'obsah' => 'required',
        ]);

        // Get the currently authenticated user
        $user = Auth::user();

        // Create a new Oznam record with the user ID as the author
        $oznam = new Oznam([
            'nazov' => $request->input('nazov'),
            'obsah' => $request->input('obsah'),
            'autor' => $user->getAuthIdentifierName(),
        ]);

        // Associate the user with the post
        //$oznam->autor()->associate($user);

        // Save the post to the database
        $oznam->save();

        return redirect()->route('oznam.oznam')->with('success', 'Oznam created');
    }
*/
    public function store(Request $request)
    {
        $request->validate([
            'nazov' => 'required|max:255',
            'obsah' => 'required',
        ]);

        // Get the currently authenticated user
        $user = Auth::user();

        // Create a new Oznam record with the user ID as the author
        $oznam = new Oznam([
            'nazov' => $request->input('nazov'),
            'obsah' => $request->input('obsah'),
            'autor' => $user->username, // Assuming 'username' is the correct column in the 'users' table
        ]);

        // Save the post to the database
        $oznam->save();

        return redirect()->route('oznam.oznam')->with('success', 'Oznam created');
    }


    public function update(Request $request, $id)
    {

        //dd($request->all());
        $request->validate([
            'nazov' => 'required|max:255',
            'obsah' => 'required',
        ]);

        $oznam = Oznam::find($id);

        $oznam->update([
            'nazov' => $request->input('nazov'),
            'obsah' => $request->input('obsah'),
        ]);

        return redirect()->route('oznam.oznam')->with('success', 'Oznam updated');
    }


    public function destroy($id)
    {
        $oznam = Oznam::find($id);
        $oznam->delete();
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
