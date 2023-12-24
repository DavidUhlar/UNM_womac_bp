<!doctype html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>{{ __('app.app_title') }}</title>



        <link rel="icon" type="image/png" href="{{ asset('pics/sar_logo.png')}}"/>


        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <link rel="stylesheet" href=" {{ asset('css/oznam.css')}}">
        <link rel="stylesheet" href=" {{ asset('css/style.css')}}">
        <link rel="stylesheet" href=" {{ asset('css/womac.css')}}">
        <link rel="stylesheet" href=" {{ asset('css/mapa.css')}}">



        <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
    <body>
        @include('layouts.partials.navbar')

        <main>
            @yield('content')
        </main>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        @section("scripts")

        @show

        @include('layouts.partials.footer')
    </body>
</html>
