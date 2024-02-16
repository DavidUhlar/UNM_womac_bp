@extends('layouts.app-master')
<link rel="stylesheet" href=" {{ asset("css/export.css") }}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>

@section('content')
    @auth
{{--        @dd($womacOperation->isEmpty())--}}



        <div class="womac-container">
            <a href="{{ url()->previous() }}">Návrat</a>
            <h4>Operacia</h4>
            <div class="womac-table">
                <div class="womac-row">
                    <div class="womac-cell womac-header">SAR ID</div>
                    <div class="womac-cell womac-value">{{ $operation->sar_id  }}</div>
                </div>
                <div class="womac-row">
                    <div class="womac-cell womac-header">Typ</div>
                    <div class="womac-cell womac-value">
{{--                        {{ $operation->typ  }}--}}
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
{{--                        {{ $operation->subtyp  }}--}}
                        @if($operation->subtyp == 0)
                            Primárne
                        @elseif($operation->subtyp == 1)
                            Revízne
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



{{--@dd($womacOperation)--}}
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
                                <div class="womac-cell womac-value">{{ $womacOperationLocal->womac->{'answer_' . str_pad($i, 2, '0', STR_PAD_LEFT)} }}</div>
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
