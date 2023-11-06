@extends('layouts.app-master')

@section('content')

{{--<!DOCTYPE html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <title>O nás</title>--}}

{{--    <link rel="icon" type="image/png" href="pics/sar_logo.png"/>--}}

{{--    <meta name="viewport" content="width=device-width, initial-scale=1.0">--}}
{{--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">--}}
{{--    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>--}}
{{--    <link rel="stylesheet" href="css/style.css">--}}
{{--    <link rel="stylesheet" href="css/mapa.css">--}}
{{--    <link rel="stylesheet" href="css/navbar.css">--}}





{{--</head>--}}
{{--<body>--}}





<!-- caste otazky-->
<div class="obsah_text">
    <h2>O nás</h2>

    Slovenský artroplastický register (SAR) je zdravotnícky informačný systém, ktorý vykonáva zber presne určených údajov o každej vykonanej implantácii umelej kĺbovej náhrady, na jednotlivých pracoviskách v Slovenskej republike a následne ich vyhodnocuje.
    <p class ="poznamkaParagraf">
        SAR zriadilo Ministerstvo zdravotníctva Slovenskej republiky (Zákon c. 576/2004 Zb. z. o zdravotnej starostlivosti, službách súvisiacich s poskytovaním zdravotnej starostlivosti a o zmene a doplnení niektorých zákonov)
    </p>
    <h2>Hlavné ciele SAR: </h2>

    <div class="accordion accordion-flush" id="accordionFlushExample">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    Poskytnúť epidemiologickú analýzu
                </button>
            </h2>
            <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    Poskytnúť epidemiologickú analýzu uskutočnených umelých náhrad kĺbov
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                    Identifikovať rizikové faktory
                </button>
            </h2>
            <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    Identifikovať rizikové faktory primárnych a revíznych implantácií, ktoré majú za následok zlyhanie artroplastiky, pričom zohľadňujú vek a pohlavie pacienta, typ implantátu a spôsob jeho fixácie, použitý chirurgický postup
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                    Znížit počet revíznych operácií
                </button>
            </h2>
            <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    Analýzou a odstránením rizikových faktorov znížit počet revíznych operácií
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                    Vytvoriť štandardný algoritmus pre pravidelné kontroly
                </button>
            </h2>
            <div id="flush-collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    Vytvoriť štandardný algoritmus pre pravidelné kontroly pacientov s umelou náhradou kĺbu, a tým eliminovať vznik rozsiahlych deštrukcií pri uvoľnení endoprotézy
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                    Zlepšiť kvalitu starostlivosti
                </button>
            </h2>
            <div id="flush-collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    Zlepšiť kvalitu starostlivosti o pacienta po umelej náhrade kĺbu
                </div>
            </div>
        </div>
    </div>


    <div class="flex-container">
        <div class="mapa">
            <iframe class = "mapaOdkaz" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3200.11733384481!2d18.917781598983357!3d49.06077990793338!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4714fedd2168822f%3A0x4223097f8de09f1f!2sSlovensk%C3%BD%20artroplastick%C3%BD%20register!5e0!3m2!1ssk!2ssk!4v1697901005707!5m2!1ssk!2ssk" ></iframe>

        </div>
        <div class="kontakt">
            <h3>Kontakt</h3>
            <h6>Adresa:</h6>
            Slovenský artroplastický register <br>
            Univerzitná nemocnica Martin<br>
            Kollárova 2<br>
            036 59 Martin<br>
            Slovenská republika<br>

            <h6>Telefonický kontakt:</h6>
            0123456789<br>
            <h6>E-mail:</h6>
            email@email.sk
        </div>

    </div>

</div>


</body>

</html>
@endsection
