@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-4 rounded">
        <h1>Zobrazenie používateľa</h1>
        <div class="lead">

        </div>

        <div class="container mt-4">
            <div>
                Meno: {{ $user->name }}
            </div>
            <div>
                Email: {{ $user->email }}
            </div>
            <div>
                Username: {{ $user->username }}
            </div>
        </div>

    </div>
    <div class="mt-4">
        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info">Upraviť</a>
        <a href="{{ route('users.index') }}" class="btn btn-default">Návrat</a>
    </div>
@endsection
