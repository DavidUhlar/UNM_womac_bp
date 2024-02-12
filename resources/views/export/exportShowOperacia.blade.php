@extends('layouts.app-master')
<link rel="stylesheet" href=" {{ asset("css/export.css") }}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>

@section('content')
    @auth
{{--        @dd($womacOperation->isEmpty())--}}
        hopa operacia<br>
        {{ $operation->sar_id  }}
        {{ $operation->typ  }}
        {{ $operation->subtyp  }}
        {{ $operation->datum  }}
        {{ $operation->id_prac  }}

        <br>
        WOMACS
        <br>

        @if(!$womacOperation->isEmpty())
            <div class="womac-container">
                @foreach($womacOperation as $womacOperationLocal)
                    <div class="womac-table">
                        <div class="womac-row">
                            <div class="womac-cell womac-header">Dátum womac</div>
                            <div class="womac-cell womac-value">{{ $womacOperationLocal->womac->date_womac }}</div>
                        </div>
                        <div class="womac-row">
                            <div class="womac-cell womac-header">Dátum kontroly</div>
                            <div class="womac-cell womac-value">{{ $womacOperationLocal->womac->date_visit }}</div>
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
