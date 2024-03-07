@foreach($comments as $koment)
    <div class="komentarObsah" id="comments-container">
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

