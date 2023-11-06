@extends('layouts.app-master')

@section('content')

{{--<!DOCTYPE html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <title>Womac</title>--}}

{{--    <link rel="icon" type="image/png" href="pics/sar_logo.png"/>--}}


{{--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">--}}
{{--    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>--}}
{{--    <link rel="stylesheet" href="css/style.css">--}}
{{--    <link rel="stylesheet" href="css/womac.css">--}}
{{--    <link rel="stylesheet" href="css/navbar.css">--}}

{{--    <meta name="viewport" content="width=device-width, initial-scale=1.0">--}}


{{--</head>--}}
{{--<body>--}}




<div class="containerWomac">
    <div class="sideBarWomac">
        <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-body-tertiary" >
            <a href="/" class="d-flex align-items-center flex-shrink-0 p-3 link-body-emphasis text-decoration-none border-bottom">

                <span class="fs-5 fw-bold">Zoznam pacientov</span>
            </a>
            <div class="list-group list-group-flush border-bottom scrollarea">
                <a href="#" class="list-group-item list-group-item-action active py-3 lh-sm" aria-current="true">
                    <div class="d-flex w-100 align-items-center justify-content-between">
                        <strong class="mb-1">Rudiáš Bohatý</strong>
                        <small>Narodenie: 1.1.1956</small>
                    </div>
                    <div class="col-10 mb-1 small">Operácia vykonaná dňa: 6.4.2022</div>
                </a>
                <a href="#" class="list-group-item list-group-item-action py-3 lh-sm">
                    <div class="d-flex w-100 align-items-center justify-content-between">
                        <strong class="mb-1">Metod Mužský</strong>
                        <small class="text-body-secondary">Narodenie: 12.1.1956</small>
                    </div>
                    <div class="col-10 mb-1 small">Operácia vykonaná dňa: 2.6.2022</div>
                </a>
                <a href="#" class="list-group-item list-group-item-action py-3 lh-sm">
                    <div class="d-flex w-100 align-items-center justify-content-between">
                        <strong class="mb-1">Patrik Jedľovský</strong>
                        <small class="text-body-secondary">Narodenie: 21.4.1980</small>
                    </div>
                    <div class="col-10 mb-1 small">Operácia vykonaná dňa: 2.6.2022</div>
                </a>
                <a href="#" class="list-group-item list-group-item-action py-3 lh-sm">
                    <div class="d-flex w-100 align-items-center justify-content-between">
                        <strong class="mb-1">Patrik Jedľovský</strong>
                        <small class="text-body-secondary">Narodenie: 21.4.1980</small>
                    </div>
                    <div class="col-10 mb-1 small">Operácia vykonaná dňa: 2.6.2022</div>
                </a>
                <a href="#" class="list-group-item list-group-item-action py-3 lh-sm">
                    <div class="d-flex w-100 align-items-center justify-content-between">
                        <strong class="mb-1">Patrik Jedľovský</strong>
                        <small class="text-body-secondary">Narodenie: 21.4.1980</small>
                    </div>
                    <div class="col-10 mb-1 small">Operácia vykonaná dňa: 2.6.2022</div>
                </a>
                <a href="#" class="list-group-item list-group-item-action py-3 lh-sm">
                    <div class="d-flex w-100 align-items-center justify-content-between">
                        <strong class="mb-1">Patrik Jedľovský</strong>
                        <small class="text-body-secondary">Narodenie: 21.4.1980</small>
                    </div>
                    <div class="col-10 mb-1 small">Operácia vykonaná dňa: 2.6.2022</div>
                </a>
                <a href="#" class="list-group-item list-group-item-action py-3 lh-sm">
                    <div class="d-flex w-100 align-items-center justify-content-between">
                        <strong class="mb-1">Patrik Jedľovský</strong>
                        <small class="text-body-secondary">Narodenie: 21.4.1980</small>
                    </div>
                    <div class="col-10 mb-1 small">Operácia vykonaná dňa: 2.6.2022</div>
                </a>
                <a href="#" class="list-group-item list-group-item-action py-3 lh-sm">
                    <div class="d-flex w-100 align-items-center justify-content-between">
                        <strong class="mb-1">Patrik Jedľovský</strong>
                        <small class="text-body-secondary">Narodenie: 21.4.1980</small>
                    </div>
                    <div class="col-10 mb-1 small">Operácia vykonaná dňa: 2.6.2022</div>
                </a>

            </div>
        </div>
    </div>
    <div class="womacVpisovanie">
        <div class="menuVpisovanie">
            <div class = "womacMenuButton">
                <a class="nav-link" type="button" role="tab" aria-controls="nav-1" aria-selected="true">Womac zadávanie</a>
            </div>
            <div class = "womacMenuButton">
                <a class="nav-link" type="button" role="tab" aria-controls="nav-1" aria-selected="true">Womac výstup</a>
            </div>
            <div class = "womacMenuButton">
                <a class="nav-link" type="button" role="tab" aria-controls="nav-1" aria-selected="true">Demography</a>
            </div>
            <div class = "womacMenuButton">
                <a class="nav-link" type="button" role="tab" aria-controls="nav-1" aria-selected="true">Demography</a>
            </div>
        </div>

        <div>
            <form class="vpisovanieDat">
                <div class="inputAndLabel">
                    <label class="nazovWomacInput" for="vstup1">1</label>
                    <input type="text" class="womacInput" id="vstup1" maxlength = "1">
                </div>
                <div class="inputAndLabel">
                    <label class="nazovWomacInput" for="vstup2">2</label>
                    <input type="text" class="womacInput" id="vstup2" maxlength = "1">
                </div>
                <div class="inputAndLabel">
                    <label class="nazovWomacInput" for="vstup3">3</label>
                    <input type="text" class="womacInput" id="vstup3" maxlength = "1">
                </div>
                <div class="inputAndLabel">
                    <label class="nazovWomacInput" for="vstup4">4</label>
                    <input type="text" class="womacInput" id="vstup4" maxlength = "1">
                </div>
                <div class="inputAndLabel">
                    <label class="nazovWomacInput" for="vstup5">5</label>
                    <input type="text" class="womacInput" id="vstup5" maxlength = "1">
                </div>
                <div class="inputAndLabel">
                    <label class="nazovWomacInput" for="vstup6">6</label>
                    <input type="text" class="womacInput" id="vstup6" maxlength = "1">
                </div>
                <div class="inputAndLabel">
                    <label class="nazovWomacInput" for="vstup7">7</label>
                    <input type="text" class="womacInput" id="vstup7" maxlength = "1">
                </div>
                <div class="inputAndLabel">
                    <label class="nazovWomacInput" for="vstup8">8</label>
                    <input type="text" class="womacInput" id="vstup8" maxlength = "1">
                </div>
                <div class="inputAndLabel">
                    <label class="nazovWomacInput" for="vstup9">9</label>
                    <input type="text" class="womacInput" id="vstup9" maxlength = "1">
                </div>
                <div class="inputAndLabel">
                    <label class="nazovWomacInput" for="vstup10">10</label>
                    <input type="text" class="womacInput" id="vstup10" maxlength = "1">
                </div>
                <div class="inputAndLabel">
                    <label class="nazovWomacInput" for="vstup11">11</label>
                    <input type="text" class="womacInput" id="vstup11" maxlength = "1">
                </div>
                <div class="inputAndLabel">
                    <label class="nazovWomacInput" for="vstup12">12</label>
                    <input type="text" class="womacInput" id="vstup12" maxlength = "1">
                </div>
                <div class="inputAndLabel">
                    <label class="nazovWomacInput" for="vstup13">13</label>
                    <input type="text" class="womacInput" id="vstup13" maxlength = "1">
                </div>
                <div class="inputAndLabel">
                    <label class="nazovWomacInput" for="vstup14">14</label>
                    <input type="text" class="womacInput" id="vstup14" maxlength = "1">
                </div>
                <div class="inputAndLabel">
                    <label class="nazovWomacInput" for="vstup15">15</label>
                    <input type="text" class="womacInput" id="vstup15" maxlength = "1">
                </div>
                <div class="inputAndLabel">
                    <label class="nazovWomacInput" for="vstup16">16</label>
                    <input type="text" class="womacInput" id="vstup16" maxlength = "1">
                </div>
                <div class="inputAndLabel">
                    <label class="nazovWomacInput" for="vstup17">17</label>
                    <input type="text" class="womacInput" id="vstup17" maxlength = "1">
                </div>
                <div class="inputAndLabel">
                    <label class="nazovWomacInput" for="vstup18">18</label>
                    <input type="text" class="womacInput" id="vstup18" maxlength = "1">
                </div>
                <div class="inputAndLabel">
                    <label class="nazovWomacInput" for="vstup19">19</label>
                    <input type="text" class="womacInput" id="vstup19" maxlength = "1">
                </div>
                <div class="inputAndLabel">
                    <label class="nazovWomacInput" for="vstup20">20</label>
                    <input type="text" class="womacInput" id="vstup20" maxlength = "1">
                </div>
                <div class="inputAndLabel">
                    <label class="nazovWomacInput" for="vstup21">21</label>
                    <input type="text" class="womacInput" id="vstup21" maxlength = "1">
                </div>
                <div class="inputAndLabel">
                    <label class="nazovWomacInput" for="vstup22">22</label>
                    <input type="text" class="womacInput" id="vstup22" maxlength = "1">
                </div>
                <div class="inputAndLabel">
                    <label class="nazovWomacInput" for="vstup23">23</label>
                    <input type="text" class="womacInput" id="vstup23" maxlength = "1">
                </div>
                <div class="inputAndLabel">
                    <label class="nazovWomacInput" for="vstup24">24</label>
                    <input type="text" class="womacInput" id="vstup24" maxlength = "1">
                </div>
                <button class="buttonSubmit">Potvrdiť</button>
            </form>

        </div>
    </div>
</div>




</body>
</html>
@endsection
