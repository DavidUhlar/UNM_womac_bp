@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-4 rounded">
        <h1>Pridať nového používateľa</h1>
        <div class="lead">
            Pridanie používateľa
        </div>

        *Vytvorený používateľ bude mať heslo password312!
        <div class="container mt-4">

            <form method="POST" action="">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Meno</label>
                    <input value="{{ old('name') }}"
                        type="text"
                        class="form-control"
                        name="name"
                        placeholder="Meno" required>

                    @if ($errors->has('name'))
                        <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input value="{{ old('email') }}"
                        type="email"
                        class="form-control"
                        name="email"
                        placeholder="Email adresa" required>
                    @if ($errors->has('email'))
                        <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input value="{{ old('username') }}"
                        type="text"
                        class="form-control"
                        name="username"
                        placeholder="Username" required>
                    @if ($errors->has('username'))
                        <span class="text-danger text-left">{{ $errors->first('username') }}</span>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Uložiť používateľa</button>
                <a href="{{ route('users.index') }}" class="btn btn-default">Návrat</a>
            </form>
        </div>

    </div>
@endsection
