@foreach ($oznam as $oznamLocal)
    <div class="col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-header">
                <h5 class="card-title">{{ $oznamLocal->nazov }}</h5>

            </div>
            <div class="card-body">
                <p class="card-text">Autor: {{ $oznamLocal->user->username }}</p>
                @php
                    $created_at = \Carbon\Carbon::parse($oznamLocal->created_at)->setTimezone('Europe/Berlin');
                    $updated_at = \Carbon\Carbon::parse($oznamLocal->updated_at)->setTimezone('Europe/Berlin');
                @endphp
                <p class="card-text">
                    @if ($created_at == $updated_at)
                        Vytvorené: {{ $created_at->format('d.m.Y H:i') }}
                    @else
                        Vytvorené: {{ $created_at->format('d.m.Y H:i') }}<br>
                        Upravené: {{ $updated_at->format('d.m.Y H:i') }}
                    @endif
                </p>
                @if($oznamLocal->tag && count($oznamLocal->tag) > 0)
                    <p class="card-text">Tagy: @foreach($oznamLocal->tag as $tag)
                            <span class="badge text-bg-info rounded-pill">{{ $tag->nazov }}</span>
                        @endforeach</p>
                @endif

                @if($oznamLocal->image_path)
                    <div class=" image-container">
                        <img src="{{ asset('storage/' . $oznamLocal->image_path) }}" alt="Oznam Image">
                    </div>
                @endif
            </div>
            <div class="card-footer">
                <div class="row">
                    @auth
                        @if($oznamLocal->user->id == auth()->user()->id || auth()->user()->hasAnyRole(['admin', 'superuser']))
                            <div class="col-sm tlacitko">
                                <a href="{{ route('oznam.oznamEdit', $oznamLocal->id) }}"
                                   class="btn btn-primary btn-sm tlacitko">Upraviť</a>
                            </div>
                            <div class="col-sm tlacitko">
                                <form action="{{ route('oznam.destroy', $oznamLocal->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm tlacitko">Delete
                                    </button>
                                </form>
                            </div>
                            <div class="col-sm tlacitko">
                                <a href="{{ route('oznam.tag', $oznamLocal->id) }}"
                                   class="btn btn-secondary btn-sm tlacitko">Tag</a>
                            </div>
                        @endif
                    @endauth
                    <div class="col-sm tlacitko">
                        <a href="{{ route('oznam.oznamShow', $oznamLocal->id) }}"
                           class="btn btn-success btn-sm tlacitko">Otvoriť</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
