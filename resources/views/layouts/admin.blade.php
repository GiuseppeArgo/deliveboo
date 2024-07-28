<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Deliveboo') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('logoetichettachiaro.png') }}">

    <!-- Fontawesome 6 cdn -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css'
        integrity='sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=='
        crossorigin='anonymous' referrerpolicy='no-referrer' />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])

</head>

<body>
    <div id="app">

        {{-- header --}}
        <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap shadow container-fluid p-2">

            {{-- logo --}}
            <div class="row justify-content-between ps-1">
                <a class="navbar-brand col-md-3 col-lg-2" href="/">Deliveboo</a>

                {{-- menu hamburger --}}
                <button class="navbar-toggler position-absolute d-md-none collapsed" type="button"
                    data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                {{-- /menu hamburger --}}

            </div>
            {{-- /logo --}}


            {{-- /nav bar --}}
            <div class="navbar-nav">
                <div class="nav-item text-nowrap ms-2 d-none d-md-block">
                    <a class="nav-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        {{ __('Esci') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
            {{-- /nav bar --}}

        </header>
        {{-- /header --}}


        <div class="container-fluid vh-100">
            <div class="row h-100">

                {{-- sidebar --}}
                <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-dark navbar-dark sidebar collapse">
                    <div class="position-sticky pt-3">
                        <ul class="d-flex flex-column fs-5 gap-2">

                            {{-- user --}}
                            <li class="nav-item">
                                <a class="nav-link text-white {{ Route::currentRouteName() == 'dashboard' ? 'bg-secondary' : '' }}"
                                    href="{{ route('admin.dashboard') }}">
                                    <i class="fa-solid fa-user"></i> Profilo
                            </li>
                            {{-- /user --}}


                            {{-- home --}}
                            <li>
                                <a class="nav-link text-white {{ Route::currentRouteName() == 'dashboard' ? 'bg-secondary' : '' }}"
                                    href="{{ route('admin.restaurants.index') }}">
                                    <i class="fa-solid fa-shop"></i> Il tuo ristorante
                                </a>
                            </li>
                            {{-- /home --}}

                            {{-- hide and show link --}}
                            @if (isset($userHasRestaurant) && $userHasRestaurant)

                                {{-- Show menu --}}
                                <li>
                                    <a class="nav-link text-white"
                                        {{ Route::currentRouteName() == 'dashboard' ? 'bg-secondary' : '' }}
                                        href="{{ route('admin.dishes.index') }}">
                                        <i class="fa-solid fa-utensils"></i> Menu
                                    </a>
                                </li>
                                {{-- /Show menu --}}
                                
                                {{-- Add dish --}}
                                <li>
                                    <a class="nav-link text-white {{ Route::currentRouteName() == 'dashboard' ? 'bg-secondary' : '' }}"
                                        href="{{ route('admin.dishes.create') }}">
                                        <i class="fa-solid fa-plus"></i> Agg. piatto
                                    </a>
                                </li>
                                {{-- /Add dish --}}

                                {{-- Show orders --}}
                                <li>
                                    <a class="nav-link text-white"
                                        {{ Route::currentRouteName() == 'dashboard' ? 'bg-secondary' : '' }}
                                        href="{{ route('admin.orders.index') }}">
                                        <i class="fa-solid fa-list-ul"></i> Ordini
                                    </a>
                                </li>
                                {{-- /Show orders --}}

                                {{-- Stats graph --}}
                                <li>
                                    <a class="nav-link text-white"
                                        {{ Route::currentRouteName() == 'dashboard' ? 'bg-secondary' : '' }}
                                        href="{{ route('admin.stats.index') }}">
                                        <i class="fa-solid fa-chart-line"></i> Statistische 
                                    </a>
                                </li>
                                {{-- /Stats graph --}}



                            @endif
                            {{-- hide and show link --}}


                            {{-- logout --}}
                            <li class="d-lg-none d-md-none d-sm-block">
                                <a class="nav-link  text-white" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                                document.getElementById('logout-form').submit();">
                                    <i class="fa-solid fa-left-long"></i>
                                    {{ __('Esci') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                            {{-- logout --}}

                        </ul>

                    </div>
                </nav>
                {{-- /sidebar --}}


                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    @yield('content')
                </main>
            </div>
        </div>

    </div>
</body>

</html>
