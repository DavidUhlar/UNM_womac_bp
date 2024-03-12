
@extends('layouts.app-master')

@section('content')

    <link rel="stylesheet" href=" {{ asset('css/oznam.css') }}" />
    <link rel="stylesheet" href="{{ asset("css/oznamPicture.css") }}">
    <script src="{{ asset("js/likeAjax.js") }}"></script>
    <script src="{{ asset("js/koment.js") }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>

        var totalComments = {{ $oznam->komentare->count() }};
        var loadMoreCommentsRoute = @json(route("oznam.load-more-comments", $oznam->id));
    </script>

    <div class="oznamNadpis">
        <h1 class="nadpisko">Oznam {{ $oznam->id }}</h1>
        <h2>{{ $oznam->nazov }}</h2>


        <div class="tagy"><h4>Tagy:  @foreach($oznam->tag as $tag) <span class="badge text-bg-info rounded-pill">{{ $tag->nazov }}</span> @endforeach</h4></div>
        <div class ="autor"> Autor: {{ $oznam->user->username }}</div>
        <div class="komentarDatum">
            @php
                $created_at_oznam = \Carbon\Carbon::parse($oznam->created_at)->setTimezone('Europe/Berlin');
                $updated_at_oznam = \Carbon\Carbon::parse($oznam->updated_at)->setTimezone('Europe/Berlin');
            @endphp

            @if ($created_at_oznam == $updated_at_oznam)
                Vytvorené: {{ $created_at_oznam->format('d.m.Y H:i') }}
            @else
                Vytvorené: {{ $created_at_oznam->format('d.m.Y H:i') }}<br>
                Upravené: {{ $updated_at_oznam->format('d.m.Y H:i') }}
            @endif
        </div>
        @if($oznam->image_path)
            <div class="image_show">
                <img src="{{ asset('storage/' . $oznam->image_path) }}" alt="Oznam Image" >
            </div>
        @endif

        <div class="obsah_text ">

            <p class="oznamObsah">{{ $oznam->obsah }}</p>

        </div>

        <div class="tlacitko">
            Počet reakcií: <span id="likeCount">{{ $oznam->reakcie->where('reakcia', true)->count() }}</span>
            @auth
                <form action="{{ route('oznam.like', $oznam->id) }}" method="post" id="likeForm">
                    @csrf
                    @method('POST')

                    @php
                        $userReakcia = $oznam->reakcie->where('autor_reakcie', auth()->user()->id)->first()
                    @endphp

                    <button type="button" class="btn btn-primary" id="likeButton">
                        {{-- like/unlike text --}}

                        @if ($userReakcia && $userReakcia->reakcia)
                            Evidované
                        @else
                            Neevidované
                        @endif

                    </button>

                </form>
            @endauth
        </div>
        <a class="btn btn-outline-secondary" href="{{ route('oznam.oznam') }}">Návrat do oznam menu</a>
    </div>


    <div class="oznamNadpis">
        <h2>Diskusia ({{$oznam->komentare->count()}})</h2>

        @guest
            <div class="h6">
                Pre komentovanie je nutné byť prihlásený v účte
            </div>
        @endguest
        @auth
        <form action="{{ route('oznam.comment', $oznam->id) }}" class="komentarForm" method="post">
            @csrf
            <div>

                <textarea id="obsah" name="obsah" class="form-input" required="" placeholder="Komentár"></textarea>

            </div>
            <button class="btn btn-primary pull-right">potvrdiť</button>

        </form>
        @endauth
        <div id="comments-container">
            @foreach($oznam->komentare->reverse()->take(5) as $koment)
            <div class="komentarObsah" >
                <div class="komentarAutor">
                    {{ $koment->user->username }}
                </div>

                <div class="komentarText">
                    {{ $koment->obsah }}
                </div>
                <div class="komentarDatum">
                    @php
                        $created_at = \Carbon\Carbon::parse($koment->created_at)->setTimezone('Europe/Berlin');
                        $updated_at = \Carbon\Carbon::parse($koment->updated_at)->setTimezone('Europe/Berlin');
                    @endphp

                    @if ($created_at == $updated_at)
                        Vytvorené: {{ $created_at->format('d.m.Y H:i') }}
                    @else
                        Vytvorené: {{ $created_at->format('d.m.Y H:i') }}<br>
                        Upravené: {{ $updated_at->format('d.m.Y H:i') }}
                    @endif
                </div>
                @auth
                    @if($koment->user->id == auth()->user()->id || auth()->user()->hasAnyRole(['admin', 'superuser']))
                        <div class="tlacitkoContainer">
                            <div class="col-sm tlacitko">
                                <form action="{{ route('oznam.CommentDestroy', $koment->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm tlacitko">Delete</button>
                                </form>
                            </div>

                            <div class="col-sm tlacitko">

                                <button class="btn btn-primary btn-sm tlacitko" onclick="toggleEditForm({{ $koment->id }})">Upraviť</button>
                                <form class="tlacitko" id="editForm_{{ $koment->id }}" action="{{ route('oznam.CommentUpdate', $koment->id) }}" method="post" style="display: none;">
                                    @csrf
                                    @method('PUT')
                                    <textarea name="editedObsah" class="form-input" required>{{ $koment->obsah }}</textarea>
                                    <button type="submit" class="btn btn-success btn-sm tlacitko">Uložiť</button>
                                </form>
                            </div>
                        </div>
                   @endif
                @endauth
            </div>
            @endforeach
        </div>
        <div id="loading-message"></div>
    </div>

@endsection
