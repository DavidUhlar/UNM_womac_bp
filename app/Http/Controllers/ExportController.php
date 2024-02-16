<?php

namespace App\Http\Controllers;

use App\Models\Operacia;
use App\Models\Pacient;
use App\Models\Womac;
use App\Models\WomacOperation;
use App\Models\WomacResult;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function show()
    {

        $filteredOperacie = Operacia::all();

        $filter_operacia_SAR_ID = '';
        $filter_pacient_rc = '';
        $filter_operacia_typ = null;
        $filter_operacia_subtyp = null;
        $filter_pacient_priezvisko = '';

//        dd($operacie);
        return view('export.export', compact('filteredOperacie',
            'filter_operacia_SAR_ID',
            'filter_pacient_rc',
            'filter_operacia_typ',
            'filter_operacia_subtyp',
            'filter_pacient_priezvisko',
        ));


    }

    public function filter(Request $request)
    {
        $filter_operacia_SAR_ID = $request->input('filter_operacia_SAR_ID');
        $filter_pacient_rc = $request->input('filter_pacient_rc');
        $filter_operacia_typ = $request->input('filter_operacia_typ');
        $filter_operacia_subtyp = $request->input('filter_operacia_subtyp');
        $filter_pacient_priezvisko = $request->input('filter_pacient_priezvisko');

        $pacientiData = Pacient::where('rc', 'like', "%$filter_pacient_rc%")
            ->where('priezvisko', 'like', "%$filter_pacient_priezvisko%")
            ->get();
        $filteredOperacie = collect();

        foreach ($pacientiData as $pacient) {
            $operacie = Operacia::where('id_pac', $pacient->id);


            $operacie->where('sar_id', 'like', "%$filter_operacia_SAR_ID%")
                ->where('typ', 'like', "%$filter_operacia_typ%")
                ->where('subtyp', 'like', "%$filter_operacia_subtyp%");

            $filteredOperacie = $filteredOperacie->merge($operacie->get());
        }

        return view('export.export', compact('filteredOperacie',
            'filter_operacia_SAR_ID',
            'filter_pacient_rc',
            'filter_operacia_typ',
            'filter_operacia_subtyp',
            'filter_pacient_priezvisko',
        ));
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


        }


//        dd($womacOperation->get(0)->womac()->first()->id_womac);
//        dd($womacOperation->get(0));
        return view('export.exportShowOperacia', compact('womacOperation', 'operation'));


    }


}
