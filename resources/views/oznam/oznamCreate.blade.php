@extends('layouts.app-master')

@section('content')
    <link rel="stylesheet" href=" {{ asset("css/oznam.css") }}">
    <script src="{{ asset("js/minLengthValidacia.js") }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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
                <h3>Vytvor oznam</h3>
                <form action="{{ route('oznam.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nazov">Názov</label>
                        <input type="text" class="form-control @if($errors->has('nazov')) is-invalid @endif" id="nazov" name="nazov" value="" required onblur="checkLength(this, 3, 'nazov musi mat 3 znaky.');" {{ old('nazov') }}>
                    </div>
                    <div class="form-group">
                        <label for="obsah">Obsah</label>
                        <textarea class="form-control" id="obsah" name="obsah" rows="3" required>{{ old('obsah') }}</textarea>
                    </div>

                    <div class="form-group">
                        <input type="file" name="image" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                    </div>
                    <button type="submit" class="btn mt-3 btn-primary">Vytvor oznam</button>
                </form>
            </div>
        </div>
    </div>



@endsection
