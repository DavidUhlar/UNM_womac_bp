<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WomacController extends Controller
{
    public function show()
    {
        return view('home.womac');
    }
}
