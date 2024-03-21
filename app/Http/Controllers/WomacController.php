<?php

namespace App\Http\Controllers;

use App\Models\Pacient;
use App\Models\Operacia;
use App\Models\WomacAnswers;
use App\Models\WomacOperation;
use App\Models\WomacResult;
use Illuminate\Http\Request;
use App\Models\Womac;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Validation\Rule;

class WomacController extends Controller
{

    public function show()
    {

        $dataPacient = Pacient::paginate(10);

        $womac = Womac::whereNull('closed_at')
            ->whereNull('deleted_at')
            ->whereNull('locked_at')->get();

        $filter = "";
        return view('home.womac', compact('dataPacient', 'womac', 'filter'));
    }

    public function filter(Request $request)
    {

        $request->validate([


        ]);


        $filter = $request->input('filter_criteria');

        $dataPacient = Pacient::where('rc', 'like', "%$filter%")
            ->orWhere('meno', 'like', "%$filter%")
            ->orWhere('priezvisko', 'like', "%$filter%")
            ->get();


        $pageSize = 10;
        $totalPacient = $dataPacient->count();
        $currentPage = $request->input('page', 1);


        $dataPacient = new LengthAwarePaginator(
            $dataPacient->forPage($currentPage, $pageSize)->values(),
            $totalPacient,
            $pageSize,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );


    return view('home.womac', compact('dataPacient',  'filter'));
}
    public function getWomacData($id_womac)
    {

        $womacData = Womac::where('id_womac', $id_womac)
            ->whereNull('closed_at')
            ->whereNull('deleted_at')
            ->whereNull('locked_at')->firstOrFail();

        $localWomacOp = WomacOperation::where('id_womac', $womacData->id)->first();
        $womacOp = Operacia::where('id', $localWomacOp->id_operation)->first();

        $hhsResult = null;
        $kss1Result = null;
        $kss2Result = null;
        if ($womacOp->typ == 0) {
//                $typResult = "hhs";
            $womacResult = WomacResult::where('id_womac', $womacData->id)
                ->where('result_name', 'hhs')
                ->first();
            $hhsResult = $womacResult->result_value;
        } else {
//                $typResult = "kss";
            $womacResult = WomacResult::where('id_womac', $womacData->id)
                ->where('result_name', 'kss1')
                ->first();
            $kss1Result = $womacResult->result_value;


            $womacResult = WomacResult::where('id_womac', $womacData->id)
                ->where('result_name', 'kss2')
                ->first();
            $kss2Result = $womacResult->result_value;
        }

        $womacAnswers = $womacData->answers->whereNull('closed_at')
            ->whereNull('deleted_at')->first();

        return response()->json(['id_womac' => $womacData->id_womac,
            'date_womac' => $womacData->date_womac,
            'date_visit' => $womacData->date_visit,
            'answer_01' => $womacAnswers->answer_01,
            'answer_02' => $womacAnswers->answer_02,
            'answer_03' => $womacAnswers->answer_03,
            'answer_04' => $womacAnswers->answer_04,
            'answer_05' => $womacAnswers->answer_05,
            'answer_06' => $womacAnswers->answer_06,
            'answer_07' => $womacAnswers->answer_07,
            'answer_08' => $womacAnswers->answer_08,
            'answer_09' => $womacAnswers->answer_09,
            'answer_10' => $womacAnswers->answer_10,
            'answer_11' => $womacAnswers->answer_11,
            'answer_12' => $womacAnswers->answer_12,
            'answer_13' => $womacAnswers->answer_13,
            'answer_14' => $womacAnswers->answer_14,
            'answer_15' => $womacAnswers->answer_15,
            'answer_16' => $womacAnswers->answer_16,
            'answer_17' => $womacAnswers->answer_17,
            'answer_18' => $womacAnswers->answer_18,
            'answer_19' => $womacAnswers->answer_19,
            'answer_20' => $womacAnswers->answer_20,
            'answer_21' => $womacAnswers->answer_21,
            'answer_22' => $womacAnswers->answer_22,
            'answer_23' => $womacAnswers->answer_23,
            'answer_24' => $womacAnswers->answer_24,
            'hhs' => $hhsResult,
            'kss1' => $kss1Result,
            'kss2' => $kss2Result,
            'id_visit' => $localWomacOp->id_visit,
            ]);

    }

