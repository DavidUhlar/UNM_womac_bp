<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>{{ __('app.app_title') }}</title>

    <!-- Bootstrap -->
    @vite(['resources/js/app.js'])

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }
      .form-signin {
          width: 100%;
          max-width: 300px;
          padding: 15px;
          margin: auto;
      }
      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

    </style>
</head>
<body class="text-center">

    <main class="form-signin">

        @yield('content')

    </main>


</body>
</html>
