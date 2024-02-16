@extends('layouts.app-master')
<link rel="stylesheet" href=" {{ asset("css/export.css") }}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>

@section('content')
    @auth

{{--hopa--}}

        <div class="womac-container">
{{--            @dd($filteredOperacie)--}}
            <form action="{{ route('export.toExcel') }}" method="post">
                @csrf
                <button type="submit">Export</button>
            </form>
            <form action="{{ route('export.filter') }}" method="get">
                @csrf
                @method('GET')

                <div class="flex-container-womac-delete">
                    <h3>Filter</h3>
                    <label for="filter_operacia_SAR_ID">SAR ID</label>
                    <input type="text" id="filter_operacia_SAR_ID" name="filter_operacia_SAR_ID" placeholder="Zadaj SAR ID" value= "{{ old('filter_operacia_SAR_ID', $filter_operacia_SAR_ID) }}">

{{--                    @dd($filter_operacia_typ, (int)$filter_operacia_typ, $filter_operacia_subtyp)--}}
                    <label for="filter_operacia_typ">Typ operácie:</label>
                    <select name="filter_operacia_typ" id="filter_operacia_typ">
                        <option value="" @if($filter_operacia_typ === null) selected @endif></option>
                        <option value="0" @if($filter_operacia_typ === '0') selected @endif>Bedro</option>
                        <option value="1" @if($filter_operacia_typ === '1') selected @endif>Koleno</option>
                    </select>

{{--                    @dd($filter_operacia_subtyp)--}}
                    <label for="filter_operacia_subtyp">Subtyp operácie:</label>
                    <select name="filter_operacia_subtyp" id="filter_operacia_subtyp">
                        <option value="" @if($filter_operacia_subtyp === null) selected @endif></option>
                        <option value="0" @if($filter_operacia_subtyp === '0') selected @endif>Primárne</option>
                        <option value="1" @if($filter_operacia_subtyp === '1') selected @endif>Revízne</option>
                    </select>

                    <label for="filter_pacient_rc">Pacient rodné číslo</label>
                    <input type="text" id="filter_pacient_rc" name="filter_pacient_rc" placeholder="Zadaj rodné číslo" value= "{{ old('filter_pacient_rc', $filter_pacient_rc) }}">

                    <label for="filter_pacient_priezvisko">Pacient priezvisko</label>
                    <input type="text" id="filter_pacient_priezvisko" name="filter_pacient_priezvisko" placeholder="Zadaj priezvisko" value= "{{ old('filter_pacient_priezvisko', $filter_pacient_priezvisko) }}">


                    <button type="submit">Filter</button>
                </div>
            </form>


            @foreach($filteredOperaciePaginate as $operacia)
                <div class="exportZaznam">
                    <div class="pacient-info-container">
                        <div class="pacient-info">
                            <div class="info-label">Meno:</div>
                            <div class="info-value">{{ $operacia->pacient->meno }}</div>
                        </div>
                        <div class="pacient-info">
                            <div class="info-label">Priezvisko:</div>
                            <div class="info-value">{{ $operacia->pacient->priezvisko }}</div>
                        </div>
                        <div class="pacient-info">
                            <div class="info-label">Rodné číslo:</div>
                            <div class="info-value">{{ $operacia->pacient->rc }}</div>
                        </div>
                    </div>






                        <div class="womac-table">
                            <div class="womac-row">
                                    <div class="womac-cell womac-header">SAR_ID</div>
                                    <div class="womac-cell womac-value">{{ $operacia->sar_id }}</div>
                            </div>
                            <div class="womac-row">
                                    <div class="womac-cell womac-header">typ</div>
                                    <div class="womac-cell womac-value">
        {{--                                {{ $operacia->typ }}--}}
                                        @if($operacia->typ == 0)
                                            Bedro
                                        @elseif($operacia->typ == 1)
                                            Koleno
                                        @endif
                                    </div>
                            </div>
                            <div class="womac-row">
                                    <div class="womac-cell womac-header">subtyp</div>
                                    <div class="womac-cell womac-value">
{{--                                        {{ $operacia->subtyp }}--}}
                                        @if($operacia->subtyp == 0)
                                            Primárne
                                        @elseif($operacia->subtyp == 1)
                                            Revízne
                                        @endif
                                    </div>
                            </div>
                            <div class="womac-row">
                                <div class="womac-cell womac-header">Dátum</div>
                                <div class="womac-cell womac-value">{{ \Carbon\Carbon::createFromFormat('Ymd', $operacia->datum)->format('d.m.Y') }}</div>
                            </div>
                            <div class="womac-row">
                                    <div class="womac-cell womac-header">zobraziť</div>
                                    <div class="womac-cell womac-value"><a href="{{ route('export.operacia', $operacia->id) }}">Zobraz</a></div>
                            </div>
                        </div>


                </div>
            @endforeach
            <div class="pagination-operation">
                @if ($filteredOperaciePaginate instanceof \Illuminate\Pagination\AbstractPaginator)
                    {{ $filteredOperaciePaginate->appends([
                        'filter_operacia_SAR_ID' => $filter_operacia_SAR_ID,
                        'filter_pacient_rc' => $filter_pacient_rc,
                        'filter_operacia_typ' => $filter_operacia_typ,
                        'filter_operacia_subtyp' => $filter_operacia_subtyp,
                        'filter_pacient_priezvisko' => $filter_pacient_priezvisko,
                    ])->links('pagination::bootstrap-5') }}
                @endif
            </div>



        </div>

    @endauth
@endsection
