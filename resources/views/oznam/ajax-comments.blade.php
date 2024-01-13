@foreach($comments as $koment)
    <div class="komentarObsah" id="comments-container">
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

