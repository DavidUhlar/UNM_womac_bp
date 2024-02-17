<?php

namespace App\Exports;

use App\Models\Operacia;
use App\Models\Pacient;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class FilteredOperacieExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    private $filteredOperacie;


    public function __construct(Collection $filteredOperacie)
    {

        $this->filteredOperacie = $filteredOperacie;
    }

    public function collection()
    {
        $data = collect();

        foreach ($this->filteredOperacie as $operacia) {
            $pacient = $operacia->pacient;

            if ($operacia->womac->isEmpty()) {
                $data->push([
                    'Operacia SAR ID' => $operacia->sar_id,
                    'typ' => ($operacia->typ === 0) ? "bedro" : "koleno",
                    'subtyp' => ($operacia->subtyp === 0) ? "primárne" : "revízne",
                    'dátum operácie' => \Carbon\Carbon::createFromFormat('Ymd', $operacia->datum)->format('Y-m-d'),
                    'Meno pacienta' => $pacient->meno,
                    'Priezvisko pacienta' => $pacient->priezvisko,
                    'Rod. číslo pacienta' => $pacient->rc,
                    'Womac id' => "",
                    'Womac dátum' => "",
                    'Dátum kontroly' => "",
                    'hhs' => "",
                    'kss1' => "",
                    'kss2' => "",
                    'avg' => "",
                ]);

            } else {
                foreach ($operacia->womac as $womac) {
    //                dd($womac->result);
                    $rowData = [
                        'Operacia SAR ID' => $operacia->sar_id,
                        'typ' =>  ($operacia->typ === 0) ? "bedro" : "koleno",
                        'subtyp' => ($operacia->subtyp === 0) ? "primárne" : "revízne",
                        'dátum operácie' =>  \Carbon\Carbon::createFromFormat('Ymd', $operacia->datum)->format('Y-m-d'),
                        'Meno pacienta' => $pacient->meno,
                        'Priezvisko pacienta' => $pacient->priezvisko,
                        'Rod. číslo pacienta' => $pacient->rc,
                        'Womac id' => $womac->id_womac,
                        'Womac dátum' => $womac->date_womac,
                        'Dátum kontroly' => $womac->date_visit,

                    ];


                    for ($i = 1; $i <= 24; $i++) {
                        $answerKey = str_pad($i, 2, '0', STR_PAD_LEFT);
                        $rowData[$answerKey] = $womac->{'answer_' . $answerKey};
                    }

                    $results = [
                        'hhs' => "-",
                        'kss1' => "-",
                        'kss2' => "-",
                        'avg' => "",
                    ];

    //                dd($womac->result);
                    foreach ($womac->result as $resultLocal) {
                        switch ($resultLocal->result_name) {
                            case 'hhs':
                                $results['hhs'] = $resultLocal->result_value;
                                break;
                            case 'kss1':
                                $results['kss1'] = $resultLocal->result_value;
                                break;
                            case 'kss2':
                                $results['kss2'] = $resultLocal->result_value;
                                break;
                            case 'avg':
                                $results['avg'] = $resultLocal->result_value;
                                break;
                        }
                    }

                    $rowData = array_merge($rowData, $results);

                    $data->push($rowData);
                }
            }
        }

        return $data;
    }

    public function headings(): array
    {
        $headings = [
            'Operacia SAR ID',
            'typ',
            'subtyp',
            'dátum operácie',
            'Meno pacienta',
            'Priezvisko pacienta',
            'Rod. číslo pacienta',
            'Womac id',
            'Womac dátum',
            'Dátum kontroly',
        ];


        for ($i = 1; $i <= 24; $i++) {
            $answerKey = str_pad($i, 2, '0', STR_PAD_LEFT);
            $headings[] = $answerKey;
        }
        $resultHeadings = [
            'hhs',
            'kss1',
            'kss2',
            'avg',
        ];

        $headings = array_merge($headings, $resultHeadings);

        return $headings;
    }

    public function styles(Worksheet $sheet)
    {

        $sheet->getStyle('A1:' . $sheet->getHighestColumn() . '1')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
        ]);
    }
}
