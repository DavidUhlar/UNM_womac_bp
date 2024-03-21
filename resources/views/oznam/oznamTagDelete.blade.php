@extends('layouts.app-master')

@section('content')
{{--    <link rel="stylesheet" href="{{ asset("css/oznam.css") }}">--}}
    <script src="{{ asset("js/minLengthValidacia.js") }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container h-100 mt-5">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-10 col-md-8 col-lg-6">
                <h3>Vymaž tag</h3>
                <form action="{{route('oznam.deleteTag')}}" method="post" class="tag-formular">
                    @csrf
                    @method('DELETE')

                    @foreach($tags as $tag)
                        <label class="tag-label">
                            <input type="checkbox" name="tags[]" value="{{ $tag->id }}" >
                            {{ $tag->nazov }}
                        </label><br>
                    @endforeach

                    <input type="submit" value="Potrvrdiť tagy" class="tag-button">
                </form>
            </div>
        </div>
    </div>
@endsection
