{{--<header class="p-3 bg-dark text-white">--}}
{{--  <div class="container">--}}
{{--    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">--}}
{{--      <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">--}}
{{--        <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>--}}
{{--      </a>--}}

{{--      <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">--}}
{{--        <li><a href="{{ route('home.index') }}" class="nav-link px-2 text-white">Home</a></li>--}}
{{--        @auth--}}
{{--          @role('Admin')--}}
{{--          <li><a href="{{ route('home.womac') }}" class="nav-link px-2 text-white">Users</a></li>--}}
{{--          <li><a href="{{ route('roles.index') }}" class="nav-link px-2 text-white">Roles</a></li>--}}
{{--          @endrole--}}
{{--          <li><a href="{{ route('posts.index') }}" class="nav-link px-2 text-white">Posts</a></li>--}}
{{--        @endauth--}}
{{--      </ul>--}}

{{--      <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">--}}
{{--        <input type="search" class="form-control form-control-dark" placeholder="Search..." aria-label="Search">--}}
{{--      </form>--}}

{{--      @auth--}}
{{--        {{auth()->user()->name}}&nbsp;--}}
{{--        <div class="text-end">--}}
{{--          <a href="{{ route('logout.perform') }}" class="btn btn-outline-light me-2">Logout</a>--}}
{{--        </div>--}}
{{--      @endauth--}}

{{--      @guest--}}
{{--        <div class="text-end">--}}
{{--          <a href="{{ route('login.perform') }}" class="btn btn-outline-light me-2">Login</a>--}}
{{--          <a href="{{ route('register.perform') }}" class="btn btn-warning">Sign-up</a>--}}
{{--        </div>--}}
{{--      @endguest--}}
{{--    </div>--}}
{{--  </div>--}}
{{--</header>--}}
<?php $routeName = Route::currentRouteName() ?>

<nav class="navbar sticky-top navbar-expand-md navbar-dark bg-dark" aria-label="Fourth navbar example">
    <div class="container-fluid">

        <a class="navbar-brand">
            <img class="logo" src="pics/sar_logo.png" alt="logo">
            Slovenský artroplastický register
        </a>
        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse collapse" id="navbarsExample04" style="">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                <li class="nav-item">
                    <a class="nav-link @if($routeName == 'home.index') active @endif" href="{{ route('home.index') }}">Hlavná
                        stránka</a>
                </li>
                @auth
                    <li class="nav-item">
                        <a class="nav-link @if($routeName == 'home.womac') active @endif"
                           href="{{ route('home.womac') }}">Womac</a>
                    </li>
                @endauth
                <li class="nav-item">
                    <a class="nav-link @if($routeName == 'home.o_nas') active @endif" href="{{route('home.o_nas')}}">O
                        nás</a>
                </li>

            </ul>

                    <ul class="navbar-nav ms-auto">

                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register.perform') }}">Register</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login.perform') }}">Login</a>
                            </li>
                        @endguest
                        @auth
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout.perform') }}">Logout</a>
                            </li>
                        @endauth

                    </ul>








        </div>
    </div>
</nav>
