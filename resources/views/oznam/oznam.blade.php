@extends('layouts.app-master')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-sm">
                <a href="{{ route('oznam.create') }}" class="btn btn-primary btn-sm">Create</a>
            </div>
            @foreach ($oznam as $post)
                <div class="col-sm">

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">{{ $post->nazov }}</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">{{ $post->text }}</p>
                        </div>
                        <div class="card-footer">
                            <div class="row">

                                @auth
                                <div class="col-sm">
                                    <a href="{{ route('oznam.oznamEdit', $post->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                </div>
                                <div class="col-sm">
                                    <form action="{{ route('oznam.destroy', $post->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </div>
                                @endauth
                                <div class="col-sm">
                                    <!-- Ensure you are passing the ID to the 'oznam.show' route -->
                                    <a href="{{ route('oznam.oznamShow', ['id' => $post->id]) }}" class="btn btn-success btn-sm">Show</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
