@extends('layouts.app-master')

@section('content')
    <link rel="stylesheet" href="{{ asset("css/oznam.css") }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @auth


        <div class="form-group">
            <form action="{{ route('oznam.associateTag', $oznam->id) }}" method="post" class="komentarForm">
                @csrf

                <label>Tags:</label>
                <br>
                @foreach($tags as $tag)
                    <label>
                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}" {{ in_array($tag->id, $associatedTags) ? 'checked' : '' }}>
                        {{ $tag->nazov }}
                    </label><br>
                @endforeach

                <input type="submit" value="Submit">
            </form>
        </div>

    @endauth

    @guest
        <div class="centerNadpis">
            <h1>Nemôžeš meniť oznam bez prihlásenia</h1>
        </div>
    @endguest
@endsection
