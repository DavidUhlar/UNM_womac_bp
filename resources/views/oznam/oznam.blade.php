@extends('layouts.app-master')

@section('content')

    <script>
        var totalOznam = {{ $oznamCount }};
        var loadMoreOznamRoute = @json(route("oznam.load-more-oznam"));

    </script>
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"--}}
{{--            integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="--}}
{{--            crossorigin="anonymous" referrerpolicy="no-referrer"></script>--}}
    <script src="{{ asset("js/oznamAjax.js") }}"></script>

    <div class="container mt-5">
        @auth
            <div class="col-sm create">
                <a href="{{ route('oznam.create') }}" class="btn btn-primary btn-sm">Vytvoriť oznam</a>
                @can('oznam.tagMenu')
                    <a href="{{ route('oznam.tagMenu') }}" class="btn btn-primary btn-sm">Vytvoriť tag</a>
                @endcan
                @can('oznam.tagMenuDelete')
                    <a href="{{ route('oznam.tagMenuDelete') }}" class="btn btn-primary btn-sm">Vymazať tag</a>
                @endcan
            </div>
        @endauth
        <div>
            <h2> Počet oznamov: {{$oznamCount}}</h2>

        </div>
        <br>
        <div class="row" id="oznam-container">


            @include('oznam.ajax-oznam')


        </div>
        <div class="text-center mt-3">
            <button class="btn btn-primary" id="load-more-oznam">Načítať viac príspevkov</button>
        </div>
    </div>

@endsection
