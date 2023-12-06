@extends('layouts.app-master')

@section('content')

    <link rel="stylesheet" href=" {{ asset("css/oznam.css") }}">



    <div class="oznamNadpis">
        <h1 class="nadpisko">Prispevok {{ $oznam->id }}</h1>
        <h2>{{ $oznam->nazov }}</h2>
        <div class ="autor"> Author: {{ $oznam->autor }}</div>
        <div class="obsah_text ">


            <p class="oznamObsah">{{ $oznam->obsah }}</p>

        </div>
        <a href="{{ route('oznam.oznam') }}">Oznam menu</a>
    </div>



@endsection
