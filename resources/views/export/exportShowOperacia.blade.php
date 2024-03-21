@extends('layouts.app-master')
<link rel="stylesheet" href=" {{ asset("css/export.css") }}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>

@section('content')
    @auth

        <div class="womac-container">
            <a href="{{ url()->previous() }}" class="zobrazOperaciu">Návrat</a>
            <h4>Operacia</h4>
            <div class="womac-table">
                <div class="womac-row">
                    <div class="womac-cell womac-header">SAR ID</div>
                    <div class="womac-cell womac-value">{{ $operation->sar_id  }}</div>
                </div>
                <div class="womac-row">
                    <div class="womac-cell womac-header">Typ</div>
                    <div class="womac-cell womac-value">
                        @if($operation->typ == 0)
                            Bedro
                        @elseif($operation->typ == 1)
                            Koleno
                        @endif
                    </div>
                </div>
                <div class="womac-row">
                    <div class="womac-cell womac-header">Subtyp</div>
                    <div class="womac-cell womac-value">
                        @if($operation->subtyp == 0)
                            Primárne
                        @elseif($operation->subtyp == 1)
                            Revízne
                        @endif
                    </div>
                </div>
                <div class="womac-row">
                    <div class="womac-cell womac-header">strana</div>
                    <div class="womac-cell womac-value">
                        @if($operation->strana == 0)
                            Ľavá
                        @elseif($operation->strana == 1)
                            Pravá
                        @endif
                    </div>
                </div>
                <div class="womac-row">
                    <div class="womac-cell womac-header">Dátum</div>
                    <div class="womac-cell womac-value">{{ \Carbon\Carbon::createFromFormat('Ymd', $operation->datum)->format('d.m.Y') }}</div>
                </div>
                <div class="womac-row">
                    <div class="womac-cell womac-header">ID pracoviska</div>
                    <div class="womac-cell womac-value">{{ $operation->id_prac  }}</div>
                </div>

            </div>
        </div>
<div class="womac-container">

    <h4>Pacient</h4>
    <div class="womac-table">
        <div class="womac-row">
            <div class="womac-cell womac-header">Meno</div>
            <div class="womac-cell womac-value">{{ $operation->pacient->meno  }}</div>
        </div>
        <div class="womac-row">
            <div class="womac-cell womac-header">Priezvisko</div>
            <div class="womac-cell womac-value">{{ $operation->pacient->priezvisko  }}</div>
        </div>
        <div class="womac-row">
            <div class="womac-cell womac-header">Rodné číslo</div>
            <div class="womac-cell womac-value">{{ $operation->pacient->rc  }}</div>
        </div>
        <div class="womac-row">
            <div class="womac-cell womac-header">Adresa ulica</div>
            <div class="womac-cell womac-value">{{ $operation->pacient->adr_ulica  }}</div>
        </div>
        <div class="womac-row">
            <div class="womac-cell womac-header">Adresa mesto</div>
            <div class="womac-cell womac-value">{{ $operation->pacient->adr_mesto  }}</div>
        </div>
        <div class="womac-row">
            <div class="womac-cell womac-header">Adresa PSČ</div>
            <div class="womac-cell womac-value">{{ $operation->pacient->adr_psc  }}</div>
        </div>
        <div class="womac-row">
            <div class="womac-cell womac-header">Telefónne číslo</div>
            <div class="womac-cell womac-value">{{ $operation->pacient->tel }}</div>
        </div>
        <div class="womac-row">
            <div class="womac-cell womac-header">Pohlavie</div>
            <div class="womac-cell womac-value">
                @if($operation->pacient->pohl == 0 && $operation->pacient->pohl)
                    Žena
                @elseif($operation->pacient->pohl == 1 && $operation->pacient->pohl)
                    Muž
                @else
                    {{ "" }}
                @endif
            </div>
        </div>

    </div>
</div>

        @if(!$womacOperation->isEmpty())
            <div class="womac-container">
                <h4>WOMAC</h4>

                @foreach($womacOperation as $womacOperationLocal)
                    <div class="womac-table">
                        <div class="womac-row">
                            <div class="womac-cell womac-header">Dátum womac</div>
                            <div class="womac-cell womac-value">{{ \Carbon\Carbon::createFromFormat('Y-m-d', $womacOperationLocal->womac->date_womac)->format('d.m.Y') }}</div>
                        </div>
                        <div class="womac-row">
                            <div class="womac-cell womac-header">Dátum kontroly</div>
                            <div class="womac-cell womac-value">{{ \Carbon\Carbon::createFromFormat('Y-m-d', $womacOperationLocal->womac->date_visit)->format('d.m.Y') }}</div>
                        </div>

                        @for($i = 1; $i <= 24; $i++)
                            <div class="womac-row">
                                <div class="womac-cell womac-header">{{ $i }}</div>
                                <div class="womac-cell womac-value">
                                    {{ $womacOperationLocal->womac->answers
                                        ->whereNull('closed_at')
                                        ->whereNull('deleted_at')->first()
                                        ->{'answer_' . str_pad($i, 2, '0', STR_PAD_LEFT)} }}
                                </div>
                            </div>
                        @endfor

                        @foreach($womacOperationLocal->womac->result as $result)
                            <div class="womac-row">
                                <div class="womac-cell womac-header">{{ $result->result_name }}</div>
                                <div class="womac-cell womac-value">{{ $result->result_value }}</div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>

        @endif

    @endauth
@endsection
