@extends('layouts.app-master')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('oznam.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="title">Nazov</label>
            <input type="text" class="form-control @if($errors->has('nazov')) is-invalid @endif" id="title" name="nazov" value="{{ old('title') }}" required>
        </div>
        <div class="form-group">
            <label for="body">Obsah</label>
            <textarea class="form-control" id="body" name="obsah" rows="3" required>{{ old('body') }}</textarea>
        </div>
        <button type="submit" class="btn mt-3 btn-primary">Create Post</button>
    </form>






@endsection
