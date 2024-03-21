<?php

namespace App\Http\Controllers;

use App\Models\Operacia;
use App\Models\Pacient;
use App\Models\Womac;
use App\Models\WomacOperation;
use App\Models\WomacResult;
use Illuminate\Http\Request;
use App\Exports\FilteredOperacieExport;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function show()
    {

        $filteredOperaciePaginate = Operacia::paginate(10);
//        $filteredOperacie = Operacia::all();

        $filter_operacia_SAR_ID = '';
        $filter_pacient_rc = '';
        $filter_operacia_typ = null;
        $filter_operacia_subtyp = null;
        $filter_operacia_strana = null;
        $filter_pacient_priezvisko = '';

        Session::put('filteredOperacie', Operacia::all());

//        dd($operacie);
        return view('export.export', compact('filteredOperaciePaginate',
            'filter_operacia_SAR_ID',
            'filter_pacient_rc',
            'filter_operacia_typ',
            'filter_operacia_subtyp',
            'filter_operacia_strana',
            'filter_pacient_priezvisko',
        ));


    }

    public function filter(Request $request)
    {
        $filter_operacia_SAR_ID = $request->input('filter_operacia_SAR_ID');
        $filter_pacient_rc = $request->input('filter_pacient_rc');
        $filter_operacia_typ = $request->input('filter_operacia_typ');
        $filter_operacia_subtyp = $request->input('filter_operacia_subtyp');
        $filter_operacia_strana = $request->input('filter_operacia_strana');
        $filter_pacient_priezvisko = $request->input('filter_pacient_priezvisko');

        $pacientiData = Pacient::where('rc', 'like', "%$filter_pacient_rc%")
            ->where('priezvisko', 'like', "%$filter_pacient_priezvisko%")
            ->get();
        $filteredOperacie = collect();


//        DB::enableQueryLog();
        foreach ($pacientiData as $pacient) {

            $operacie = Operacia::where('id_pac', $pacient->id)
                ->where('sar_id', 'like', "%$filter_operacia_SAR_ID%")
                ->where('typ', 'like', "%$filter_operacia_typ%")
                ->where('subtyp', 'like', "%$filter_operacia_subtyp%")
                ->where('strana', 'like', "%$filter_operacia_strana%")
                ->with('womac');
//                ->get();

            $filteredOperacie = $filteredOperacie->merge($operacie->get());

        }

//        dd($filteredOperacie);
        Session::put('filteredOperacie', $filteredOperacie);
//        dd($filteredOperacie);

        //https://laracasts.com/discuss/channels/laravel/how-to-paginate-laravel-collection
//        $perPage = 1;
//        $currentPage = Paginator::resolveCurrentPage() ?: 1;
//        $currentPageItems = $filteredOperacie->slice(($currentPage - 1) * $perPage, $perPage)->all();
//        $filteredOperaciePaginate = new LengthAwarePaginator($currentPageItems, count($filteredOperacie), $perPage, $currentPage, [
//            'path' => Paginator::resolveCurrentPath(),
//        ]);
        $pageSize = $request->input('page_size', 10);
        $totalOperacie = $filteredOperacie->count();
        $currentPage = $request->input('page', 1);
        $pageSize = max(1, $pageSize);

        $filteredOperaciePaginate = new LengthAwarePaginator(
            $filteredOperacie->forPage($currentPage, $pageSize)->values(),
            $totalOperacie,
            $pageSize,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );
//        $filteredOperaciePaginate = $filteredOperacie;

        return view('export.export', compact('filteredOperaciePaginate',
            'filter_operacia_SAR_ID',
            'filter_pacient_rc',
            'filter_operacia_typ',
            'filter_operacia_subtyp',
            'filter_operacia_strana',
            'filter_pacient_priezvisko',
        ));
    }

    public function showOperacia($id_operacie)
    {


        $womacOperation = WomacOperation::where('id_operation', $id_operacie)
            ->whereNull('closed_at')->get();
        $operation = Operacia::where('id', $id_operacie)->first();


        foreach ($womacOperation as $womOp) {

    //        dd($womacOperation);
            $womac = Womac::where('id', $womOp->id_womac)
                ->whereNull('closed_at')
                ->whereNull('deleted_at')
                ->whereNull('locked_at')->first();

            $womacResult = WomacResult::where('id_womac', $womOp->id_womac)->get();

            foreach ($womacResult as $result) {
                $result->womac()->associate($womac);
            }

            $womOp->womac()->associate($womac);


        }
//        dd($womacOperation->first()->womac->answers);


//        dd($womacOperation->get(0)->womac()->first()->id_womac);
//        dd($womacOperation->get(0));
        return view('export.exportShowOperacia', compact('womacOperation', 'operation'));


    }


    public function exportToExcel()
    {
        $filteredOperacie = Session::get('filteredOperacie');
//        dd($filteredOperacie);

        return Excel::download(new FilteredOperacieExport($filteredOperacie), 'filtered_operacie.xlsx');
    }


}
