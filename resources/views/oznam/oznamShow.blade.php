@extends('layouts.app-master')

@section('content')


    <div class="oznamNadpis">
        <h1 class="nadpisko">Prispevok {{ $oznam->id }}</h1>
        <h2>{{ $oznam->nazov }}</h2>
        <div class ="autor"> Author: {{ $oznam->autor }}</div>
        <div class="obsah_text ">

            <p class="oznamObsah">{{ $oznam->obsah }}</p>

        </div>

        <div class="tlacitko">
            Počet reakcií:{{$oznam->reakcie->where('reakcia', true)->count()}}
            @auth
            <form action="{{ route('oznam.like', $oznam->id) }}" method="post" id="likeForm">
                @csrf
                @method('POST')
                <button type="submit" class="btn btn-primary">
    {{--                @dd($oznam->reakcie)--}}
    {{--                like--}}
                    @php

                        $userReakcia = $oznam->reakcie->where('autor_reakcie', auth()->user()->username)->first();
                    @endphp
                    @if ($userReakcia->reakcia)
                        Unlike
                    @else
                        Like
                    @endif
                </button>
            </form>
            @endauth
        </div>
        <a class="btn btn-outline-secondary" href="{{ route('oznam.oznam') }}">Návrat do oznam menu</a>
    </div>


    <div class="oznamNadpis">
        <h2>Komentáris ({{$oznam->komentare->count()}})</h2>

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
{{--                <span class="textarea form-input" role="textbox" contenteditable></span>--}}

            </div>
            <button class="btn btn-primary pull-right">submit</button>

        </form>
        @endauth
{{--        @dd($oznam->komentare->count())--}}
        @foreach($oznam->komentare->reverse() as $koment)
        <div class="komentarObsah">
            <div class="komentarAutor">
                {{ $koment->autor }}
            </div>

            <div class="komentarText">
                {{ $koment->obsah }}
            </div>

            @auth
            @if($koment->autor == auth()->user()->username)
                <div class="col-sm tlacitko">
                    <form action="{{ route('oznam.CommentDestroy', $koment->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm tlacitko">Delete</button>
                    </form>
                </div>

                <div class="col-sm tlacitko">

                    <button class="btn btn-primary btn-sm tlacitko" onclick="toggleEditForm({{ $koment->id }})">Edit</button>
                    <form class="tlacitko" id="editForm_{{ $koment->id }}" action="{{ route('oznam.CommentUpdate', $koment->id) }}" method="post" style="display: none;">
                        @csrf
                        @method('PUT')
                        <textarea name="editedObsah" class="form-input" required>{{ $koment->obsah }}</textarea>
                        <button type="submit" class="btn btn-success btn-sm tlacitko">Save</button>
                    </form>
                </div>
            @endif
            @endauth
        </div>
        @endforeach

        <script>
            function toggleEditForm(commentId) {
                const editForm = document.getElementById(`editForm_${commentId}`);
                editForm.style.display = editForm.style.display === 'none' ? 'block' : 'none';
            }
        </script>
    </div>






@endsection
