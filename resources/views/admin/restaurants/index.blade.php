@extends('layouts.admin')

@section('content')

    @include('partials.session_message')

    {{-- control list restaurant  --}}
    @if ($restaurant->isNotEmpty())
        {{-- error message --}}
        <div class="mt-5">
            @if (session('error'))
                <div class="alert alert-danger form-container border-0 text-center">
                    {{ session('error') }}
                </div>
            @endif
        </div>
        {{-- /error message --}}

        @foreach ($restaurant as $curRestaurant)
            {{-- container-btn --}}
            <div class="form-container border-0">
                <div class="row">

                    {{-- btn edit --}}
                    <div class=" col-sm-6 col-lg-3 py-2 flex-center justify-content-sm-end justify-content-lg-center ">
                        <a class="btn btn-primary flex-center gap-1"
                            href="{{ route('admin.restaurants.edit', ['restaurant' => $curRestaurant->slug]) }}">
                            <i class="fa-solid fa-pen"></i>
                            <span>
                                Mod. ristorante
                            </span>
                        </a>
                    </div>
                    {{-- /btn edit --}}

                    {{-- Btn orders --}}
                    <div class=" col-sm-6 col-lg-3 flex-center justify-content-sm-start justify-content-lg-center py-2">
                        <form action="{{ route('admin.orders.index') }}" method="GET">
                            @csrf
                            <input type="text" class="hide" name="restaurant_id" value="{{ $curRestaurant->id }}">
                            <button type="submit" class="btn btn-primary flex-center gap-1">
                                <i class="fa-solid fa-list-ul"></i>
                                <span>
                                    Visualizza ordini
                                </span>
                            </button>
                        </form>
                    </div>
                    {{-- /Btn orders --}}

                    {{-- btn add dish --}}
                    <div class=" col-sm-6  col-lg-3 flex-center justify-content-sm-end justify-content-lg-center py-2">
                        <form action="{{ route('admin.dishes.create') }}" method="GET" class="md_index-btn">
                            <input type="text" class="hide" name="restaurant_id" value="{{ $curRestaurant->id }}">
                            <button type="submit" class="btn btn-primary flex-center gap-1">
                                <i class="fa-solid fa-plus"></i>
                                <span>
                                    Aggiungi piatto
                                </span>
                            </button>
                        </form>

                    </div>
                    {{-- /btn add dish --}}

                    {{-- Show menu --}}
                    <div class="col col-sm-6 col-lg-3 flex-center justify-content-sm-start justify-content-lg-center py-2">
                        <form action="{{ route('admin.dishes.index') }}" method="GET" class="md_index-btn">
                            <input type="text" class="hide" name="restaurant_id" value="{{ $curRestaurant->id }}">
                            <button type="submit" class="btn btn-primary flex-center gap-1">
                                <i class="fa-solid fa-list"></i>
                                <span>
                                    Visualizza menu
                                </span>
                            </button>
                        </form>
                    </div>
                    {{-- /Show menu --}}


                </div>
            </div>
            {{-- /container-btn --}}


            {{-- container --}}
            <div class="form-container p-5 index-restaurant">

                {{-- header --}}
                <div class="mb-2">
                    <h1 class="text-center mb-4">Dettagli ristorante</h1>
                </div>
                {{-- /header --}}

                <div class="container">

                    {{-- container main --}}
                    <div class="row justify-content-center align-items-center">

                        {{-- restaurant-img --}}
                        <div class="col-sm-12 col-md-12 col-lg-6 text-center ">
                            <img class="img-fluid square-image" src="{{ asset('storage/' . $curRestaurant->image) }}"
                                alt="img-restaurant">
                        </div>
                        {{-- /restaurant-img --}}


                        {{-- restaurant text --}}
                        <div class="col-sm-12 col-md-12 col-lg-6 text-lg-start p-4 d-flex flex-column gap-2 align-items-center restaurants-details">

                            {{-- name --}}
                            <div>
                                <p class="p-0 m-0">
                                    <strong>Nome ristorante: </strong>
                                </p>
                                <span class="">{{ ucwords(strtolower($curRestaurant->name)) }}</span>
                            {{-- /name --}}

                            {{-- city --}}
                                <p class="p-0 m-0">
                                    <strong>Città: </strong>
                                </p>
                                <span class="">{{ $curRestaurant->city }}</span>
                            {{-- /city --}}

                            {{-- address --}}
                                <p class="p-0 m-0">
                                    <strong>Indirizzo: </strong>
                                </p>
                                <span class="">{{ ucwords(strtolower($curRestaurant->address)) }}</span>
                            {{-- /address --}}

                            {{-- types --}}
                                <p class="p-0 m-0">
                                    @if (count($curRestaurant->types) === 1)
                                        <strong>Tipologia: </strong>
                                    @else
                                        <strong>Tipologie: </strong>
                                    @endif
                                </p>
                                <ul>
                                    @foreach ($curRestaurant->types as $type)
                                        <li>
                                            <span class="">{{ $type->name }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            {{-- /types --}}


                        </div>
                        {{-- /restaurant text --}}



                        {{-- /container main --}}
                    </div>
                    {{-- container main --}}

                </div>



            </div>
            {{-- /container --}}
        @endforeach
        </div>
    @else
        <div class="form-container flex-center flex-column p-5">
            <p class="fs-3">Nessun ristorante registrato. Aggiungine uno.</p>
            <a class="btn btn-primary" href="{{ route('admin.restaurants.create') }}">
                <i class="fa-solid fa-plus"></i> Nuovo ristorante
            </a>
        </div>
    @endif

@endsection
