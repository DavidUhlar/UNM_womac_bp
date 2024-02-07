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

//        $womacData = Womac::where('id_womac', 25)->firstOrFail()->toArray();
//        dd($womacData);
//        $dataPacient = Pacient::with('operacie.womac')->get();
        $dataPacient = Pacient::all();
//        dd($dataPacient, $pacientCount);

        foreach ($dataPacient as $pacient) {

            $operacie = Operacia::where('id_pac', $pacient->id)->firstOrFail();
//            $operacie = Operacia::where('id_pac', $pacient->id)->get();


            foreach ($operacie as $operacia) {
                $operacie->pacient()->associate($pacient);
                $operacie->save();
            }
        }


//        $womacData = WomacOperation::all();
        $womac = Womac::all();

//        dd($womac);

        return view('home.womac', compact('dataPacient', 'womac'));

    }
    public function getWomacData($id_womac)
    {

            $womacData = Womac::where('id_womac', $id_womac)->firstOrFail();
            return response()->json(['id_womac' => $womacData->id_womac,
                'date_womac' => $womacData->date_womac,
                'date_visit' => $womacData->date_visit,
                'answer_01' => $womacData->answer_01,
                'answer_02' => $womacData->answer_02,
                'answer_03' => $womacData->answer_03,
                'answer_04' => $womacData->answer_04,
                'answer_05' => $womacData->answer_05,
                'answer_06' => $womacData->answer_06,
                'answer_07' => $womacData->answer_07,
                'answer_08' => $womacData->answer_08,
                'answer_09' => $womacData->answer_09,
                'answer_10' => $womacData->answer_10,

                ]);

    }
//    public function getWomacData($id_womac)
//    {
//
//
//        $womacData = Womac::where('id_womac', $id_womac)->firstOrFail()->toArray();
//
//        dd($womacData);
//
//        return response()->json($womacData);
//    }

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



//    public function update(Request $request)
//    {
//
//        $request->validate([
//
//        ]);
//        //dd($request);
//
//
//
//        $request->merge([
//            'filled'=>'all',
//            'created_by'=>auth()->user()->id,
//            'updated_by'=>auth()->user()->id,
//        ]);
//        $record = Womac::create($request->all());
//
//
////        $operationModel->womac()->attach($womac, [
////            'id_patient' => $patientId,
////            'id_operation' => $operationModel->id,
////            'id_womac' => $womacId,
////            'id_visit'=> $operationModel->id
////        ]);
//        //$operationModel->womac()->attach($womac);
//
//
//        return redirect()->route('home.womac');
//
//
//    }


}
