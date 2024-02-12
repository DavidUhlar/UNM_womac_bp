<?php

namespace App\Http\Controllers;

use App\Models\Pacient;
use App\Models\Operacia;
use App\Models\WomacOperation;
use App\Models\WomacResult;
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


//            foreach ($operacie as $operacia) {
                $operacie->pacient()->associate($pacient);
                $operacie->save();
//            }
        }

//        dd($dataPacient);

//        $womacData = WomacOperation::all();
        $womac = Womac::whereNull('closed_at')
            ->whereNull('deleted_at')
            ->whereNull('locked_at')->get();

        $womacOperations = WomacOperation::all();
//        dd($womac);

        $filter = "";
        return view('home.womac', compact('dataPacient', 'womac', 'filter'));
//        return view('home.womac', compact('dataPacient', 'womac', 'womacOperations'));

    }

    public function filter(Request $request)
    {
        $filter = $request->input('filter_criteria');

        $dataPacient = Pacient::where('rc', 'like', "%$filter%")
            ->orWhere('meno', 'like', "%$filter%")
            ->orWhere('priezvisko', 'like', "%$filter%")
            ->get();

        foreach ($dataPacient as $pacient) {
            $operacie = Operacia::where('id_pac', $pacient->id)->get();

            foreach ($operacie as $operacia) {
                $operacia->pacient()->associate($pacient);
                $operacia->save();
            }
        }
        $womac = Womac::whereNull('closed_at')
            ->whereNull('deleted_at')
            ->whereNull('locked_at')->get();
//        dd($dataPacient, $operacie);

    return view('home.womac', compact('dataPacient', 'womac', 'filter'));
}
    public function getWomacData($id_womac)
    {

        $womacData = Womac::where('id_womac', $id_womac)
            ->whereNull('closed_at')
            ->whereNull('deleted_at')
            ->whereNull('locked_at')->firstOrFail();


//            $womacResult = WomacResult::where('id_womac', $id_womac)->firstOrFail();
//            $resultValue = $womacResult->result_value;

        $localWomacOp = WomacOperation::where('id_womac', $id_womac)->first();
        $womacOp = Operacia::where('id', $localWomacOp->id_operation)->first();

        $hhsResult = null;
        $kss1Result = null;
        $kss2Result = null;
        if ($womacOp->typ == 0) {
//                $typResult = "hhs";
            $womacResult = WomacResult::where('id_womac', $id_womac)
                ->where('result_name', 'hhs')
                ->first();
            $hhsResult = $womacResult->result_value;
        } else {
//                $typResult = "kss";
            $womacResult = WomacResult::where('id_womac', $id_womac)
                ->where('result_name', 'kss1')
                ->first();
            $kss1Result = $womacResult->result_value;


            $womacResult = WomacResult::where('id_womac', $id_womac)
                ->where('result_name', 'kss2')
                ->first();
            $kss2Result = $womacResult->result_value;
        }

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
            'answer_11' => $womacData->answer_11,
            'answer_12' => $womacData->answer_12,
            'answer_13' => $womacData->answer_13,
            'answer_14' => $womacData->answer_14,
            'answer_15' => $womacData->answer_15,
            'answer_16' => $womacData->answer_16,
            'answer_17' => $womacData->answer_17,
            'answer_18' => $womacData->answer_18,
            'answer_19' => $womacData->answer_19,
            'answer_20' => $womacData->answer_20,
            'answer_21' => $womacData->answer_21,
            'answer_22' => $womacData->answer_22,
            'answer_23' => $womacData->answer_23,
            'answer_24' => $womacData->answer_24,
            'hhs' => $hhsResult,
            'kss1' => $kss1Result,
            'kss2' => $kss2Result,
            ]);

    }


    public function create(Request $request)
    {

//        dd($request);
        $request->validate([
            'date_womac' => 'required',
            'date_visit' => 'required',

        ]);

        $request->merge([
            'filled'=>'all',
            'created_by'=>auth()->user()->id,
            'updated_by'=>auth()->user()->id,
        ]);


        $exists = Womac::where('id_womac', $request->id_womac)
            ->whereNull('closed_at')
            ->whereNull('deleted_at')
            ->whereNull('locked_at')
            ->exists();

        if ($exists) {

//            dd($request->all());
            $womacUpdate = Womac::where('id_womac', $request->id_womac)
                ->whereNull('closed_at')
                ->whereNull('deleted_at')
                ->whereNull('locked_at')
                ->first();



//            $womacOp->womac()->dissociate($womacUpdate);
//            $womacOp->womac()->associate($womacUpdate);
            $newRecord = Womac::make($womacUpdate->toArray());


            $newRecord->id = null;
            $newRecord->closed_at = now();
            $newRecord->closed_by = auth()->user()->id;
            $newRecord->save();

            $womacUpdate->update([

                'date_womac' => $request->input('date_womac'),
                'date_visit' => $request->input('date_visit'),
                'answer_01' => $request->input('answer_01'),
                'answer_02' => $request->input('answer_02'),
                'answer_03' => $request->input('answer_03'),
                'answer_04' => $request->input('answer_04'),
                'answer_05' => $request->input('answer_05'),
                'answer_06' => $request->input('answer_06'),
                'answer_07' => $request->input('answer_07'),
                'answer_08' => $request->input('answer_08'),
                'answer_09' => $request->input('answer_09'),
                'answer_10' => $request->input('answer_10'),
                'answer_11' => $request->input('answer_11'),
                'answer_12' => $request->input('answer_12'),
                'answer_13' => $request->input('answer_13'),
                'answer_14' => $request->input('answer_14'),
                'answer_15' => $request->input('answer_15'),
                'answer_16' => $request->input('answer_16'),
                'answer_17' => $request->input('answer_17'),
                'answer_18' => $request->input('answer_18'),
                'answer_19' => $request->input('answer_19'),
                'answer_20' => $request->input('answer_20'),
                'answer_21' => $request->input('answer_21'),
                'answer_22' => $request->input('answer_22'),
                'answer_23' => $request->input('answer_23'),
                'answer_24' => $request->input('answer_24'),


            ]);

//            $womacResult = WomacResult::where('id_womac', $request->id_womac);


            $womacOp = Operacia::where('id', $request->id_operation)->first();

            if ($womacOp->typ == 0) {
//                $typResult = "hhs";
                $womacResult = WomacResult::where('id_womac', $request->id_womac)
                    ->where('result_name', 'hhs')
                    ->first();
                $womacResult->update(['result_value' => $request->input('hhs')]);
            } else {
//                $typResult = "kss";
                $womacResult = WomacResult::where('id_womac', $request->id_womac)
                    ->where('result_name', 'kss1')
                    ->first();
                $womacResult->update(['result_value' => $request->input('kss1')]);


                $womacResult = WomacResult::where('id_womac', $request->id_womac)
                    ->where('result_name', 'kss2')
                    ->first();
                $womacResult->update(['result_value' => $request->input('kss2')]);
            }

//            dd($request->input());


        } else {

            $record = Womac::create($request->all());


            do {
                $randomWomacId = mt_rand(1, 999999999);
            } while (Womac::where('id_womac', $randomWomacId)->exists());
            $record->update(['id_womac' => $randomWomacId]);

            $operationID = $request->id_operation;


            $womacOperation = new WomacOperation();
            $womac = Womac::where('id_womac', $record->id_womac)->first();




            $womacOperation->womac()->associate($womac);
            $operacia = Operacia::with('pacient')->find($operationID);
            $womacOperation->operacia()->associate($operacia);

            $pacient = $operacia->pacient()->first();


            $womacOperation->id_patient = $pacient->id;
            $womacOperation->id_womac = $record->id_womac;
            $womacOperation->id_operation = $operationID;
            $womacOperation->id_visit = 1;


//            dd($request->all());

            if ($operacia->typ == 0) {
                $typResult = "hhs";
                $resValue = $request->input('hhs');
                $resultWomac = WomacResult::create([
                    'id_womac' => $womac->id_womac,
                    'result_name' => $typResult,
                    'result_value' => $resValue,
                ]);
                $resultWomac->save();
            } else {
                $typResult1 = "kss1";
                $typResult2 = "kss2";
                $resValue1 = $request->input('kss1');
                $resValue2 = $request->input('kss2');
                $resultWomac1 = WomacResult::create([
                    'id_womac' => $womac->id_womac,
                    'result_name' => $typResult1,
                    'result_value' => $resValue1,
                ]);
                $resultWomac2 = WomacResult::create([
                    'id_womac' => $womac->id_womac,
                    'result_name' => $typResult2,
                    'result_value' => $resValue2,
                ]);
                $resultWomac1->save();
                $resultWomac2->save();
            }





//            dd($womac);

//            $womac->result()->associate($resultWomac);


            $womacOperation->save();
        }
        return redirect()->route('home.womac');
    }

    public function deleteWomac($id_womac)
    {
//        $womac = Womac::find($id_womac);
        $womac = Womac::where('id_womac', $id_womac)
            ->whereNull('closed_at')
            ->whereNull('deleted_at')
            ->whereNull('locked_at')
            ->first();


        $womac->update([
            'deleted_at' => now(),
            'deleted_by' => auth()->user()->id,
            ]);

        $womacResult = WomacResult::where('id_womac', $id_womac);
        $womacResult->delete();
        $womacOperation = WomacOperation::where('id_womac', $id_womac);
        $womacOperation->delete();

        return redirect()->route('home.womac');
    }
}
