<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Oznam;

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
        $request->validate([
            'nazov' => 'required|max:255',
            'text' => 'required',
        ]);
        Oznam::create($request->all());
        return redirect()->route('oznam.oznam')->with('success', 'Oznam created');
    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'nazov' => 'required|max:255',
            'text' => 'required',
        ]);
        $oznam = Oznam::find($id);
        $oznam->update($request->all());
        return redirect()->route('oznam.oznam')
            ->with('success', 'Oznam updated');

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
        return view('home.create');
    }
}
