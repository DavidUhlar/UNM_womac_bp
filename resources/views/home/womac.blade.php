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
                        @foreach($pacient->operacie as $operacia)

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
                                        <a href="#" class="sub-btn operacie" data-operation="{{ $operaciaPacientaK['sar_id'] }}">Operácia {{ $operaciaPacientaK['sar_id'] }}</a>
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
                                    <a href="#" class="sub-btn operacie" data-operation="{{ $operaciaPacientaB['sar_id'] }}">Operácia {{ $operaciaPacientaB['sar_id'] }}</a>
{{--                                    <a href="#" class="sub-btn operacie" data-operation="">Operácia</a>--}}

                                    <div class="sub-menu">
                                        <a href="#" class="sub-item">Womac 10</a>
                                        <a href="#" class="sub-item">Womac 20</a>
                                        <a href="#" class="sub-item">Womac 30</a>

                                    </div>
                                    @endforeach
                                @endif
                            </div>
                        @endforeach
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



        </script>


        <div class="womacVpisovanie">
            <div class="menuVpisovanie">
                <div class="womacMenuButton">
                    <a class="nav-link" type="button" role="tab" aria-controls="nav-1" aria-selected="true">Womac
                        zadávanie</a>
                </div>
                <div class="womacMenuButton">
                    <a class="nav-link" type="button" role="tab" aria-controls="nav-1" aria-selected="true">Womac
                        výstup</a>
                </div>
                <div class="womacMenuButton">
                    <a class="nav-link" type="button" role="tab" aria-controls="nav-1"
                       aria-selected="true">Demography</a>
                </div>
                <div class="womacMenuButton">
                    <a class="nav-link" type="button" role="tab" aria-controls="nav-1"
                       aria-selected="true">Demography</a>
                </div>
            </div>

            <div>
                <form class="vpisovanieDat" action="{{ route('womac.create') }}" method="post">
                    @csrf
                    <input type="hidden" id="id_womac" name="id_womac" value="50">
                    <input type="hidden" id="date_visit" name="date_visit" value="2023-01-01">
                    <input type="hidden" id="date_womac" name="date_womac" value="2023-02-02">

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
