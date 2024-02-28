@extends('layouts.app-master')
<link rel="stylesheet" href=" {{ asset("css/export.css") }}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

@section('content')
    @auth

{{--hopa--}}

        <div class="womac-container">
{{--            @dd($filteredOperacie)--}}
            <form action="{{ route('export.toExcel') }}" method="post">
                @csrf
                <button class="btn btn-success" type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24" width="18" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#ffffff" d="M48 448V64c0-8.8 7.2-16 16-16H224v80c0 17.7 14.3 32 32 32h80V448c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16zM64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V154.5c0-17-6.7-33.3-18.7-45.3L274.7 18.7C262.7 6.7 246.5 0 229.5 0H64zm90.9 233.3c-8.1-10.5-23.2-12.3-33.7-4.2s-12.3 23.2-4.2 33.7L161.6 320l-44.5 57.3c-8.1 10.5-6.3 25.5 4.2 33.7s25.5 6.3 33.7-4.2L192 359.1l37.1 47.6c8.1 10.5 23.2 12.3 33.7 4.2s12.3-23.2 4.2-33.7L222.4 320l44.5-57.3c8.1-10.5 6.3-25.5-4.2-33.7s-25.5-6.3-33.7 4.2L192 280.9l-37.1-47.6z"/></svg>
                     Export
                </button>
            </form>
            <form action="{{ route('export.filter') }}" method="get">
                @csrf
                @method('GET')
                <h3>Filter</h3>
                <div class="flex-container-filter">

                    <div class="filter_export">
                        <label for="filter_operacia_SAR_ID">SAR ID</label>
                        <input type="text" id="filter_operacia_SAR_ID" name="filter_operacia_SAR_ID" placeholder="Zadaj SAR ID" value= "{{ old('filter_operacia_SAR_ID', $filter_operacia_SAR_ID) }}">
                    </div>
{{--                    @dd($filter_operacia_typ, (int)$filter_operacia_typ, $filter_operacia_subtyp)--}}
                    <div class="filter_export">
                        <label for="filter_operacia_typ">Typ operácie:</label>
                        <select name="filter_operacia_typ" id="filter_operacia_typ">
                            <option value="" @if($filter_operacia_typ === null) selected @endif></option>
                            <option value="0" @if($filter_operacia_typ === '0') selected @endif>Bedro</option>
                            <option value="1" @if($filter_operacia_typ === '1') selected @endif>Koleno</option>
                        </select>
                    </div>

{{--                    @dd($filter_operacia_subtyp)--}}
                    <div class="filter_export">
                        <label for="filter_operacia_subtyp">Subtyp operácie:</label>
                        <select name="filter_operacia_subtyp" id="filter_operacia_subtyp">
                            <option value="" @if($filter_operacia_subtyp === null) selected @endif></option>
                            <option value="0" @if($filter_operacia_subtyp === '0') selected @endif>Primárne</option>
                            <option value="1" @if($filter_operacia_subtyp === '1') selected @endif>Revízne</option>
                        </select>
                    </div>

                    <div class="filter_export">
                        <label for="filter_operacia_strana">Strana operácie:</label>
                        <select name="filter_operacia_strana" id="filter_operacia_strana">
                            <option value="" @if($filter_operacia_strana === null) selected @endif></option>
                            <option value="0" @if($filter_operacia_strana === '0') selected @endif>Ľavá</option>
                            <option value="1" @if($filter_operacia_strana === '1') selected @endif>Pravá</option>
                        </select>
                    </div>

                    <div class="filter_export">
                        <label for="filter_pacient_rc">Pacient rodné číslo</label>
                        <input type="text" id="filter_pacient_rc" name="filter_pacient_rc" placeholder="Zadaj rodné číslo" value= "{{ old('filter_pacient_rc', $filter_pacient_rc) }}">
                    </div>
                    <div class="filter_export">
                        <label for="filter_pacient_priezvisko">Pacient priezvisko</label>
                        <input type="text" id="filter_pacient_priezvisko" name="filter_pacient_priezvisko" placeholder="Zadaj priezvisko" value= "{{ old('filter_pacient_priezvisko', $filter_pacient_priezvisko) }}">
                    </div>

                    <div class="filter_export">
                        <button type="submit">Filter</button>
                    </div>
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
                                <div class="womac-cell womac-header">strana</div>
                                <div class="womac-cell womac-value">
                                    {{--                                        {{ $operacia->subtyp }}--}}
                                    @if($operacia->strana == 0)
                                        Ľavá
                                    @elseif($operacia->strana == 1)
                                        Pravá
                                    @endif
                                </div>
                            </div>
                            <div class="womac-row">
                                <div class="womac-cell womac-header">Dátum</div>
                                <div class="womac-cell womac-value">{{ \Carbon\Carbon::createFromFormat('Ymd', $operacia->datum)->format('d.m.Y') }}</div>
                            </div>
                            <div class="womac-row">
                                    <div class="womac-cell womac-header">zobraziť</div>
                                    <div class="womac-cell womac-value"><a href="{{ route('export.operacia', $operacia->id) }}" class="zobrazOperaciu">Zobraz</a></div>
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
                @else
                    {{ $filteredOperaciePaginate->links('pagination::bootstrap-5') }}
                @endif


            </div>



        </div>

    @endauth
@endsection
