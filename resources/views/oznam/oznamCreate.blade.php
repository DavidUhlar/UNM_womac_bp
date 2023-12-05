@extends('layouts.app-master')

@section('content')



    <form action="{{ route('oznam.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="nazov" value="{{ old('title') }}" required>
        </div>
        <div class="form-group">
            <label for="body">Body</label>
            <textarea class="form-control" id="body" name="obsah" rows="3" required>{{ old('body') }}</textarea>
        </div>
        <button type="submit" class="btn mt-3 btn-primary">Create Post</button>
    </form>






@endsection
