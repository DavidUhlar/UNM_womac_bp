@extends('layouts.app-master')
<link rel="stylesheet" href=" {{ asset("css/sidebar_womac.css") }}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>

@section('content')
    @auth

        <script>
            var createRoute = '{{ url('/') }}' + '/womac/create/'
            var getWomacRoute = '{{ url('/') }}' + '/womac/womac-data/'
            var filterValue = '{{ $filter }}'
        </script>
        <script src="{{ asset("js/womacOperationCreateMenu.js") }}"></script>
        <script src="{{ asset("js/womacMenu.js") }}"></script>
        <script src="{{ asset("js/womacGetAjax.js") }}"></script>


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

                                        @php
                                            $womacOperations = App\Models\WomacOperation::all();
                                            $uniqueIdWomacValues = $womacOperations
                                                    ->where('id_patient', $pacient->id)
                                                    ->where('id_operation', $operaciaPacientaK->id)
                                                    ->pluck('id_womac')
                                                    ->unique()
                                        @endphp

                                        {{--                                        {{$womacOperations}}--}}
                                        @foreach($uniqueIdWomacValues as $idWomac)
                                            @if($womData = $womac->where('id_womac', $idWomac)->first())
                                                <div class="flex-container-womac-delete">
                                                    <a href="#" class="sub-item" data-typ="koleno" data-id="{{ $womData->id_womac }}">
                                                        Womac {{ $womData->id_womac }}, {{ $womData->date_womac }}
                                                    </a>
                                                    <form id="deleteForm" action="{{ route('womac.delete', $womData->id_womac) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" title="Delete" class="delete-button-womac" data-id="{{ $womData->id_womac }}">Delete</button>
                                                    </form>
                                                </div>

                                            @endif
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

                                        @php
                                            $womacOperations = App\Models\WomacOperation::all();
                                            $uniqueIdWomacValues = $womacOperations
                                                    ->where('id_patient', $pacient->id)
                                                    ->where('id_operation', $operaciaPacientaB->id)
                                                    ->pluck('id_womac')
                                                    ->unique()
                                        @endphp

{{--                                        {{$womacOperations}}--}}
                                        @foreach($uniqueIdWomacValues as $idWomac)
                                            @if($womData = $womac->where('id_womac', $idWomac)->first())
                                                <div class="flex-container-womac-delete">
                                                    <a href="#" class="sub-item" data-typ="bedro" data-id="{{ $womData->id_womac }}">
                                                        Womac {{ $womData->id_womac }}, {{ $womData->date_womac }}
                                                    </a>
                                                    <form id="deleteForm" action="{{ route('womac.delete', $womData->id_womac) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" title="Delete" class="delete-button-womac" data-id="{{ $womData->id_womac }}">Delete</button>
                                                    </form>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                @endforeach

                            @endif
                        </div>

                    </div>
                @endforeach





            </div>
        </div>


{{--        <script>--}}
{{--            $(document).ready(function () {--}}
{{--                $('.delete-button').click(function () {--}}
{{--                    var idWomac = $(this).data('id');--}}
{{--                    var confirmDelete = confirm('Chcete naozaj odstrániť?');--}}

{{--                    if (confirmDelete) {--}}

{{--                        $('#deleteForm').attr('action', '{{ route("womac.delete", ":id") }}'.replace(':id', idWomac));--}}
{{--                        $('#deleteForm').submit();--}}
{{--                    } else {--}}

{{--                        return false;--}}
{{--                    }--}}
{{--                });--}}
{{--            });--}}
{{--        </script>--}}

{{--        <script type="text/javascript">--}}
{{--            $(document).ready(function () {--}}
{{--                $('.sub-btn').click(function () {--}}
{{--                    var subMenu = $(this).next('.sub-menu');--}}
{{--                    subMenu.slideToggle();--}}
{{--                    $(this).toggleClass('activeMenu');--}}


{{--                    var parentItem = $(this).closest('.item');--}}


{{--                    parentItem.siblings().find('.sub-menu').slideUp();--}}
{{--                    parentItem.siblings().find('.sub-btn').removeClass('activeMenu');--}}
{{--                });--}}
{{--            });--}}

