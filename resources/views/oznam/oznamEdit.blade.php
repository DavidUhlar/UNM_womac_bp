@extends('layouts.app-master')

@section('content')
    <link rel="stylesheet" href=" {{ asset("css/oznam.css") }}">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>


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

    <div class="container h-100 mt-5">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-10 col-md-8 col-lg-6">
                <h3>Edit oznamu</h3>
                <form action="{{ route('oznam.update', $oznam->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')


                    @if($oznam->image_path)

                        <div class="form-group">
                            <img src="{{ asset('storage/' . $oznam->image_path) }}" alt="Existing Image">
                        </div>
                        <div class="form-group">
                            <label class="fs-5" for="delete_image">Zmazanie aktuálneho obrázka:</label>
                            <input type="checkbox" name="delete_image" id="delete_image" value="1">
                        </div>
                    @endif
                    <br>


                    <div class="form-group">
                        <label class="fs-5" for="nazov">Title</label>
                        <input type="text" class="form-control  @if($errors->has('nazov')) is-invalid @endif" id="nazov" name="nazov"
                               value="{{ $oznam->nazov }}" required onblur="checkLength(this, 3, 'The nazov must be at least 3 characters.');"{{ old('nazov') }}>
                    </div>
                    <div class="form-group">
                        <label class="fs-5" for="obsah">Body</label>
                        <textarea class="form-control" id="obsah" name="obsah" rows="3" required>{{ $oznam->obsah }}{{ old('obsah') }}</textarea>
                    </div>
                    <br>
                    <div class="form-group fs-5">
                        <input type="file" name="image" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                    </div>


                    <button type="submit" class="btn mt-3 btn-primary">Edit oznamu</button>
                </form>


            </div>
        </div>
    </div>


    <script type="text/javascript">
        function checkLength(element, min_lenght, err_msg) {
            var lenItem = $(element).val().length;

            if (lenItem < min_lenght) {
                $(element).addClass("is-invalid");

                element.setCustomValidity(err_msg);
                element.reportValidity();

                setTimeout(function() {
                    element.focus();
                }, 10);
                element.focus();
            } else {
                $(element).removeClass("is-invalid");
                element.setCustomValidity('');
            }

        }
    </script>



    @endauth

    @guest
        <div class="centerNadpis">
            <h1>Nemôžeš meniť oznam bez prihlásenia</h1>
        </div>
    @endguest
@endsection
