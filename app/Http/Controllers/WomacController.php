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

//        $dataPacient = Pacient::with('operacie.womac')->get();
        $dataPacient = Pacient::all();
//        dd($dataPacient, $pacientCount);

        foreach ($dataPacient as $pacient) {

            $operacie = Operacia::where('id_pac', $pacient->id)->firstOrFail();


            foreach ($operacie as $operacia) {
                $operacie->pacient()->associate($pacient);
                $operacie->save();
            }
        }




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

        $womac = Womac::find($record->id_womac);
        $womacOperation->womac()->associate($womac);

        $operacia = Operacia::with('pacient')->find($operationID);
        $womacOperation->operacia()->associate($operacia);

        $pacient = $operacia->pacient()->first();;


        $womacOperation->id_patient = $pacient->id;
        $womacOperation->id_womac = $record->id_womac;
        $womacOperation->id_operation = $operationID;
        $womacOperation->id_visit = 1;





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
