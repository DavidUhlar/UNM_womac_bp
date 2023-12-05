@extends('layouts.app-master')

@section('content')





    <div class="centerNadpis">
        <h1>Prispevok {{ $oznam->id }}</h1>
        <h2>{{ $oznam->nazov }}</h2>
        <p>{{ $oznam->obsah }}</p>
        <p>Author: {{ $oznam->autor }}</p>
        <a href="{{ route('oznam.oznam') }}">Oznam menu</a>
    </div>



@endsection