{{--            $(document).ready(function () {--}}
{{--                $('.sub-btn.operacie').click(function () {--}}
{{--                    console.log('Click event triggered');--}}
{{--                    var sarID = $(this).data('operation');--}}
{{--                    var operationID = $(this).data('id-operation');--}}
{{--                    var typOperacie = $(this).data('typ');--}}

{{--                    console.log('Clicked operation:', sarID);--}}
{{--                    console.log('Clicked operation id:', operationID);--}}

{{--                    operationIdFromJavaScript = sarID;--}}

{{--                    if (typOperacie === 'bedro') {--}}
{{--                        $('#kss1-div').hide();--}}
{{--                        $('#kss2-div').hide();--}}
{{--                        $('#hhs-div').show();--}}

{{--                        $('.inputAndLabel #hhs').show();--}}
{{--                        $('.inputAndLabel #kss1').hide();--}}
{{--                        $('.inputAndLabel #kss2').hide();--}}
{{--                        $('.inputAndLabel label[for="kss1"]').hide();--}}
{{--                        $('.inputAndLabel label[for="kss2"]').hide();--}}
{{--                        $('.inputAndLabel label[for="hhs"]').show();--}}
{{--                        $('input[name="kss1"]').val(null);--}}
{{--                        $('input[name="kss2"]').val(null);--}}
{{--                    } else {--}}
{{--                        $('#kss1-div').show();--}}
{{--                        $('#kss2-div').show();--}}
{{--                        $('#hhs-div').hide();--}}

{{--                        $('.inputAndLabel #kss1').show();--}}
{{--                        $('.inputAndLabel #kss2').show();--}}
{{--                        $('.inputAndLabel #hhs').hide();--}}
{{--                        $('.inputAndLabel label[for="kss1"]').show();--}}
{{--                        $('.inputAndLabel label[for="kss2"]').show();--}}
{{--                        $('.inputAndLabel label[for="hhs"]').hide();--}}
{{--                        $('input[name="hhs"]').val(null);--}}
{{--                    }--}}
{{--                    $('.vpisovanieDat').show();--}}

{{--                    $('#hiddenOperationIdInput').val(operationID);--}}
{{--                    // var currentPath = window.location.pathname;--}}
{{--                    // console.log(currentPath);--}}
{{--                    --}}{{--console.log('{{ url('/') }}' + '/womac/create/');--}}
{{--                    console.log(createRoute + operationID);--}}
{{--                    // var formAction = '/unm_womac_bp/public/womac/create/' + operationID;--}}
{{--                    var formAction = createRoute + operationID;--}}
{{--                    --}}{{--var formAction = @json(route("womac.create")) + operationID;--}}
{{--                    $('.vpisovanieDat').attr('action', formAction);--}}



{{--                    $('input[type="text"]').val('');--}}
{{--                    $('input[type="date"]').val('');--}}
{{--                    document.getElementById('id_womac').value = 0;--}}
{{--                    $('input[name="hhs"]').val(null);--}}
{{--                    $('input[name="kss1"]').val(null);--}}
{{--                    $('input[name="kss2"]').val(null);--}}
{{--                    updateMode = !updateMode;--}}
{{--                    updateContent();--}}
{{--                });--}}

{{--                function updateContent() {--}}
{{--                    document.getElementById('sarIdSpan').innerText = operationIdFromJavaScript;--}}
{{--                    document.getElementById('womacIdSpan').innerText = "";--}}
{{--                }--}}
{{--            });--}}

{{--        </script>--}}




{{--        <script>--}}
{{--            var updateMode = false;--}}
{{--            $(document).ready(function () {--}}


{{--                $('.sub-item').click(function (e) {--}}
{{--                    e.preventDefault();--}}

{{--                    var idWomac = $(this).data('id');--}}
{{--                    var typ = $(this).data('typ');--}}
{{--                    console.log(idWomac);--}}

{{--                    womacIdFromJavaScript = idWomac;--}}

{{--                    if (updateMode) {--}}
{{--                        $.ajax({--}}
{{--                            url: '{{ route("womac.getWomac", ["id_womac" => ":id"]) }}'.replace(':id', idWomac),--}}
{{--                            type: 'GET',--}}
{{--                            dataType: 'json',--}}
{{--                            success: function (data) {--}}
{{--                                console.log('data:', data);--}}

{{--                                $('input[name="id_womac"]').val(data.id_womac);--}}
{{--                                $('input[name="date_womac"]').val(data.date_womac);--}}
{{--                                $('input[name="date_visit"]').val(data.date_visit);--}}
{{--                                $('input[name="answer_01"]').val(data.answer_01);--}}
{{--                                $('input[name="answer_02"]').val(data.answer_02);--}}
{{--                                $('input[name="answer_03"]').val(data.answer_03);--}}
{{--                                $('input[name="answer_04"]').val(data.answer_04);--}}
{{--                                $('input[name="answer_05"]').val(data.answer_05);--}}
{{--                                $('input[name="answer_06"]').val(data.answer_06);--}}
{{--                                $('input[name="answer_07"]').val(data.answer_07);--}}
{{--                                $('input[name="answer_08"]').val(data.answer_08);--}}
{{--                                $('input[name="answer_09"]').val(data.answer_09);--}}
{{--                                $('input[name="answer_10"]').val(data.answer_10);--}}
{{--                                $('input[name="answer_11"]').val(data.answer_11);--}}
{{--                                $('input[name="answer_12"]').val(data.answer_12);--}}
{{--                                $('input[name="answer_13"]').val(data.answer_13);--}}
{{--                                $('input[name="answer_14"]').val(data.answer_14);--}}
{{--                                $('input[name="answer_15"]').val(data.answer_15);--}}
{{--                                $('input[name="answer_16"]').val(data.answer_16);--}}
{{--                                $('input[name="answer_17"]').val(data.answer_17);--}}
{{--                                $('input[name="answer_18"]').val(data.answer_18);--}}
{{--                                $('input[name="answer_19"]').val(data.answer_19);--}}
{{--                                $('input[name="answer_20"]').val(data.answer_20);--}}
{{--                                $('input[name="answer_21"]').val(data.answer_21);--}}
{{--                                $('input[name="answer_22"]').val(data.answer_22);--}}
{{--                                $('input[name="answer_23"]').val(data.answer_23);--}}
{{--                                $('input[name="answer_24"]').val(data.answer_24);--}}
{{--                                $('input[name="kss1"]').val(data.kss1);--}}
{{--                                $('input[name="kss2"]').val(data.kss2);--}}
{{--                                $('input[name="hhs"]').val(data.hhs);--}}

{{--                                if (typ === 'bedro') {--}}

{{--                                    $('#kss1-div').hide();--}}
{{--                                    $('#kss2-div').hide();--}}
{{--                                    $('#hhs-div').show();--}}

{{--                                    $('.inputAndLabel #hhs').show();--}}
{{--                                    $('.inputAndLabel #kss1').hide();--}}
{{--                                    $('.inputAndLabel #kss2').hide();--}}
{{--                                    $('.inputAndLabel label[for="kss1"]').hide();--}}
{{--                                    $('.inputAndLabel label[for="kss2"]').hide();--}}
{{--                                    $('.inputAndLabel label[for="hhs"]').show();--}}
{{--                                    $('input[name="kss1"]').val(null);--}}
{{--                                    $('input[name="kss2"]').val(null);--}}
{{--                                } else {--}}
{{--                                    $('#kss1-div').show();--}}
{{--                                    $('#kss2-div').show();--}}
{{--                                    $('#hhs-div').hide();--}}

{{--                                    $('.inputAndLabel #kss1').show();--}}
{{--                                    $('.inputAndLabel #kss2').show();--}}
{{--                                    $('.inputAndLabel #hhs').hide();--}}
{{--                                    $('.inputAndLabel label[for="kss1"]').show();--}}
{{--                                    $('.inputAndLabel label[for="kss2"]').show();--}}
{{--                                    $('.inputAndLabel label[for="hhs"]').hide();--}}
{{--                                    $('input[name="hhs"]').val(null);--}}
{{--                                }--}}


{{--                                $('.vpisovanieDat').show();--}}
{{--                                updateContentWomac(false);--}}

{{--                            },--}}
{{--                            error: function (error) {--}}
{{--                                console.error('Error fetching data:', error);--}}
{{--                            }--}}
{{--                        });--}}
{{--                    } else {--}}

{{--                        $('input[type="text"]').val('');--}}
{{--                        $('input[type="date"]').val('');--}}
{{--                        document.getElementById('id_womac').value = 0;--}}
{{--                        $('input[name="hhs"]').val(null);--}}
{{--                        $('input[name="kss1"]').val(null);--}}
{{--                        $('input[name="kss2"]').val(null);--}}
{{--                        updateContentWomac(true);--}}
{{--                    }--}}
{{--                    updateMode = !updateMode;--}}
{{--                });--}}

{{--                function updateContentWomac(parameterTrue) {--}}

{{--                    if (parameterTrue) {--}}
{{--                        document.getElementById('womacIdSpan').innerText = '';--}}
{{--                    } else {--}}
{{--                        document.getElementById('womacIdSpan').innerText = womacIdFromJavaScript;--}}
{{--                    }--}}
{{--                }--}}
{{--            });--}}


{{--        </script>--}}



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
