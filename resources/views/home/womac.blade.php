@extends('layouts.app-master')
<link rel="stylesheet" href=" {{ asset("css/sidebar_womac.css") }}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>

@section('content')
    @auth



    <div class="containerWomac">
        <div class="side-bar">
            <form action="{{ route('womac.filter') }}" method="get">
                @csrf
                @method('POST')
                <div class="flex-container-womac-delete">
                <input type="text" id="filter_input" name="filter_criteria" placeholder="Zadaj Rodné číslo alebo meno" value="{{ $filter }}">
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
                        </a>
{{--                        {{ dd($pacient->operacie->where('typ', 0)) }}--}}
{{--                        @foreach($pacient->operacie as $operacia)--}}

                        <div class="sub-menu ">

                            @php
                                //$operacieVsetky = $pacient[0]['id_operacia'];
                                $operacieKoleno = $pacient->operacie->where('typ', 1);
                                $operacieBedro = $pacient->operacie->where('typ', 0);

//                                    $operacieBedro = $pacient[0] ?? [];
//                                    $operacieKoleno = $pacient[1] ?? [];


                            @endphp


                            @if(count($operacieKoleno) > 0)
{{--                                @if(!empty($operacieKoleno))--}}



                                <div class="sidebarHeading">
                                    Koleno
                                </div>
                                @foreach($operacieKoleno as $operaciaPacientaK)
                                    <a href="#" class="sub-btn operacie" data-typ="koleno" data-id-operation="{{ $operaciaPacientaK['id'] }}" data-operation="{{ $operaciaPacientaK['sar_id'] }}" data-pacient-id="{{ $pacient['id'] }}">
                                        Operácia {{ $operaciaPacientaK['sar_id'] }} {{ \Carbon\Carbon::createFromFormat('Ymd', $operaciaPacientaK['datum'])->format('Y-m-d') }}
                                    </a>
{{--                                    <a href="#" class="sub-btn operacie" data-operation="">Operácia</a>--}}
                                    <div class="sub-menu">


{{--                                        <a href="#" class="sub-item">Womac data</a>--}}
{{--                                        <a href="#" class="sub-item">Womac 2</a>--}}
{{--                                        <a href="#" class="sub-item">Womac 3</a>--}}
{{--                                        @foreach($womac as $wData)--}}

{{--                                            <a href="#" class="sub-item" data-id="{{ $wData->id_womac }}">{{ $wData->id_womac }}, {{ $wData->date_womac }}</a>--}}

{{--                                        @endforeach--}}
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

{{--                                {{ dd($pacient->operacie->where('typ', 0)) }}--}}
{{--                                @if(!empty($operacieBedro))--}}
                            @if(count($operacieBedro) > 0)
                                <div class="sidebarHeading">
                                    Bedro
                                </div>
                                @foreach($operacieBedro as $operaciaPacientaB)
                                    <a href="#" class="sub-btn operacie" data-typ="bedro" data-id-operation="{{ $operaciaPacientaB['id'] }}" data-operation="{{ $operaciaPacientaB['sar_id'] }} " data-pacient-id="{{ $pacient['id'] }}">
                                        Operácia {{ $operaciaPacientaB['sar_id'] }} {{ \Carbon\Carbon::createFromFormat('Ymd', $operaciaPacientaB['datum'])->format('Y-m-d') }}
                                    </a>
    {{--                                    <a href="#" class="sub-btn operacie" data-operation="">Operácia</a>--}}

                                    <div class="sub-menu">
{{--                                        <a href="#" class="sub-item">Womac 10</a>--}}
{{--                                        <a href="#" class="sub-item">Womac 20</a>--}}
{{--                                        <a href="#" class="sub-item">Womac 30</a>--}}

{{--                                        {{ $filteredWomacOperations = $womacOperations->where('id_patient', $pacient->id)->where('id_operation', $operaciaPacientaB->id)->pluck('id_womac')->unique() }}--}}
{{--                                        @foreach($filteredWomacOperations as $womOp)--}}
{{--                                            @foreach($womac as $wData)--}}

