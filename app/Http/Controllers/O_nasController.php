<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class O_nasController extends Controller
{
    public function show()
    {
        return view('home.o_nas');
    }
}
