@extends('layouts.app-master')

@section('content')

    <link rel="stylesheet" href="{{ asset("css/oznam.css") }}">
    <div class="container mt-5">
        @auth
        <div class="col-sm create">
            <a href="{{ route('oznam.create') }}" class="btn btn-primary btn-sm">Create</a>
        </div>
        @endauth
        <div class="row" id="oznam-container">
            @foreach ($oznam as $post)
                <div class="col-sm-6 mb-3">
                    <div class="card h-100">
                        <div class="card-header">
                            <h5 class="card-title">{{ $post->nazov }}</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Autor: {{ $post->autor }}</p>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                @auth
                                    @if($post->autor == auth()->user()->username)
                                        <div class="col-sm tlacitko">
                                            <a href="{{ route('oznam.oznamEdit', $post->id) }}" class="btn btn-primary btn-sm tlacitko">Edit</a>
                                        </div>
                                        <div class="col-sm tlacitko">
                                            <form action="{{ route('oznam.destroy', $post->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm tlacitko">Delete</button>
                                            </form>
                                        </div>
                                    @endif
                                @endauth
                                <div class="col-sm tlacitko">
                                    <a href="{{ route('oznam.oznamShow', ['id' => $post->id]) }}" class="btn btn-success btn-sm tlacitko">Show</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-3">
            <button class="btn btn-primary" id="load-more-posts">Load More</button>
        </div>
    </div>

    <script>
        var page = 2;
        var totalOznam = {{ $oznamCount }};

        var oznamDisplayed = 0;

        $('#load-more-posts').on('click', function () {
            $.ajax({
                url: '{{ url('/oznam_index/load-more-posts') }}',
                type: 'GET',
                data: { page: page },
                success: function (data) {
                    $('#oznam-container').append(data);
                    page++;
                    oznamDisplayed += 6;

                    if (oznamDisplayed >= totalOznam) {
                        $('#load-more-posts').hide();
                    }
                },
                error: function (error) {
                    console.error('Error loading more posts:', error);
                }
            });
        });
    </script>
@endsection