{{--                                                @if($wData->id_womac = $womOp)--}}
{{--                                                    <a href="#" class="sub-item" data-id="{{ $wData->id_womac }}">{{ $wData->id_womac }}, {{ $wData->date_womac }}</a>--}}
{{--                                                @endif--}}
{{--                                            @endforeach--}}

{{--                                        @endforeach--}}
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
{{--                        @endforeach--}}
                    </div>
                @endforeach





            </div>
        </div>

        <script>
            $(document).ready(function () {
                $('.delete-button').click(function () {
                    var idWomac = $(this).data('id');
                    var confirmDelete = confirm('Chcete naozaj odstrániť?');

                    if (confirmDelete) {

                        $('#deleteForm').attr('action', '{{ route("womac.delete", ":id") }}'.replace(':id', idWomac));
                        $('#deleteForm').submit();
                    } else {

                        return false;
                    }
                });
            });
        </script>

        <script type="text/javascript">
            $(document).ready(function () {
                $('.sub-btn').click(function () {
                    var subMenu = $(this).next('.sub-menu');
                    subMenu.slideToggle();
                    $(this).toggleClass('activeMenu');


                    var parentItem = $(this).closest('.item');


                    parentItem.siblings().find('.sub-menu').slideUp();
                    parentItem.siblings().find('.sub-btn').removeClass('activeMenu');
                });
            });

            $(document).ready(function () {
                $('.sub-btn.operacie').click(function () {
                    console.log('Click event triggered');
                    var sarID = $(this).data('operation');
                    var operationID = $(this).data('id-operation');
                    var typOperacie = $(this).data('typ');

                    console.log('Clicked operation:', sarID);
                    console.log('Clicked operation id:', operationID);

                    operationIdFromJavaScript = sarID;

                    if (typOperacie === 'bedro') {

                        $('.inputAndLabel #hhs').show();
                        $('.inputAndLabel #kss1').hide();
                        $('.inputAndLabel #kss2').hide();
                        $('.inputAndLabel label[for="kss1"]').hide();
                        $('.inputAndLabel label[for="kss2"]').hide();
                        $('.inputAndLabel label[for="hhs"]').show();
                        $('input[name="kss1"]').val(null);
                        $('input[name="kss2"]').val(null);
                    } else {
                        $('.inputAndLabel #kss1').show();
                        $('.inputAndLabel #kss2').show();
                        $('.inputAndLabel #hhs').hide();
                        $('.inputAndLabel label[for="kss1"]').show();
                        $('.inputAndLabel label[for="kss2"]').show();
                        $('.inputAndLabel label[for="hhs"]').hide();
                        $('input[name="hhs"]').val(null);
                    }
                    $('.vpisovanieDat').show();

                    $('#hiddenOperationIdInput').val(operationID);
                    var formAction = '/unm_womac_bp/public/womac/create/' + operationID;
                    {{--var formAction = @json(route("womac.create")) + operationID;--}}
                    $('.vpisovanieDat').attr('action', formAction);



                    $('input[type="text"]').val('');
                    $('input[type="date"]').val('');
                    document.getElementById('id_womac').value = 0;
                    $('input[name="hhs"]').val(null);
                    $('input[name="kss1"]').val(null);
                    $('input[name="kss2"]').val(null);
                    updateMode = !updateMode;
                    updateContent();
                });

                function updateContent() {
                    document.getElementById('sarIdSpan').innerText = operationIdFromJavaScript;
                    document.getElementById('womacIdSpan').innerText = "";
                }
            });

        </script>




        <script>
            var updateMode = false;
            $(document).ready(function () {


                $('.sub-item').click(function (e) {
                    e.preventDefault();

                    var idWomac = $(this).data('id');
                    var typ = $(this).data('typ');
                    console.log(idWomac);

                    womacIdFromJavaScript = idWomac;

                    if (updateMode) {
                        $.ajax({
                            url: '{{ route("womac.getWomac", ["id_womac" => ":id"]) }}'.replace(':id', idWomac),
                            type: 'GET',
                            dataType: 'json',
                            success: function (data) {
                                console.log('data:', data);

                                $('input[name="id_womac"]').val(data.id_womac);
                                $('input[name="date_womac"]').val(data.date_womac);
                                $('input[name="date_visit"]').val(data.date_visit);
                                $('input[name="answer_01"]').val(data.answer_01);
                                $('input[name="answer_02"]').val(data.answer_02);
                                $('input[name="answer_03"]').val(data.answer_03);
                                $('input[name="answer_04"]').val(data.answer_04);
                                $('input[name="answer_05"]').val(data.answer_05);
                                $('input[name="answer_06"]').val(data.answer_06);
                                $('input[name="answer_07"]').val(data.answer_07);
                                $('input[name="answer_08"]').val(data.answer_08);
                                $('input[name="answer_09"]').val(data.answer_09);
                                $('input[name="answer_10"]').val(data.answer_10);
                                $('input[name="answer_11"]').val(data.answer_11);
                                $('input[name="answer_12"]').val(data.answer_12);
                                $('input[name="answer_13"]').val(data.answer_13);
                                $('input[name="answer_14"]').val(data.answer_14);
                                $('input[name="answer_15"]').val(data.answer_15);
                                $('input[name="answer_16"]').val(data.answer_16);
                                $('input[name="answer_17"]').val(data.answer_17);
                                $('input[name="answer_18"]').val(data.answer_18);
                                $('input[name="answer_19"]').val(data.answer_19);
                                $('input[name="answer_20"]').val(data.answer_20);
                                $('input[name="answer_21"]').val(data.answer_21);
                                $('input[name="answer_22"]').val(data.answer_22);
                                $('input[name="answer_23"]').val(data.answer_23);
                                $('input[name="answer_24"]').val(data.answer_24);
                                $('input[name="kss1"]').val(data.kss1);
                                $('input[name="kss2"]').val(data.kss2);
                                $('input[name="hhs"]').val(data.hhs);

                                if (typ === 'bedro') {

                                    $('.inputAndLabel #hhs').show();
                                    $('.inputAndLabel #kss1').hide();
                                    $('.inputAndLabel #kss2').hide();
                                    $('.inputAndLabel label[for="kss1"]').hide();
                                    $('.inputAndLabel label[for="kss2"]').hide();
                                    $('.inputAndLabel label[for="hhs"]').show();
                                    $('input[name="kss1"]').val(null);
                                    $('input[name="kss2"]').val(null);
                                } else {
                                    $('.inputAndLabel #kss1').show();
                                    $('.inputAndLabel #kss2').show();
                                    $('.inputAndLabel #hhs').hide();
                                    $('.inputAndLabel label[for="kss1"]').show();
                                    $('.inputAndLabel label[for="kss2"]').show();
                                    $('.inputAndLabel label[for="hhs"]').hide();
                                    $('input[name="hhs"]').val(null);
                                }

                                // if (typ === 'bedro') {
                                //     $('input[name="hhs"]').val(data.$hhsResult);
                                // } else {
                                //     $('input[name="kss1"]').val(data.$kss1Result);
                                //     $('input[name="kss2"]').val(data.$kss2Result);
                                // }

                                $('.vpisovanieDat').show();
                                updateContentWomac(false);

                            },
                            error: function (error) {
                                console.error('Error fetching data:', error);
                            }
                        });
                    } else {

                        $('input[type="text"]').val('');
                        $('input[type="date"]').val('');
                        document.getElementById('id_womac').value = 0;
                        $('input[name="hhs"]').val(null);
                        $('input[name="kss1"]').val(null);
                        $('input[name="kss2"]').val(null);
                        updateContentWomac(true);
                    }
                    updateMode = !updateMode;
                });

                function updateContentWomac(parameterTrue) {

                    if (parameterTrue) {
                        document.getElementById('womacIdSpan').innerText = '';
                    } else {
                        document.getElementById('womacIdSpan').innerText = womacIdFromJavaScript;
                    }
                }
            });


        </script>



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


