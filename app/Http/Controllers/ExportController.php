<?php

namespace App\Http\Controllers;

use App\Models\Operacia;
use App\Models\Pacient;

class ExportController extends Controller
{
    public function show()
    {

        $pacientiData = Pacient::all();
        foreach ($pacientiData as $pacient) {

//            $operacie = Operacia::where('id_pac', $pacient->id)->firstOrFail();
            $operacie = Operacia::where('id_pac', $pacient->id)->get();



            foreach ($operacie as $operacia) {

                $operacia->pacient()->associate($pacient);

                $operacia->save();
//                dd($operacia);
            }
        }

        return view('export.export', compact('pacientiData'));


    }


    public function showOperacia($id_operacie)
    {

        $pacientiData = Pacient::all();
        foreach ($pacientiData as $pacient) {

//            $operacie = Operacia::where('id_pac', $pacient->id)->firstOrFail();
            $operacie = Operacia::where('id_pac', $pacient->id)->get();



            foreach ($operacie as $operacia) {

                $operacia->pacient()->associate($pacient);

                $operacia->save();
//                dd($operacia);
            }
        }

        return view('export.exportShowOperacia', compact('id_operacie'));


    }


}
