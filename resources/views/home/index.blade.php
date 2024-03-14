@extends('layouts.app-master')

@section('content')


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

    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{asset('pics/klb.png')}}" class="d-block w-100 " alt="klb">
            </div>
            <div class="carousel-item">
                <img src="{{asset('pics/knee-replacement.jpg')}}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{asset('pics/kostra.png')}}" class="d-block w-1000" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
                data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
                data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>



    <div class="obsah_text">
        <h2>Úvod</h2>
        <p>
            Táto stránka sa zaoberá zadávaním a spracovávaním
            <a class="linkText" href="https://www.physio-pedia.com/WOMAC_Osteoarthritis_Index">WOMAC</a>
            dotazníkov od pacientov

        </p>

        <h2>Womac</h2>
        <p>
            The Western Ontario and McMaster Universities Arthritis Index (<a class="linkText"
                                                                              href="https://www.physio-pedia.com/WOMAC_Osteoarthritis_Index">WOMAC</a>)
            je široko používaný pri hodnotení osteoartrózy bedrového kĺbu a kolena.
            Ide o dotazník, ktorý si pacienti vyplnia.
        </p>
        <ul>
            Dotazník pozostáva z 24 položiek rozdelených do 3 subškál:
        </ul>

        <ul class="zoznamWomac">


            <li>
                <a class="hlavickaBold">Bolesť (5 položiek):</a>
                <ul>
                    <li>počas chôdze</li>
                    <li>počas chôdze po schodoch</li>
                    <li>v posteli</li>
                    <li>pri sedení alebo ležaní</li>
                    <li>pri vzpriamenej polohe</li>
                </ul>
            </li>
            <li>
                <a class="hlavickaBold">Stuhnutosť (2 položky):</a>
                <ul>
                    <li>po prvom prebudení</li>
                    <li>neskôr počas dňa</li>
                </ul>
            </li>
            <li>
                <a class="hlavickaBold">Fyzické funkcie (17 položiek):</a>
                <ul>
                    <li>používanie schodov</li>
                    <li>vstávanie zo sedenia</li>
                    <li>státie</li>
                    <li>ohýbanie sa</li>
                    <li>chôdza</li>
                    <li>nastupovanie / vystupovanie z auta</li>
                    <li>nakupovanie</li>
                    <li>obliekanie / vyzúvanie ponožiek</li>
                    <li>vstávanie z postele</li>
                    <li>ľahnutie si do postele</li>
                    <li>vchádzanie / vystupovanie z vane</li>
                    <li>sedenie</li>
                    <li>sadanadie/vstávanie z toalety</li>
                    <li>ťažké domáce práce</li>
                    <li>ľahké domáce práce</li>

                </ul>
            </li>

        </ul>
        <p>
            Dotazník sa následne vyhodnocuje a môžu sa z neho robiť rôzne štatistické výstupy, ktoré môžu pomôcť
            lekárovi pri stanovovaní liečby
        </p>

    </div>


@endsection