{{--                <form class="vpisovanieDat" method="post">--}}
{{--                    @csrf--}}
{{--                    <input type="hidden" id="hiddenOperationIdInput" name="id_operation" value="">--}}

{{--                    <input type="hidden" id="id_womac" name="id_womac" value="50">--}}



{{--                    <div class="inputAndLabel">--}}
{{--                        <label class="nazovWomacInput" for="date_visit">Dátum vizity</label>--}}
{{--                        <input type="date" id="date_womac" name="date_visit" value="">--}}
{{--                    </div>--}}
{{--                    <div class="inputAndLabel">--}}
{{--                        <label class="nazovWomacInput" for="date_womac">Dátum womac</label>--}}
{{--                        <input type="date" id="date_womac" name="date_womac" value="">--}}
{{--                    </div>--}}


{{--                    <div class="inputAndLabel">--}}
{{--                        <label class="nazovWomacInput" for="answer_01">1</label>--}}
{{--                        <input type="text" class="womacInput" name="answer_01" id="answer_01" maxlength="1">--}}
{{--                    </div>--}}
{{--                    <div class="inputAndLabel">--}}
{{--                        <label class="nazovWomacInput" for="answer_02">2</label>--}}
{{--                        <input type="text" class="womacInput" name="answer_02" id="answer_02" maxlength="1">--}}
{{--                    </div>--}}
{{--                    <div class="inputAndLabel">--}}
{{--                        <label class="nazovWomacInput" for="answer_03">3</label>--}}
{{--                        <input type="text" class="womacInput" name="answer_03" id="answer_03" maxlength="1">--}}
{{--                    </div>--}}
{{--                    <div class="inputAndLabel">--}}
{{--                        <label class="nazovWomacInput" for="answer_04">4</label>--}}
{{--                        <input type="text" class="womacInput" name="answer_04" id="answer_04" maxlength="1">--}}
{{--                    </div>--}}
{{--                    <div class="inputAndLabel">--}}
{{--                        <label class="nazovWomacInput" for="answer_05">5</label>--}}
{{--                        <input type="text" class="womacInput" name="answer_05" id="answer_05" maxlength="1">--}}
{{--                    </div>--}}
{{--                    <div class="inputAndLabel">--}}
{{--                        <label class="nazovWomacInput" for="answer_06">6</label>--}}
{{--                        <input type="text" class="womacInput" name="answer_06" id="answer_06" maxlength="1">--}}
{{--                    </div>--}}
{{--                    <div class="inputAndLabel">--}}
{{--                        <label class="nazovWomacInput" for="answer_07">7</label>--}}
{{--                        <input type="text" class="womacInput" name="answer_07" id="answer_07" maxlength="1">--}}
{{--                    </div>--}}
{{--                    <div class="inputAndLabel">--}}
{{--                        <label class="nazovWomacInput" for="answer_08">8</label>--}}
{{--                        <input type="text" class="womacInput" name="answer_08" id="answer_08" maxlength="1">--}}
{{--                    </div>--}}
{{--                    <div class="inputAndLabel">--}}
{{--                        <label class="nazovWomacInput" for="answer_09">9</label>--}}
{{--                        <input type="text" class="womacInput" name="answer_09" id="answer_09" maxlength="1">--}}
{{--                    </div>--}}
{{--                    <div class="inputAndLabel">--}}
{{--                        <label class="nazovWomacInput" for="answer_10">10</label>--}}
{{--                        <input type="text" class="womacInput" name="answer_10" id="answer_10" maxlength="1">--}}
{{--                    </div>--}}
{{--                    <div class="inputAndLabel">--}}
{{--                        <label class="nazovWomacInput" for="answer_11">11</label>--}}
{{--                        <input type="text" class="womacInput" name="answer_11" id="answer_11" maxlength="1">--}}
{{--                    </div>--}}
{{--                    <div class="inputAndLabel">--}}
{{--                        <label class="nazovWomacInput" for="answer_12">12</label>--}}
{{--                        <input type="text" class="womacInput" name="answer_12" id="answer_12" maxlength="1">--}}
{{--                    </div>--}}
{{--                    <div class="inputAndLabel">--}}
{{--                        <label class="nazovWomacInput" for="answer_13">13</label>--}}
{{--                        <input type="text" class="womacInput" name="answer_13" id="answer_13" maxlength="1">--}}
{{--                    </div>--}}
{{--                    <div class="inputAndLabel">--}}
{{--                        <label class="nazovWomacInput" for="answer_14">14</label>--}}
{{--                        <input type="text" class="womacInput" name="answer_14" id="answer_14" maxlength="1">--}}
{{--                    </div>--}}
{{--                    <div class="inputAndLabel">--}}
{{--                        <label class="nazovWomacInput" for="answer_15">15</label>--}}
{{--                        <input type="text" class="womacInput" name="answer_15" id="answer_15" maxlength="1">--}}
{{--                    </div>--}}
{{--                    <div class="inputAndLabel">--}}
{{--                        <label class="nazovWomacInput" for="answer_16">16</label>--}}
{{--                        <input type="text" class="womacInput" name="answer_16" id="answer_16" maxlength="1">--}}
{{--                    </div>--}}
{{--                    <div class="inputAndLabel">--}}
{{--                        <label class="nazovWomacInput" for="answer_17">17</label>--}}
{{--                        <input type="text" class="womacInput" name="answer_17" id="answer_17" maxlength="1">--}}
{{--                    </div>--}}
{{--                    <div class="inputAndLabel">--}}
{{--                        <label class="nazovWomacInput" for="answer_18">18</label>--}}
{{--                        <input type="text" class="womacInput" name="answer_18" id="answer_18" maxlength="1">--}}
{{--                    </div>--}}
{{--                    <div class="inputAndLabel">--}}
{{--                        <label class="nazovWomacInput" for="answer_19">19</label>--}}
{{--                        <input type="text" class="womacInput" name="answer_19" id="answer_19" maxlength="1">--}}
{{--                    </div>--}}
{{--                    <div class="inputAndLabel">--}}
{{--                        <label class="nazovWomacInput" for="answer_20">20</label>--}}
{{--                        <input type="text" class="womacInput" name="answer_20" id="answer_20" maxlength="1">--}}
{{--                    </div>--}}
{{--                    <div class="inputAndLabel">--}}
{{--                        <label class="nazovWomacInput" for="answer_21">21</label>--}}
{{--                        <input type="text" class="womacInput" name="answer_21" id="answer_21" maxlength="1">--}}
{{--                    </div>--}}
{{--                    <div class="inputAndLabel">--}}
{{--                        <label class="nazovWomacInput" for="answer_22">22</label>--}}
{{--                        <input type="text" class="womacInput" name="answer_22" id="answer_22" maxlength="1">--}}
{{--                    </div>--}}
{{--                    <div class="inputAndLabel">--}}
{{--                        <label class="nazovWomacInput" for="answer_23">23</label>--}}
{{--                        <input type="text" class="womacInput" name="answer_23" id="answer_23" maxlength="1">--}}
{{--                    </div>--}}
{{--                    <div class="inputAndLabel">--}}
{{--                        <label class="nazovWomacInput" for="answer_24">24</label>--}}
{{--                        <input type="text" class="womacInput" name="answer_24" id="answer_24" maxlength="1">--}}
{{--                    </div>--}}


{{--                    <div class="inputAndLabel">--}}
{{--                        <label class="nazovWomacInput" for="hhs">HHS</label>--}}
{{--                        <input type="text" class="womacInput" name="hhs" id="hhs" maxlength="2">--}}
{{--                    </div>--}}
{{--                    <div class="inputAndLabel">--}}
{{--                        <label class="nazovWomacInput" for="kss">kss</label>--}}
{{--                        <input type="text" class="womacInput" name="kss" id="kss" maxlength="2">--}}
{{--                    </div>--}}

{{--                    <button class="buttonSubmit">Potvrdiť</button>--}}
{{--                </form>--}}

            </div>
        </div>
    </div>
    @endauth
@endsection
