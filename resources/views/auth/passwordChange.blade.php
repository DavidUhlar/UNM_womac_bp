@extends('layouts.app-master')
@section('content')
    <div class="container">

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <form method="post" action="{{ route('passwordChange.change') }}" class="col-md-4 offset-md-4 ">
            @csrf
            <h1 class="h3 mb-3 mt-4 fw-normal ">Zmena hesla</h1>
            <div class="form-group mb-3">
                <label for="form-password-change-old" class="form-label">Pôvodné heslo</label>
                <input type="password" class="form-control" id="form-password-change-old" name="old_password" placeholder="Pôvodné heslo" required>
            </div>
            <div class="form-group mb-3">
                <label for="form-password-change-new" class="form-label">Nové heslo</label>
                <input type="password" class="form-control" id="form-password-change-new" name="new_password" placeholder="Nové heslo" required>
            </div>
            <div class="form-group mb-3">
                <label for="form-password-change-new2" class="form-label">Potvrdenie nového hesla</label>
                <input type="password" class="form-control" id="form-password-change-new2" name="new_password_confirmation" placeholder="Nové heslo" required>
            </div>

            <button class="w-100 btn btn-lg btn-primary" type="submit">Zmeniť heslo</button>
        </form>
    </div>
@endsection
