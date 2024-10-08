

<?php $routeName = Route::currentRouteName() ?>
<link rel="stylesheet" href=" {{ asset('css/navbar.css')}}">

<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark" aria-label="Fourth navbar example">
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
                    <a class="nav-link @if($routeName == 'home.index') active @endif" href="{{ route('home.index') }}">
                        Hlavná stránka
                    </a>
                </li>

                @auth
                    @if(auth()->user()->can('home.womac'))
                        <li class="nav-item">
                            <a class="nav-link @if($routeName == 'home.womac' || Str::startsWith($routeName, 'womac.')) active @endif"
                               href="{{ route('home.womac') }}">Womac</a>
                        </li>
                    @endif
                    @if(auth()->user()->can('export.export'))
                        <li class="nav-item">
                            <a class="nav-link @if($routeName == 'export.export' || Str::startsWith($routeName, 'export.')) active @endif"
                               href="{{ route('export.export') }}">Export</a>
                        </li>
                    @endif
                @endauth

                <li class="nav-item">
                    <a class="nav-link @if($routeName == 'home.o_nas') active @endif" href="{{route('home.o_nas')}}">O
                        nás</a>
                </li>

                @auth
                    @if(auth()->user()->can('oznam.oznam'))
                        <li class="nav-item">
                            <a class="nav-link @if(Str::startsWith($routeName, 'oznam.')) active @endif"
                               href="{{route('oznam.oznam')}}">Oznam</a>
                        </li>
                    @endif
                @endauth
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

                    <li class="nav-item dropdown">
                        <button class="btn btn-dark dropdown-toggle account-navbar" data-bs-toggle="dropdown"
                                aria-expanded="false">
                            {{auth()->user()->username}}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li><a class="dropdown-item" href="{{route('passwordChange.show')}}">Zmena hesla</a></li>


                            @can('users.index')
                                <div class="dropdown-divider bg-white"></div>
                                <li>
                                    <a class="dropdown-item" href="{{ route('users.index') }}">Používatelia</a>
                                </li>
                            @endcan

                            @can('roles.index')
                                <li>
                                    <a class="dropdown-item" href="{{ route('roles.index') }}">Role</a>
                                </li>
                            @endcan
                            @can('permissions.index')
                                <li>
                                    <a class="dropdown-item" href="{{ route('permissions.index') }}">Povolenia</a>
                                </li>
                            @endcan

                        </ul>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout.perform') }}">Logout</a>
                    </li>
                @endauth

            </ul>


        </div>
    </div>
</nav>
