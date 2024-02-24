@extends('layouts.app-master')

@section('content')
{{--    <link rel="stylesheet" href="{{ asset("css/oznam.css") }}">--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @auth


        <div>

            <form action="{{ route('oznam.associateTag', $oznam->id) }}" method="post" class="tag-formular">
                @csrf

                <label class="tag-label-nadpis">Príspevok: {{$oznam->id}}</label><br>
                <label class="tag-label-nadpis">Názov: {{$oznam->nazov}}</label><br><br>
                <label class="tag-label-nadpis">Tagy:</label><br>


                @foreach($tags as $tag)
                    <label class="tag-label">
                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}" {{ in_array($tag->id, $associatedTags) ? 'checked' : '' }}>
                        {{ $tag->nazov }}
                    </label><br>
                @endforeach

                <input type="submit" value="Potrvrdiť tagy" class="tag-button">
            </form>
        </div>

    @endauth

    @guest
        <div class="centerNadpis">
            <h1>Nemôžeš meniť oznam bez prihlásenia</h1>
        </div>
    @endguest
@endsection
