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
    /**
     * vracia pohľad export.export kde vypíše vo forme záznamov operácie a mená ich pacientov. Operácie sú vypísané pomocou stránkok, medzi ktorými sa dá prepínať. V pohľade sa taktiež vykreslí filter, kde sa na základe rôzných vstupov filtrujú záznamy.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show()
    {

        $filteredOperaciePaginate = Operacia::paginate(10);

        $filter_operacia_SAR_ID = '';
        $filter_pacient_rc = '';
        $filter_operacia_typ = null;
        $filter_operacia_subtyp = null;
        $filter_operacia_strana = null;
        $filter_pacient_priezvisko = '';

        Session::put('filteredOperacie', Operacia::all());

        return view('export.export', compact('filteredOperaciePaginate',
            'filter_operacia_SAR_ID',
            'filter_pacient_rc',
            'filter_operacia_typ',
            'filter_operacia_subtyp',
            'filter_operacia_strana',
            'filter_pacient_priezvisko',
        ));


    }

    /**
     * vracia pohľad export.export kde vypíše podobne ako v show vo forme záznamov operácie a mená ich pacientov na základe kriterií ktoré boli zadané pri filtrovaní.
     * Operácie sú stránkované takže pri väčšom množstve záznamov sa medzi stránkami dá prepínať
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
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


        foreach ($pacientiData as $pacient) {

            $operacie = Operacia::where('id_pac', $pacient->id)
                ->where('sar_id', 'like', "%$filter_operacia_SAR_ID%")
                ->where('typ', 'like', "%$filter_operacia_typ%")
                ->where('subtyp', 'like', "%$filter_operacia_subtyp%")
                ->where('strana', 'like', "%$filter_operacia_strana%")
                ->with('womac');


            $filteredOperacie = $filteredOperacie->merge($operacie->get());

        }


        Session::put('filteredOperacie', $filteredOperacie);



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


        return view('export.export', compact('filteredOperaciePaginate',
            'filter_operacia_SAR_ID',
            'filter_pacient_rc',
            'filter_operacia_typ',
            'filter_operacia_subtyp',
            'filter_operacia_strana',
            'filter_pacient_priezvisko',
        ));
    }

    /**
     * vracia pohľad export.exportShowOperacia kde sa zobrazuje konkrétne rozkliknutá operácia a údaje k nej.
     * K vypisovaným údajom patrí samotná operácia, operovaný pacient a aj všetky dotazníky womac k danej operacií spolu s ich výsledkami.
     *
     * @param $id_operacie
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showOperacia($id_operacie)
    {


        $womacOperation = WomacOperation::where('id_operation', $id_operacie)
            ->whereNull('closed_at')->get();
        $operation = Operacia::where('id', $id_operacie)->first();



        return view('export.exportShowOperacia', compact('womacOperation', 'operation'));
    }

    /**
     * preberie zoznam vyfiltrovaných operacií zo Seassion a následne na základe predom definovaných kriterií vytvorí excel súbor s hodnotami aktuálnych operacií.
     * Vytvorený excel sa následne používateľovi stiahne v prehliadači v podobe excel súboru, s ktorým je následne možné ďalej pracovať.
     * Logika ku vytváraniu excelu sa volá FilteredOperacieExport a nachádza sa v podadresári Exports v adresári app.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportToExcel()
    {
        $filteredOperacie = Session::get('filteredOperacie');

        return Excel::download(new FilteredOperacieExport($filteredOperacie), 'filtered_operacie.xlsx');
    }
}
