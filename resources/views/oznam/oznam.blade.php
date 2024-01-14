@extends('layouts.app-master')

@section('content')

{{--    <link rel="stylesheet" href="{{ asset("css/oznam.css") }}">--}}
    <link rel="stylesheet" href="{{ asset("css/oznamPicture.css") }}">
    <div class="container mt-5">
        @auth
        <div class="col-sm create">
            <a href="{{ route('oznam.create') }}" class="btn btn-primary btn-sm">Create</a>
        </div>
        @endauth
        <div><h2> Počet oznamov: {{$oznamCount}}</h2></div>
            <br>
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
                        @php
                            $tags = $post->tags->pluck('nazov')->all()
                        @endphp

                        @if($tags)
                        <div class="card-body">
                            <p class="card-text">Tagy: @foreach($tags as $tag) <span class="badge text-bg-info rounded-pill">{{ $tag }}</span> @endforeach</p>

                        </div>
                        @endif
                        @if($post->image_path)
                        <div class="card-body image-container">
                            <img src="{{ asset('storage/' . $post->image_path) }}" alt="Oznam Image">
                        </div>
                        @endif
                        <div class="card-footer">
                            <div class="row">
                                @auth
                                    @if($post->autor == auth()->user()->username || auth()->user()->username == 'admin')
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
                                        <div class="col-sm tlacitko">
                                            <a href="{{ route('oznam.tag', $post->id) }}" class="btn btn-primary btn-sm tlacitko">Tag</a>
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