    private function isDataChanged(array $requestData, $womacData, array $womacZaznam)
    {

        //prechadzam pole, podla ktoreho kontrolujem
        foreach ($womacZaznam as $zaznam) {

            //ak sa nerovna hodnota requestu a sucastnych dat, vraciam true ako zmenu
            if ($womacData->$zaznam != $requestData[$zaznam]) {
                return true; // zmena
            }
        }
        return false; // ziadna zmena
    }

    private function isDataChangedResult(array $requestData, Womac $womacData, array $resultArray)
    {
        //prechadzam pole, podla ktoreho kontrolujem
        foreach ($resultArray as $resultName => $resultValue) {
            //vyberiem konkretny result podla nazvu ktory hladam
            $resultZaznam = $womacData->result->where('result_name', $resultName)->first();
            if ($resultZaznam->result_name == $resultName) {
                //ak sa nerovna hodnota requestu a sucastnych dat, vraciam true ako zmenu
                if ($resultZaznam->result_value != $requestData[$resultName]) {
                    return true; // zmena
                }
            }
        }
        return false; // ziadna zmena
    }
    public function create(Request $request, $id_operation)
    {

//        dd($request->all());
        $request->validate([
            'date_womac' => 'required',
            'date_visit' => 'required',
            'id_visit' => 'required',
            'answer_01' => ['nullable', Rule::in([1, 2, 3, 4, 5])],
            'answer_02' => ['nullable', Rule::in([1, 2, 3, 4, 5])],
            'answer_03' => ['nullable', Rule::in([1, 2, 3, 4, 5])],
            'answer_04' => ['nullable', Rule::in([1, 2, 3, 4, 5])],
            'answer_05' => ['nullable', Rule::in([1, 2, 3, 4, 5])],
            'answer_06' => ['nullable', Rule::in([1, 2, 3, 4, 5])],
            'answer_07' => ['nullable', Rule::in([1, 2, 3, 4, 5])],
            'answer_08' => ['nullable', Rule::in([1, 2, 3, 4, 5])],
            'answer_09' => ['nullable', Rule::in([1, 2, 3, 4, 5])],
            'answer_10' => ['nullable', Rule::in([1, 2, 3, 4, 5])],
            'answer_11' => ['nullable', Rule::in([1, 2, 3, 4, 5])],
            'answer_12' => ['nullable', Rule::in([1, 2, 3, 4, 5])],
            'answer_13' => ['nullable', Rule::in([1, 2, 3, 4, 5])],
            'answer_14' => ['nullable', Rule::in([1, 2, 3, 4, 5])],
            'answer_15' => ['nullable', Rule::in([1, 2, 3, 4, 5])],
            'answer_16' => ['nullable', Rule::in([1, 2, 3, 4, 5])],
            'answer_17' => ['nullable', Rule::in([1, 2, 3, 4, 5])],
            'answer_18' => ['nullable', Rule::in([1, 2, 3, 4, 5])],
            'answer_19' => ['nullable', Rule::in([1, 2, 3, 4, 5])],
            'answer_20' => ['nullable', Rule::in([1, 2, 3, 4, 5])],
            'answer_21' => ['nullable', Rule::in([1, 2, 3, 4, 5])],
            'answer_22' => ['nullable', Rule::in([1, 2, 3, 4, 5])],
            'answer_23' => ['nullable', Rule::in([1, 2, 3, 4, 5])],
            'answer_24' => ['nullable', Rule::in([1, 2, 3, 4, 5])],
            'hhs' => 'nullable|integer|between:0,100',
            'kss1' => 'nullable|integer|between:0,100',
            'kss2' => 'nullable|integer|between:0,100',

        ]);


        $request->merge([
            'filled'=>'',
            'created_by'=>auth()->user()->id,
            'updated_by'=>auth()->user()->id,
        ]);


        $exists = Womac::where('id_womac', $request->id_womac)
            ->whereNull('closed_at')
            ->whereNull('deleted_at')
            ->whereNull('locked_at')
            ->exists();



        if ($exists) {

            $womacUpdate = Womac::where('id_womac', $request->id_womac)
                ->whereNull('closed_at')
                ->whereNull('deleted_at')
                ->whereNull('locked_at')
                ->first();

            $womacUpdateAnswers = $womacUpdate->answers->whereNull('closed_at')
                ->whereNull('deleted_at')
                ->first();

            $op = Operacia::find($id_operation);
            $womacOperationUpdate = WomacOperation::where('id_womac', $womacUpdate->id);

            if ($op->typ == 0) {
                $resultArray = ['hhs' => $womacUpdate->result->where('result_name', 'hhs')->first()->result_value];
            } else if ($op->typ == 1) {
                $resultArray = [
                    'kss1' => $womacUpdate->result->where('result_name', 'kss1')->first()->result_value,
                    'kss2' => $womacUpdate->result->where('result_name', 'kss2')->first()->result_value
                ];
            }



            $isDataChanged = $this->isDataChanged($request->all(), $womacUpdate, ['date_visit', 'date_womac']);
            $isDataChangedAnswers = $this->isDataChanged($request->all(), $womacUpdateAnswers, [
                'answer_01', 'answer_02', 'answer_03', 'answer_04', 'answer_05',
                'answer_06', 'answer_07', 'answer_08', 'answer_09', 'answer_10',
                'answer_11', 'answer_12', 'answer_13', 'answer_14', 'answer_15',
                'answer_16', 'answer_17', 'answer_18', 'answer_19', 'answer_20',
                'answer_21', 'answer_22', 'answer_23', 'answer_24',
            ]);
            $isDataChangedResults = $this->isDataChangedResult($request->all(), $womacUpdate, $resultArray);


            $womacOperationUpdate->update([
                'id_visit' => $request->input('id_visit'),
            ]);
            if (!$isDataChanged && !$isDataChangedAnswers && !$isDataChangedResults) {
                return redirect()->back();
            }

            if ($isDataChanged) {

                $newRecord = Womac::make($womacUpdate->toArray());

                $newRecord->id = null;
                $newRecord->closed_at = now();
                $newRecord->closed_by = auth()->user()->id;
                $newRecord->save();

                $womacUpdate->update([

                    'date_womac' => $request->input('date_womac'),
                    'date_visit' => $request->input('date_visit'),
                ]);
            }
            if ($isDataChangedAnswers) {
                $newRecordAnswers = WomacAnswers::make($womacUpdateAnswers->toArray());

                $newRecordAnswers->id = null;
                $newRecordAnswers->closed_at = now();
                $newRecordAnswers->closed_by = auth()->user()->id;
                $newRecordAnswers->save();

                $womacUpdateAnswers->update([
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
            }
            $answerCount = 0;

            for ($i = 1; $i <= 24; $i++) {
                $answerKey = 'answer_' . str_pad($i, 2, '0', STR_PAD_LEFT);
                $answerValue = $request->input($answerKey);

                if (!empty($answerValue)) {
                    $answerCount++;
                }
            }

            if ($answerCount == 24) {
                // TU BUDE RATANIE PRIEMERU

                $percenta = [];

                for ($i = 1; $i <= 24; $i++) {
                    $answerKey = 'answer_' . str_pad($i, 2, '0', STR_PAD_LEFT);
                    $answerValue = $request->input($answerKey);


                    $percenta[$i] = (5 - $answerValue) * 25;


                }


                //TU SA RATA PRIEMER
                $priemer = array_sum($percenta) / 24;

                $womacResult = WomacResult::where('id_womac', $womacUpdate->id)
                    ->where('result_name', 'avg')
                    ->first();

                $womacResult->update(['result_value' => $priemer]);

            }

            if ($isDataChangedResults) {

                $womacOp = Operacia::where('id', $id_operation)->first();

                if ($womacOp->typ == 0) {
    //                $typResult = "hhs";
                    $womacResult = WomacResult::where('id_womac', $womacUpdate->id)
                        ->where('result_name', 'hhs')
                        ->first();
                    $womacResult->update(['result_value' => $request->input('hhs')]);



                } else if ($womacOp->typ == 1){
    //                $typResult = "kss";
                    $womacResult = WomacResult::where('id_womac', $womacUpdate->id)
                        ->where('result_name', 'kss1')
                        ->first();
                    $womacResult->update(['result_value' => $request->input('kss1')]);

                    $womacResult = WomacResult::where('id_womac', $womacUpdate->id)
                        ->where('result_name', 'kss2')
                        ->first();
                    $womacResult->update(['result_value' => $request->input('kss2')]);

                }
            }
            $womacUpdate->update([
                'filled' => $answerCount
            ]);

        } else {

            $record = Womac::create($request->all());


            do {
                $randomWomacId = mt_rand(1, 999999999999);
            } while (Womac::where('id_womac', $randomWomacId)->exists());
            $record->update(['id_womac' => $randomWomacId]);




            $womacOperation = new WomacOperation();
            $womac = Womac::where('id_womac', $record->id_womac)
                ->whereNull('closed_at')
                ->whereNull('deleted_at')
                ->whereNull('locked_at')
                ->first();

            $data = $request->all();


            $data['id_womac'] = $womac->id;

            $womacAnswers = WomacAnswers::create($data);



            $operacia = Operacia::find($id_operation);
            $pacient = $operacia->pacient;




            $womacOperation->id_patient = $pacient->id;
            $womacOperation->id_womac = $womac->id;
            $womacOperation->id_operation = $id_operation;
            $womacOperation->id_visit = $request->input('id_visit');

            $answerCount = 0;

            for ($i = 1; $i <= 24; $i++) {
                $answerKey = 'answer_' . str_pad($i, 2, '0', STR_PAD_LEFT);
                $answerValue = $request->input($answerKey);
                if (!empty($answerValue)) {
                    $answerCount++;
                }

            }


            $resultWomac = WomacResult::create([
                'id_womac' => $womac->id,
                'result_name' => 'avg',
                'result_value' => null,
            ]);
            $resultWomac->save();

            if ($answerCount == 24) {

                $percenta = [];

                for ($i = 1; $i <= 24; $i++) {
                    $answerKey = 'answer_' . str_pad($i, 2, '0', STR_PAD_LEFT);
                    $answerValue = $request->input($answerKey);


                    $percenta[$i] = (5 - $answerValue) * 25;


                }


                //TU SA RATA PRIEMER
                $priemer = array_sum($percenta) / 24;

                $womacResult = WomacResult::where('id_womac', $womac->id)
                    ->where('result_name', 'avg')
                    ->first();
                $womacResult->update(['result_value' => $priemer]);
            }



            if ($operacia->typ == 0) {
                $typResult = "hhs";
                $resValue = $request->input('hhs');
                $resultWomac = WomacResult::create([
                    'id_womac' => $womac->id,
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
                    'id_womac' => $womac->id,
                    'result_name' => $typResult1,
                    'result_value' => $resValue1,
                ]);
                $resultWomac2 = WomacResult::create([
                    'id_womac' => $womac->id,
                    'result_name' => $typResult2,
                    'result_value' => $resValue2,
                ]);
                $resultWomac1->save();
                $resultWomac2->save();

            }

            $womacOperation->save();

            $womacOperation->womac->update([

                'filled' => $answerCount
            ]);
        }
        return redirect()->back();
    }

    public function deleteWomac($id_womac)
    {
//        $womac = Womac::find($id_womac);
        $womac = Womac::where('id_womac', $id_womac)
            ->whereNull('closed_at')
            ->whereNull('deleted_at')
            ->whereNull('locked_at')
            ->first();


        $womacAnswers = $womac->answers->whereNull('closed_at')
            ->whereNull('deleted_at')
            ->first();

        $womac->update([
            'deleted_at' => now(),
            'deleted_by' => auth()->user()->id,
            ]);
        $womacAnswers->update([
            'deleted_at' => now(),
            'deleted_by' => auth()->user()->id,
        ]);

        $womacResult = WomacResult::where('id_womac', $womac->id);
        $womacResult->update([
            'closed_at' => now(),
            'closed_by' => auth()->user()->id,
        ]);

        $womacOperation = WomacOperation::where('id_womac', $womac->id);
        $womacOperation->update([
            'closed_at' => now(),
            'closed_by' => auth()->user()->id,
        ]);

        return redirect()->back()->with('success', 'Dotazník úspešne odstránený');
    }
}
