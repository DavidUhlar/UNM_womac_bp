

<?php $routeName = Route::currentRouteName() ?>
<link rel="stylesheet" href=" {{ asset('css/navbar.css')}}">

<nav class="navbar sticky-top navbar-expand-md navbar-dark bg-dark" aria-label="Fourth navbar example">
    <div class="container-fluid">

        <a class="navbar-brand">
            <img class="logo" src="{{asset('pics/sar_logo.png')}}" alt="logo">
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
                <li class="nav-item">
                    <a class="nav-link @if(Str::startsWith($routeName, 'oznam.')) active @endif" href="{{route('oznam.oznam')}}">Oznam</a>
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
