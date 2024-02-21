@extends('layouts.app-master')
<link rel="stylesheet" href=" {{ asset("css/sidebar_womac.css") }}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>

@section('content')
    @auth

        <script>
            var createRoute = '{{ url('/') }}' + '/womac/create/'
            var getWomacRoute = '{{ url('/') }}' + '/womac/womac-data/'
            var filterValue = '{{ $filter }}'
            var operationID = 0;
            var sarID = '';
        </script>
        <script src="{{ asset("js/womacOperationCreateMenu.js") }}"></script>
        <script src="{{ asset("js/womacMenu.js") }}"></script>
        <script src="{{ asset("js/womacGetAjax.js") }}"></script>

        @if ($errors->any())
            <div class="alert alert-danger m-3">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    <div class="containerWomac">


        <div class="side-bar">
            <form action="{{ route('womac.filter') }}" method="get">
                @csrf
                @method('GET')
                <div class="flex-container-womac-delete">
                <input type="text" id="filter_input" name="filter_criteria" placeholder="Zadaj Rodné číslo alebo meno" value= "{{ old('filter', $filter) }}">
                <button type="submit">Filter</button>
                </div>
            </form>
            <div class="menu">
{{--                {{ dd($dataPacient) }}--}}
                @foreach($dataPacient as $pacient)
                    <div class="item">
                        <a class="sub-btn nadpisko">
                            {{ $pacient['id'] }}.
                            {{ $pacient['meno'] }}
                            {{ $pacient['priezvisko'] }}
                            {{ $pacient['rc'] }}
                        </a>


                        <div class="sub-menu ">

                            @php

//                                dd($pacient->operacie);
                                $operacieKoleno = $pacient->operacie->where('typ', 1);
                                $operacieBedro = $pacient->operacie->where('typ', 0);

//                                    $operacieBedro = $pacient[0] ?? [];
//                                    $operacieKoleno = $pacient[1] ?? [];
                            @endphp

                            @if(count($operacieKoleno) > 0)

                                <div class="sidebarHeading">
                                    Koleno
                                </div>
                                @foreach($operacieKoleno as $operaciaPacientaK)
                                    <a href="#" class="sub-btn operacie" data-typ="koleno" data-id-operation="{{ $operaciaPacientaK['id'] }}" data-operation="{{ $operaciaPacientaK['sar_id'] }}" data-pacient-id="{{ $pacient['id'] }}">
                                        Operácia {{ $operaciaPacientaK['sar_id'] }} {{ \Carbon\Carbon::createFromFormat('Ymd', $operaciaPacientaK['datum'])->format('Y-m-d') }}
                                    </a>
                                    <div class="sub-menu">

{{--                                        @php--}}
{{--                                            $womacOperations = App\Models\WomacOperation::all();--}}
{{--                                            $uniqueIdWomacValues = $womacOperations--}}
{{--                                                    ->where('id_patient', $pacient->id)--}}
{{--                                                    ->where('id_operation', $operaciaPacientaK->id)--}}
{{--                                                    ->pluck('id_womac')--}}
{{--                                                    ->unique();--}}

{{--                                        @endphp--}}

                                        {{--                                        {{$womacOperations}}--}}
{{--                                        {{$uniqueIdWomacValues}}--}}
{{--                                        {{$operaciaPacientaK->womac}}--}}
{{--                                        @foreach($uniqueIdWomacValues as $idWomac)--}}
                                        @foreach($operaciaPacientaK->womac as $idWomac)
{{--                                            @if($womData = $womac->where('id', $idWomac->id)->first())--}}
                                                <div class="flex-container-womac-delete">

                                                    <a href="#" class="sub-item" data-typ="koleno" data-id="{{ $idWomac->id_womac }}" data-id-operation="{{ $operaciaPacientaK['id'] }}" data-operation="{{ $operaciaPacientaK['sar_id'] }}">
                                                        Womac {{ $idWomac->id_womac }}, {{ $idWomac->date_womac }}

                                                    </a>
{{--                                                    @can(['admin', 'superuser'])--}}
{{--                                                    @if(auth()->user()->is_admin)--}}
                                                        @if(auth()->user()->hasAnyRole(['admin', 'superuser']))
                                                        <form id="deleteForm" action="{{ route('womac.delete', $idWomac->id_womac) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" title="Delete" class="delete-button-womac" data-id="{{ $idWomac->id_womac }}">Delete</button>
                                                        </form>
                                                    @endif
{{--                                                    @endcan--}}
                                                </div>

{{--                                            @endif--}}
                                        @endforeach
                                    </div>
                                @endforeach
                            @endif


                            @if(count($operacieBedro) > 0)
                                <div class="sidebarHeading">
                                    Bedro
                                </div>
                                @foreach($operacieBedro as $operaciaPacientaB)
                                    <a href="#" class="sub-btn operacie" data-typ="bedro" data-id-operation="{{ $operaciaPacientaB['id'] }}" data-operation="{{ $operaciaPacientaB['sar_id'] }} " data-pacient-id="{{ $pacient['id'] }}">
                                        Operácia {{ $operaciaPacientaB['sar_id'] }} {{ \Carbon\Carbon::createFromFormat('Ymd', $operaciaPacientaB['datum'])->format('Y-m-d') }}
                                    </a>

                                    <div class="sub-menu">

{{--                                        @php--}}
{{--                                            $womacOperations = App\Models\WomacOperation::all();--}}
{{--                                            $uniqueIdWomacValues = $womacOperations--}}
{{--                                                    ->where('id_patient', $pacient->id)--}}
{{--                                                    ->where('id_operation', $operaciaPacientaB->id)--}}
{{--                                                    ->pluck('id_womac')--}}
{{--                                                    ->unique()--}}
{{--                                        @endphp--}}

{{--                                        {{$womacOperations}}--}}
{{--                                        @foreach($uniqueIdWomacValues as $idWomac)--}}
                                        @foreach($operaciaPacientaB->womac as $idWomac)
{{--                                            @if($womData = $womac->where('id', $idWomac)->first())--}}
                                                <div class="flex-container-womac-delete">
                                                    <a href="#" class="sub-item" data-typ="bedro" data-id="{{ $idWomac->id_womac }}" data-id-operation="{{ $operaciaPacientaB['id'] }}" data-operation="{{ $operaciaPacientaB['sar_id'] }}">
                                                        Womac {{ $idWomac->id_womac }}, {{ $idWomac->date_womac }}
                                                    </a>
{{--                                                    @if(auth()->user()->is_admin)--}}
{{--                                                    @can(['admin', 'superuser'])--}}
                                                    @if(auth()->user()->hasAnyRole(['admin', 'superuser']))
                                                        <form id="deleteForm" action="{{ route('womac.delete', $idWomac->id_womac) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" title="Delete" class="delete-button-womac" data-id="{{ $idWomac->id_womac }}">Delete</button>
                                                        </form>

                                                    @endif
{{--                                                    @endcan--}}
                                                </div>
{{--                                            @endif--}}
                                        @endforeach
                                    </div>
                                @endforeach

                            @endif
                        </div>

                    </div>
                @endforeach




                {{ $dataPacient->links('pagination::bootstrap-5') }}

            </div>
        </div>





        <div class="womacVpisovanie">
            <div class="nadpisko">
                ID operácie: <span id="sarIdSpan"></span><br>
                ID womac: <span id="womacIdSpan"></span>
            </div>

            <br>

            <div class="menuVpisovanie">

{{--                @include('womac.womacButtons')--}}

            </div>




            <div>
                @include('womac.womacInputForm')



            </div>
        </div>
    </div>
    @endauth
@endsection
