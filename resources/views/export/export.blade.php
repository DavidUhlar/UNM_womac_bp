@extends('layouts.app-master')
<link rel="stylesheet" href=" {{ asset("css/export.css") }}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>

@section('content')
    @auth





{{--hopa--}}




<div class="womac-container">
    @foreach($pacientiData as $pacient)
        <div class="exportZaznam">
            <div class="pacient-info">
                <div class="info-label">Meno:</div>
                <div class="info-value">{{ $pacient->meno }}</div>
            </div>
            <div class="pacient-info">
                <div class="info-label">Priezvisko:</div>
                <div class="info-value">{{ $pacient->priezvisko }}</div>
            </div>
            <div class="pacient-info">
                <div class="info-label">Rodné číslo:</div>
                <div class="info-value">{{ $pacient->rc }}</div>
            </div>




            @foreach($pacient->operacie as $operacia)
                <div class="womac-table">
                    <div class="womac-row">
                            <div class="womac-cell womac-header">SAR_ID</div>
                            <div class="womac-cell womac-value">{{ $operacia->sar_id }}</div>
                    </div>
                    <div class="womac-row">
                            <div class="womac-cell womac-header">typ</div>
                            <div class="womac-cell womac-value">{{ $operacia->typ }}</div>
                    </div>
                    <div class="womac-row">
                            <div class="womac-cell womac-header">subtyp</div>
                            <div class="womac-cell womac-value">{{ $operacia->subtyp }}</div>
                    </div>
                    <div class="womac-row">
                            <div class="womac-cell womac-header">zobraziť</div>
                            <div class="womac-cell womac-value"><a href="{{ route('export.operacia', $operacia->id) }}">Zobraz</a></div>
                    </div>
                </div>
            @endforeach

        </div>
    @endforeach
</div>

    @endauth
@endsection
