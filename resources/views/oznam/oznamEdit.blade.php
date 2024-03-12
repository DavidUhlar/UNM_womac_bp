@extends('layouts.app-master')

@section('content')
    <link rel="stylesheet" href="{{ asset("css/oznamPicture.css") }}"/>
    <script src="{{ asset("js/minLengthValidacia.js") }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>



    @auth
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <h3>Edit oznamu</h3>
                <form action="{{ route('oznam.update', $oznam->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')


                    @if($oznam->image_path)

                        <div class="mb-3">
                            <img src="{{ asset('storage/' . $oznam->image_path) }}" alt="Existing Image" class="obrazok-edit">
                        </div>
                        <div class="mb-3">
                            <label class="fs-5" for="delete_image">Zmazanie aktuálneho obrázka:</label>
                            <input type="checkbox" name="delete_image" id="delete_image" value="1">
                        </div>
                    @endif
                    <br>


                    <div class="mb-3">
                        <label class="oznamFormLabel" for="nazov">Názov</label>
                        <input type="text" class="form-control  @if($errors->has('nazov')) is-invalid @endif" id="nazov" name="nazov"
                               value="{{ $oznam->nazov }}" required onblur="checkLength(this, 4, 'názov musí mať 4 znaky.');"{{ old('nazov') }}>
                    </div>
                    <div class="mb-3">
                        <label class="oznamFormLabel" for="obsah">Obsah</label>
                        <textarea class="form-control" id="obsah" name="obsah" rows="3" required>{{ $oznam->obsah }}{{ old('obsah') }}</textarea>
                    </div>
                    <br>
                    <div class="mb-3">
                        <label class="oznamFormLabel" for="image">Obrázok</label>
                        <input type="file" name="image" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                    </div>


                    <button type="submit" class="btn mt-3 btn-primary mb-4">Edit oznamu</button>
                </form>


            </div>
        </div>
    </div>


    @endauth

    @guest
        <div class="centerNadpis">
            <h1>Nemôžeš meniť oznam bez prihlásenia</h1>
        </div>
    @endguest
@endsection
