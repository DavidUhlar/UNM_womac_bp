<?php

namespace App\Http\Controllers;

use App\Models\Pacient;
use App\Models\Operacia;
use App\Models\WomacOperation;
use Illuminate\Http\Request;
use App\Models\Womac;

class WomacController extends Controller
{

    public function show()
    {

        $dataPacient = Pacient::with('operacie.womac')->get();
//        $pacientCount = Pacient::all()->count();
//        dd($dataPacient, $pacientCount);


        return view('home.womac', compact('dataPacient'));

    }

    public function create(Request $request)
    {

        $request->validate([

        ]);
        //dd($request);



        $request->merge([
            'filled'=>'all',
            'created_by'=>auth()->user()->id,
            'updated_by'=>auth()->user()->id,
        ]);
        $record = Womac::create($request->all());

        $operationID = $request->id_operation;


        $womacOperation = new WomacOperation();

        $womacOperation->id_patient = Operacia::find($operationID)->pacient()->id;
        $womacOperation->id_womac = $record->id_womac;
        $womacOperation->id_operation = $operationID;
        $womacOperation->id_visit = 1;


        $womac = Womac::find($record->id_womac);
        $womacOperation->womac()->associate($womac);

        $operacia = Operacia::find($operationID);
        $womacOperation->operacia()->associate($operacia);


        $womacOperation->save();
//        $operationModel->womac()->attach($womac, [
//            'id_patient' => $patientId,
//            'id_operation' => $operationModel->id,
//            'id_womac' => $womacId,
//            'id_visit'=> $operationModel->id
//        ]);
        //$operationModel->womac()->attach($womac);

//        $record->operacie()->sync($operationID);

        return redirect()->route('home.womac');


    }

    public function update(Request $request)
    {

        $request->validate([

        ]);
        //dd($request);



        $request->merge([
            'filled'=>'all',
            'created_by'=>auth()->user()->id,
            'updated_by'=>auth()->user()->id,
        ]);
        $record = Womac::create($request->all());


//        $operationModel->womac()->attach($womac, [
//            'id_patient' => $patientId,
//            'id_operation' => $operationModel->id,
//            'id_womac' => $womacId,
//            'id_visit'=> $operationModel->id
//        ]);
        //$operationModel->womac()->attach($womac);


        return redirect()->route('home.womac');


    }
}
