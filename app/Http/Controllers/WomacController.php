<?php

namespace App\Http\Controllers;

use App\Models\Pacient;
use App\Models\Operacia;
use Illuminate\Http\Request;
use App\Models\Womac;

class WomacController extends Controller
{
    /*
    public function show()
    {
        //return view('home.womac');
        $dataPacient = Pacient::with('pacient.womac')->get();

        return view('home.womac', ['dataPacient' => $dataPacient]);
    }
*/
    public function show()
    {
        // Get all pacients with their operacie and womac relationships
        //$dataPacient = Pacient::with('operacie.womac')->get();


        //return view('home.womac', ['dataPacient' => $dataPacient]);
        return view('home.womac');
    }
/*
    public function returnDataPacient()
    {
        // Získání všech pacientů s jejich operacemi a Womac dotazníky
        $dataPacient = Pacient::with('pacient.womac')->get();

        return view('home.womac', ['dataPacient' => $dataPacient]);
    }
*/
    public function create(Request $request)
    {
        // Validate the form data
//        $request->validate([
//            // Add validation rules for your Womac inputs
//        ]);
        //dd($request);

        // Create a new Womac instance

        $request->merge([
            'filled'=>'all',
            'created_by'=>1,
            'created_at'=>'2022-05-05 15:20:35',
            'updated_by'=>1,
            'updated_at'=>'2022-05-05 15:20:35',
        ]);
        $record = Womac::create($request->all());

        // Assign form data to Womac model properties
//        $womac->id_womac = $operationModel->id;
//        $womac->date_visit = $operationModel->datum;
//        $womac->date_womac = $operationModel->datum;
//        $womac->answer_01 = $request->input('vstup1');
//        $womac->answer_02 = $request->input('vstup2');
//        $womac->filled = 0;
//        $womac->created_at = null;
//        $womac->updated_at = null;
//        $womac->deleted_at = null;
//        $womac->closed_at = null;
//        $womac->locked_at = null;
//        $womac->created_by = 200;
//        $womac->updated_by = 200;
//        $womac->deleted_by = null;
//        $womac->closed_by = null;
//        $womac->locked_by = null;
        // Assign other form inputs as needed

//        $patientId = $operationModel->pacient->id;
//        $womacId = $womac->id_womac;
//        $operationModel->womac()->attach($womac, [
//            'id_patient' => $patientId,
//            'id_operation' => $operationModel->id,
//            'id_womac' => $womacId,
//            'id_visit'=> $operationModel->id
//        ]);
        //$operationModel->womac()->attach($womac);

        //$operationModel->womac()->attach($womac, ['id_visit' => $operationModel->id()]);
        // Save the Womac model to the database related to the operation
//        $operationModel->womac()->save($womac);

        return redirect()->route('home.womac');
        //$operationModel->womac()->updateExistingPivot($womac->id, ['id_patient' => $patientId, 'id_visit' => $operationModel->id]);
        // Optionally, you can redirect the user to a specific page after the submission
//        return redirect()->route('your.redirect.route');

    }

}
