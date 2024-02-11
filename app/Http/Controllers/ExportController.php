<?php

namespace App\Http\Controllers;

class ExportController extends Controller
{
    public function show()
    {

//        return response()->json(['routisko' => route('womac.delete'),
//        ]);
        return view('export.export');


    }
}
