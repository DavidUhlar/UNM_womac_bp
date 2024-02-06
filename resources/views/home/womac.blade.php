@extends('layouts.app-master')
<link rel="stylesheet" href=" {{ asset("css/sidebar_womac.css") }}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
@section('content')
    @auth



    <div class="containerWomac">
        <div class="side-bar">

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
                                    <a href="#" class="sub-btn operacie" data-operation="{{ $operaciaPacientaK['sar_id'] }}">Operácia {{ $operaciaPacientaK['sar_id'] }} </a>
{{--                                    <a href="#" class="sub-btn operacie" data-operation="">Operácia</a>--}}
                                    <div class="sub-menu">


                                        <a href="#" class="sub-item">Womac data</a>

                                        <a href="#" class="sub-item">Womac 2</a>
                                        <a href="#" class="sub-item">Womac 3</a>

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
                                    <a href="#" class="sub-btn operacie" data-id-operation="{{ $operaciaPacientaB['id'] }}" data-operation="{{ $operaciaPacientaB['sar_id'] }}" >Operácia {{ $operaciaPacientaB['sar_id'] }}

{{--                                        <button href="{{ route('womac.create', $operaciaPacientaB['id']) }}" class="btn btn-success">--}}
{{--                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-database-fill-add" viewBox="0 0 16 16">--}}
{{--                                                <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0M8 1c-1.573 0-3.022.289-4.096.777C2.875 2.245 2 2.993 2 4s.875 1.755 1.904 2.223C4.978 6.711 6.427 7 8 7s3.022-.289 4.096-.777C13.125 5.755 14 5.007 14 4s-.875-1.755-1.904-2.223C11.022 1.289 9.573 1 8 1"></path>--}}
{{--                                                <path d="M2 7v-.839c.457.432 1.004.751 1.49.972C4.722 7.693 6.318 8 8 8s3.278-.307 4.51-.867c.486-.22 1.033-.54 1.49-.972V7c0 .424-.155.802-.411 1.133a4.51 4.51 0 0 0-4.815 1.843A12 12 0 0 1 8 10c-1.573 0-3.022-.289-4.096-.777C2.875 8.755 2 8.007 2 7m6.257 3.998L8 11c-1.682 0-3.278-.307-4.51-.867-.486-.22-1.033-.54-1.49-.972V10c0 1.007.875 1.755 1.904 2.223C4.978 12.711 6.427 13 8 13h.027a4.55 4.55 0 0 1 .23-2.002m-.002 3L8 14c-1.682 0-3.278-.307-4.51-.867-.486-.22-1.033-.54-1.49-.972V13c0 1.007.875 1.755 1.904 2.223C4.978 15.711 6.427 16 8 16c.536 0 1.058-.034 1.555-.097a4.5 4.5 0 0 1-1.3-1.905"></path>--}}
{{--                                            </svg>--}}
{{--                                            Pridať womac--}}
{{--                                        </button>--}}
                                    </a>
    {{--                                    <a href="#" class="sub-btn operacie" data-operation="">Operácia</a>--}}

                                    <div class="sub-menu">
                                        <a href="#" class="sub-item">Womac 10</a>
                                        <a href="#" class="sub-item">Womac 20</a>
                                        <a href="#" class="sub-item">Womac 30</a>

                                    </div>
                                @endforeach
                            @endif
                        </div>
{{--                        @endforeach--}}
                    </div>
                @endforeach



{{--                <div class="item">--}}
{{--                    <a class="sub-btn nadpisko">Pacient 1</a>--}}
{{--                    <div class="sub-menu ">--}}
{{--                        <div class="sidebarHeading">--}}
{{--                            Koleno--}}
{{--                        </div>--}}

{{--                        <a href="#" class="sub-btn operacie">Operácia 01</a>--}}
{{--                        <div class="sub-menu">--}}
{{--                            <a href="#" class="sub-item">Womac 1</a>--}}


{{--                        </div>--}}
{{--                        <div class="sidebarHeading">--}}
{{--                            Bedro--}}
{{--                        </div>--}}
{{--                        <a href="#" class="sub-btn operacie">Operácia 02</a>--}}
{{--                        <div class="sub-menu">--}}
{{--                            <a href="#" class="sub-item">Womac 10</a>--}}
{{--                            <a href="#" class="sub-item">Womac 20</a>--}}


{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="item">--}}
{{--                    <a class="sub-btn nadpisko">Pacient 2</a>--}}
{{--                    <div class="sub-menu ">--}}
{{--                        <div class="sidebarHeading">--}}
{{--                            Koleno--}}
{{--                        </div>--}}

{{--                        <a href="#" class="sub-btn operacie">Operácia 01</a>--}}
{{--                        <div class="sub-menu">--}}
{{--                            <a href="#" class="sub-item">Womac 1</a>--}}


{{--                        </div>--}}
{{--                        <div class="sidebarHeading">--}}
{{--                            Bedro--}}
{{--                        </div>--}}
{{--                        <a href="#" class="sub-btn operacie">Operácia 02</a>--}}
{{--                        <div class="sub-menu">--}}
{{--                            <a href="#" class="sub-item">Womac 10</a>--}}
{{--                            <a href="#" class="sub-item">Womac 20</a>--}}


{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}



            </div>
        </div>


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

                    console.log('Clicked operation:', sarID);
                    console.log('Clicked operation id:', operationID);

                    operationIdFromJavaScript = sarID;




                    $('#hiddenOperationIdInput').val(operationID);
                    var formAction = '/unm_womac_bp/public/womac/create/' + operationID;
                    {{--var formAction = @json(route("womac.create")) + operationID;--}}
                    $('.vpisovanieDat').attr('action', formAction);

                    updateContent();
                });

                // Function to update content in the Blade view
                function updateContent() {
                    // Update the Blade view dynamically
                    document.getElementById('sarIdSpan').innerText = operationIdFromJavaScript;


                    // Add your logic to conditionally show/hide elements or include other content
                    // ...
                }
            });

        </script>



        <div class="womacVpisovanie">
            <div class="nadpisko">
                ID operácie: <span id="sarIdSpan"></span>
            </div>

            <br>

            <div class="menuVpisovanie">

                @include('womac.womacButtons')

            </div>




            <div>
{{--                @include('womac.womacInputForm')--}}


                <form class="vpisovanieDat" method="post">
                    @csrf
                    <input type="hidden" id="hiddenOperationIdInput" name="id_operation" value="">
                    <input type="hidden" id="id_womac" name="id_womac" value="50">
                    {{--                    <input type="hidden" id="date_visit" name="date_visit" value="2023-01-01">--}}
                    {{--                    <input type="hidden" id="date_womac" name="date_womac" value="2023-02-02">--}}

                    <div class="inputAndLabel">
                        <label class="nazovWomacInput" for="date_visit">Dátum vizity</label>
                        <input type="date" id="date_womac" name="date_visit" value="">


                    </div>
                    <div class="inputAndLabel">

                        <label class="nazovWomacInput" for="date_womac">Dátum womac</label>
                        <input type="date" id="date_womac" name="date_womac" value="">
                    </div>


                    <div class="inputAndLabel">
                        <label class="nazovWomacInput" for="answer_01">1</label>
                        <input type="text" class="womacInput" name="answer_01" id="answer_01" maxlength="1">
                    </div>
                    <div class="inputAndLabel">
                        <label class="nazovWomacInput" for="answer_02">2</label>
                        <input type="text" class="womacInput" name="answer_02" id="answer_02" maxlength="1">
                    </div>
                    <div class="inputAndLabel">
                        <label class="nazovWomacInput" for="answer_03">3</label>
                        <input type="text" class="womacInput" name="answer_03" id="answer_03" maxlength="1">
                    </div>
                    <div class="inputAndLabel">
                        <label class="nazovWomacInput" for="answer_04">4</label>
                        <input type="text" class="womacInput" name="answer_04" id="answer_04" maxlength="1">
                    </div>
                    <div class="inputAndLabel">
                        <label class="nazovWomacInput" for="answer_05">5</label>
                        <input type="text" class="womacInput" name="answer_05" id="answer_05" maxlength="1">
                    </div>
                    <div class="inputAndLabel">
                        <label class="nazovWomacInput" for="answer_06">6</label>
                        <input type="text" class="womacInput" name="answer_06" id="answer_06" maxlength="1">
                    </div>
                    <div class="inputAndLabel">
                        <label class="nazovWomacInput" for="answer_07">7</label>
                        <input type="text" class="womacInput" name="answer_07" id="answer_07" maxlength="1">
                    </div>
                    <div class="inputAndLabel">
                        <label class="nazovWomacInput" for="answer_08">8</label>
                        <input type="text" class="womacInput" name="answer_08" id="answer_08" maxlength="1">
                    </div>
                    <div class="inputAndLabel">
                        <label class="nazovWomacInput" for="answer_09">9</label>
                        <input type="text" class="womacInput" name="answer_09" id="answer_09" maxlength="1">
                    </div>
                    <div class="inputAndLabel">
                        <label class="nazovWomacInput" for="answer_10">10</label>
                        <input type="text" class="womacInput" name="answer_10" id="answer_10" maxlength="1">
                    </div>
                    <div class="inputAndLabel">
                        <label class="nazovWomacInput" for="answer_11">11</label>
                        <input type="text" class="womacInput" name="answer_11" id="answer_11" maxlength="1">
                    </div>
                    <div class="inputAndLabel">
                        <label class="nazovWomacInput" for="answer_12">12</label>
                        <input type="text" class="womacInput" name="answer_12" id="answer_12" maxlength="1">
                    </div>
                    <div class="inputAndLabel">
                        <label class="nazovWomacInput" for="answer_13">13</label>
                        <input type="text" class="womacInput" name="answer_13" id="answer_13" maxlength="1">
                    </div>
                    <div class="inputAndLabel">
                        <label class="nazovWomacInput" for="answer_14">14</label>
                        <input type="text" class="womacInput" name="answer_14" id="answer_14" maxlength="1">
                    </div>
                    <div class="inputAndLabel">
                        <label class="nazovWomacInput" for="answer_15">15</label>
                        <input type="text" class="womacInput" name="answer_15" id="answer_15" maxlength="1">
                    </div>
                    <div class="inputAndLabel">
                        <label class="nazovWomacInput" for="answer_16">16</label>
                        <input type="text" class="womacInput" name="answer_16" id="answer_16" maxlength="1">
                    </div>
                    <div class="inputAndLabel">
                        <label class="nazovWomacInput" for="answer_17">17</label>
                        <input type="text" class="womacInput" name="answer_17" id="answer_17" maxlength="1">
                    </div>
                    <div class="inputAndLabel">
                        <label class="nazovWomacInput" for="answer_18">18</label>
                        <input type="text" class="womacInput" name="answer_18" id="answer_18" maxlength="1">
                    </div>
                    <div class="inputAndLabel">
                        <label class="nazovWomacInput" for="answer_19">19</label>
                        <input type="text" class="womacInput" name="answer_19" id="answer_19" maxlength="1">
                    </div>
                    <div class="inputAndLabel">
                        <label class="nazovWomacInput" for="answer_20">20</label>
                        <input type="text" class="womacInput" name="answer_20" id="answer_20" maxlength="1">
                    </div>
                    <div class="inputAndLabel">
                        <label class="nazovWomacInput" for="answer_21">21</label>
                        <input type="text" class="womacInput" name="answer_21" id="answer_21" maxlength="1">
                    </div>
                    <div class="inputAndLabel">
                        <label class="nazovWomacInput" for="answer_22">22</label>
                        <input type="text" class="womacInput" name="answer_22" id="answer_22" maxlength="1">
                    </div>
                    <div class="inputAndLabel">
                        <label class="nazovWomacInput" for="answer_23">23</label>
                        <input type="text" class="womacInput" name="answer_23" id="answer_23" maxlength="1">
                    </div>
                    <div class="inputAndLabel">
                        <label class="nazovWomacInput" for="answer_24">24</label>
                        <input type="text" class="womacInput" name="answer_24" id="answer_24" maxlength="1">
                    </div>
                    <button class="buttonSubmit">Potvrdiť</button>
                </form>

            </div>
        </div>
    </div>
    @endauth
@endsection
