@extends('layouts.app-master')
{{--<link rel="stylesheet" href=" {{ asset("css/sidebar_womac.css") }}">--}}
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
        <script src="{{ asset("js/womacInputValidacia.js") }}"></script>
        <script src="{{ asset("js/alert.js") }}"></script>

        @if(session('error'))
            <div id="error-alert" class="alert alert-danger">
                {{ session('error') }}
            </div>

        @endif
        @if(session('success'))
            <div id="success-alert" class="alert alert-success">
                {{ session('success') }}
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


{{--            Inspiracia na dropdown menu: https://foolishdeveloper.com/sidebar-dropdown-menu-using-html-css-javascript/ --}}
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
                                $operacieKoleno = $pacient->operacie->where('typ', 1)->sortBy(['subtyp', 'strana', 'group_id', 'op_no']);
                                $operacieBedro = $pacient->operacie->where('typ', 0)->sortBy(['subtyp', 'strana', 'group_id', 'op_no']);
                            @endphp

                            @if(count($operacieKoleno) > 0)
                                @php
                                    $operacieKolenoPrave = $operacieKoleno->where('strana', 1);
                                    $operacieKolenoLave = $operacieKoleno->where('strana', 0);
                                @endphp

                                <div class="sidebarHeading">
                                    Koleno
                                </div>
                                @if(count($operacieKolenoPrave) > 0)
                                    <div class="sidebarSubHeading">
                                        Pravé
                                    </div>
                                    @foreach($operacieKolenoPrave as $operaciaPacientaK)
                                        <a href="#" class="sub-btn operacie" data-typ="koleno" data-id-operation="{{ $operaciaPacientaK['id'] }}" data-operation="{{ $operaciaPacientaK['sar_id'] }}" data-pacient-id="{{ $pacient['id'] }}">
                                            Operácia {{ $operaciaPacientaK['sar_id'] }} {{ \Carbon\Carbon::createFromFormat('Ymd', $operaciaPacientaK['datum'])->format('Y-m-d') }}
                                        </a>
                                        <div class="sub-menu">
                                            @foreach($operaciaPacientaK->womac->whereNull('closed_at')->whereNull('deleted_at') as $idWomac)
                                                    <div class="flex-container-womac-delete">

                                                        <a href="#" class="sub-item" data-typ="koleno" data-id="{{ $idWomac->id_womac }}" data-id-operation="{{ $operaciaPacientaK['id'] }}" data-operation="{{ $operaciaPacientaK['sar_id'] }}">
                                                            Womac {{ $idWomac->id_womac }}, {{ $idWomac->date_womac }}
                                                        </a>
                                                            @if(auth()->user()->hasAnyRole(['admin', 'superuser']))
                                                            <form id="deleteForm" action="{{ route('womac.delete', $idWomac->id_womac) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" title="Delete" class="delete-button-womac" data-id="{{ $idWomac->id_womac }}">Delete</button>
                                                            </form>
                                                        @endif
                                                    </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                @endif
                                @if(count($operacieKolenoLave) > 0)
                                    <div class="sidebarSubHeading">
                                        Ľavé
                                    </div>

                                    @foreach($operacieKolenoLave as $operaciaPacientaK)
                                        <a href="#" class="sub-btn operacie" data-typ="koleno" data-id-operation="{{ $operaciaPacientaK['id'] }}" data-operation="{{ $operaciaPacientaK['sar_id'] }}" data-pacient-id="{{ $pacient['id'] }}">
                                            Operácia {{ $operaciaPacientaK['sar_id'] }} {{ \Carbon\Carbon::createFromFormat('Ymd', $operaciaPacientaK['datum'])->format('Y-m-d') }}
                                        </a>
                                        <div class="sub-menu">
                                            @foreach($operaciaPacientaK->womac->whereNull('closed_at')->whereNull('deleted_at') as $idWomac)

                                                <div class="flex-container-womac-delete">

                                                    <a href="#" class="sub-item" data-typ="koleno" data-id="{{ $idWomac->id_womac }}" data-id-operation="{{ $operaciaPacientaK['id'] }}" data-operation="{{ $operaciaPacientaK['sar_id'] }}">
                                                        Womac {{ $idWomac->id_womac }}, {{ $idWomac->date_womac }}

                                                    </a>
                                                    @if(auth()->user()->hasAnyRole(['admin', 'superuser']))
                                                        <form id="deleteForm" action="{{ route('womac.delete', $idWomac->id_womac) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" title="Delete" class="delete-button-womac" data-id="{{ $idWomac->id_womac }}">Delete</button>
                                                        </form>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                @endif
                            @endif



                            @if(count($operacieBedro) > 0)
                                @php
                                    $operacieBedroPrave = $operacieBedro->where('strana', 1);
                                    $operacieBedroLave = $operacieBedro->where('strana', 0);
                                @endphp
                                <div class="sidebarHeading">
                                    Bedro
                                </div>
                                @if(count($operacieBedroPrave) > 0)
                                    <div class="sidebarSubHeading">
                                        Pravé
                                    </div>
                                    @foreach($operacieBedroPrave as $operaciaPacientaB)
                                        <a href="#" class="sub-btn operacie" data-typ="bedro" data-id-operation="{{ $operaciaPacientaB['id'] }}" data-operation="{{ $operaciaPacientaB['sar_id'] }} " data-pacient-id="{{ $pacient['id'] }}">
                                            Operácia {{ $operaciaPacientaB['sar_id'] }} {{ \Carbon\Carbon::createFromFormat('Ymd', $operaciaPacientaB['datum'])->format('Y-m-d') }}
                                        </a>

                                        <div class="sub-menu">

                                            @foreach($operaciaPacientaB->womac->whereNull('closed_at')->whereNull('deleted_at') as $idWomac)
                                                    <div class="flex-container-womac-delete">
                                                        <a href="#" class="sub-item" data-typ="bedro" data-id="{{ $idWomac->id_womac }}" data-id-operation="{{ $operaciaPacientaB['id'] }}" data-operation="{{ $operaciaPacientaB['sar_id'] }}">
                                                            Womac {{ $idWomac->id_womac }}, {{ $idWomac->date_womac }}
                                                        </a>
                                                        @if(auth()->user()->hasAnyRole(['admin', 'superuser']))
                                                            <form id="deleteForm" action="{{ route('womac.delete', $idWomac->id_womac) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" title="Delete" class="delete-button-womac" data-id="{{ $idWomac->id_womac }}">Delete</button>
                                                            </form>

                                                        @endif

                                                    </div>

                                            @endforeach
                                        </div>
                                    @endforeach
                                @endif

                                @if(count($operacieBedroLave) > 0)
                                    <div class="sidebarSubHeading">
                                        Ľavé
                                    </div>
                                    @foreach($operacieBedroLave as $operaciaPacientaB)
                                        <a href="#" class="sub-btn operacie" data-typ="bedro" data-id-operation="{{ $operaciaPacientaB['id'] }}" data-operation="{{ $operaciaPacientaB['sar_id'] }} " data-pacient-id="{{ $pacient['id'] }}">
                                            Operácia {{ $operaciaPacientaB['sar_id'] }} {{ \Carbon\Carbon::createFromFormat('Ymd', $operaciaPacientaB['datum'])->format('Y-m-d') }}
                                        </a>

                                        <div class="sub-menu">

                                            @foreach($operaciaPacientaB->womac->whereNull('closed_at')->whereNull('deleted_at') as $idWomac)
                                                <div class="flex-container-womac-delete">
                                                    <a href="#" class="sub-item" data-typ="bedro" data-id="{{ $idWomac->id_womac }}" data-id-operation="{{ $operaciaPacientaB['id'] }}" data-operation="{{ $operaciaPacientaB['sar_id'] }}">
                                                        Womac {{ $idWomac->id_womac }}, {{ $idWomac->date_womac }}
                                                    </a>
                                                    @if(auth()->user()->hasAnyRole(['admin', 'superuser']))
                                                        <form id="deleteForm" action="{{ route('womac.delete', $idWomac->id_womac) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" title="Delete" class="delete-button-womac" data-id="{{ $idWomac->id_womac }}">Delete</button>
                                                        </form>

                                                    @endif

                                                </div>

                                            @endforeach
                                        </div>
                                    @endforeach
                                @endif
                            @endif
                        </div>

                    </div>
                @endforeach
            </div>
            <div class="sidebarPageHeading">
                <div class="paginationPacient" style="color: red;">
                    {{ $dataPacient->onEachSide(2)->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>





        <div class="womacVpisovanie">
            <div class="nadpisko">
                ID operácie: <span id="sarIdSpan"></span><br>
                ID womac: <span id="womacIdSpan"></span>
            </div>
            <br>
            <div class="menuVpisovanie">
                @include('womac.womacInputForm')
            </div>
        </div>
    </div>
    @endauth
@endsection
