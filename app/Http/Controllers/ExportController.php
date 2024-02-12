<?php

namespace App\Http\Controllers;

use App\Models\Operacia;
use App\Models\Pacient;
use App\Models\Womac;
use App\Models\WomacOperation;
use App\Models\WomacResult;

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


        $womacOperation = WomacOperation::where('id_operation', $id_operacie)->get();
        $operation = Operacia::where('id', $id_operacie)->first();

        foreach ($womacOperation as $womOp) {

    //        dd($womacOperation);
            $womac = Womac::where('id_womac', $womOp->id_womac)
                ->whereNull('closed_at')
                ->whereNull('deleted_at')
                ->whereNull('locked_at')->first();

            $womacResult = WomacResult::where('id_womac', $womOp->id_womac)->get();

            foreach ($womacResult as $result) {
                $result->womac()->associate($womac);
            }

            $womOp->womac()->associate($womac);


//            dd($womacOperation, $womOp->womac->result);
//            if ($womOp->id_operation == $id_operacie) {
//                $womOp->operacia()->associate($operation);
//            }
        }


//        dd($womacOperation->get(0)->womac()->first()->id_womac);
//        dd($womacOperation->get(0));
        return view('export.exportShowOperacia', compact('womacOperation', 'operation'));


    }


}
