@extends('layouts.app-master')

@section('content')
{{--<div class="container h-100 mt-5">--}}
{{--    <div class="row h-100 justify-content-center align-items-center">--}}
{{--        <div class="col-10 col-md-8 col-lg-6">--}}
{{--            <h3>Update Post</h3>--}}
{{--            <form action="{{ route('oznam.update', $oznam->id) }}" method="post">--}}
{{--                @csrf--}}
{{--                @method('PUT')--}}

{{--                <div class="form-group">--}}
{{--                    <label for="title">Title</label>--}}
{{--                    <input type="text" class="form-control" id="title" name="title"--}}
{{--                           value="{{ $oznam->nazov }}" required>--}}
{{--                </div>--}}
{{--                <div class="form-group">--}}
{{--                    <label for="body">Body</label>--}}
{{--                    <textarea class="form-control" id="body" name="body" rows="3" required>{{ $oznam->obsah }}</textarea>--}}
{{--                </div>--}}
{{--                <button type="submit" class="btn mt-3 btn-primary">Update Post</button>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}



    <div class="container h-100 mt-5">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-10 col-md-8 col-lg-6">
                <h3>Update Post</h3>
                <form action="{{ route('oznam.update', $oznam->id) }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="nazov">Title</label>
                        <input type="text" class="form-control" id="nazov" name="nazov"
                               value="{{ $oznam->nazov }}" required>
                    </div>
                    <div class="form-group">
                        <label for="obsah">Body</label>
                        <textarea class="form-control" id="obsah" name="obsah" rows="3" required>{{ $oznam->obsah }}</textarea>
                    </div>
                    <button type="submit" class="btn mt-3 btn-primary">Update Post</button>
                </form>
            </div>
        </div>
    </div>


@endsection
