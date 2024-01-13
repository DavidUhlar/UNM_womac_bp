
@extends('layouts.app-master')

@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <div class="oznamNadpis">
        <h1 class="nadpisko">Prispevok {{ $oznam->id }}</h1>
        <h2>{{ $oznam->nazov }}</h2>

        <div class="tagy"><h4>Tagy:  @foreach($tagNames as $tag) <span class="badge text-bg-info rounded-pill">{{ $tag }}</span> @endforeach</h4></div>
        <div class ="autor"> Author: {{ $oznam->autor }}</div>
        <div class="obsah_text ">

            <p class="oznamObsah">{{ $oznam->obsah }}</p>

        </div>

        <div class="tlacitko">
            Počet reakcií: <span id="likeCount">{{ $oznam->reakcie->where('reakcia', true)->count() }}</span>
            @auth
                <form action="{{ route('oznam.like', $oznam->id) }}" method="post" id="likeForm">
                    @csrf
                    @method('POST')
                    <button type="button" class="btn btn-primary" id="likeButton">
                        {{-- like/unlike text --}}
                        @php
                            $userReakcia = $oznam->reakcie->where('autor_reakcie', auth()->user()->username)->first();
                        @endphp
                        @if ($userReakcia && $userReakcia->reakcia)
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
        <div id="comments-container">
            @foreach($oznam->komentare->reverse()->take(5) as $koment)
            <div class="komentarObsah" >
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
        </div>
        <div id="loading-message"></div>
        <script>
            $(document).ready(function () {
                $('#likeButton').click(function (e) {
                    e.preventDefault(); // Prevent the default form submission


                    $.ajax({
                        type: 'POST',
                        url: $('#likeForm').attr('action'),
                        data: $('#likeForm').serialize(), // Serialize the form data
                        success: function (response) {
                            console.log('Like action successful:', response);
                            // Update the UI or perform other actions if needed
                            // For example, you can update the like/unlike text
                            $('#likeButton').text(response.liked ? 'Unlike' : 'Like');
                            $('#likeCount').text(response.likeCount);
                        },
                        error: function (error) {
                            console.error('Error performing like action:', error);
                        }
                    });
                });
            });
        </script>
        <script>
            function toggleEditForm(commentId) {
                const editForm = document.getElementById(`editForm_${commentId}`);
                editForm.style.display = editForm.style.display === 'none' ? 'block' : 'none';
            }


            var page = 2;
            var loading = false;
            var totalComments = {{ $oznam->komentare->count() }};
            var commentsDisplayed = 0;

            function loadMoreComments() {

                if (loading || (commentsDisplayed >= totalComments)) {
                    return;
                }


                loading = true;
                $('#loading-message').text('Loading more comments...');
                $.ajax({
                    url: '{{ route("oznam.load-more-comments", $oznam->id) }}?page=' + page,
                    type: 'GET',
                    success: function (data) {
                        $('#comments-container').append(data);
                        page++;
                        commentsDisplayed += 5;
                    },
                    error: function (error) {
                        console.error('Error loading more comments:', error);
                    },
                    complete: function () {
                        loading = false;

                        $('#loading-message').text('');

                        if (commentsDisplayed >= totalComments) {
                            $(window).off('scroll');
                        }
                    },
                });
            }

            $(window).scroll(function() {
                if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
                    setTimeout(function () {

                        loadMoreComments();

                    }, 2000);
                }
            });

            // loadMoreComments();

        </script>
    </div>






@endsection
