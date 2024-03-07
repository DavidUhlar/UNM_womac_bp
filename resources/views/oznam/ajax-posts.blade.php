{{--<link rel="stylesheet" href="{{ asset("css/oznamPicture.css") }}">--}}
    @foreach ($oznam as $post)
        <div class="col-sm-6 mb-3">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title">{{ $post->nazov }}</h5>

                </div>
                <div class="card-body">
                    <p class="card-text">Autor: {{ $post->user->username }}</p>

                </div>

                <div class="card-body">

                    @php
                        $created_at = \Carbon\Carbon::parse($post->created_at)->setTimezone('Europe/Berlin');
                        $updated_at = \Carbon\Carbon::parse($post->updated_at)->setTimezone('Europe/Berlin');
                    @endphp
                    <p class="card-text">
                        @if ($created_at == $updated_at)
                            Vytvorené: {{ $created_at->format('d.m.Y H:i') }}
                        @else
                            Vytvorené: {{ $created_at->format('d.m.Y H:i') }}<br>
                            Upravené: {{ $updated_at->format('d.m.Y H:i') }}
                        @endif
                    </p>
                </div>
                @php
//                    $tags = $post->tags->pluck('nazov')->all()
                    $tags = $post->tag ? $post->tag->pluck('nazov')->all() : [];
                @endphp

                @if($tags)
                    <div class="card-body">
                        <p class="card-text">Tagy: @foreach($tags as $tag) <span class="badge text-bg-info rounded-pill">{{ $tag }}</span> @endforeach</p>

                    </div>
                @endif
                @if($post->image_path)
                    <div class="card-body image-container">
                        <img src="{{ asset('storage/' . $post->image_path) }}" alt="Oznam Image">
                    </div>
                @endif
                <div class="card-footer">
                    <div class="row">
                        @auth
                            @if($post->user->id == auth()->user()->id || auth()->user()->hasAnyRole(['admin', 'superuser']))
                                <div class="col-sm tlacitko">
                                    <a href="{{ route('oznam.oznamEdit', $post->id) }}" class="btn btn-primary btn-sm tlacitko">Upraviť</a>
                                </div>
                                <div class="col-sm tlacitko">
                                    <form action="{{ route('oznam.destroy', $post->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm tlacitko">Delete</button>
                                    </form>
                                </div>
                                <div class="col-sm tlacitko">
                                    <a href="{{ route('oznam.tag', $post->id) }}" class="btn btn-secondary btn-sm tlacitko">Tag</a>
                                </div>
                            @endif
                        @endauth
                        <div class="col-sm tlacitko">
                            <a href="{{ route('oznam.oznamShow', ['id' => $post->id]) }}" class="btn btn-success btn-sm tlacitko">Otvoriť</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

