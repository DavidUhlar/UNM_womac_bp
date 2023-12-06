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
