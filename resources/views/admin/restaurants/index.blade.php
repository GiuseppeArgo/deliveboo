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
            <div class="form-container border border-white">
                <div class="row">
                    
                    {{-- btn edit --}}
                    <div class=" col-sm-6 col-lg-3 py-2 d-flex justify-content-center justify-content-sm-end justify-content-lg-center ">
                        <form action="" class="d-flex justify-content-center">
                            <a class="btn btn-primary d-flex justify-content-center align-items-center gap-1"
                                href="{{ route('admin.restaurants.edit', ['restaurant' => $curRestaurant->slug]) }}">
                                <i class="fa-solid fa-pen"></i>
                                <span>
                                    Mod. Ristorante
                                </span>
                            </a>
                        </form>
                    </div>
                    {{-- /btn edit --}}

                    {{-- Btn orders --}}
                    <div class=" col-sm-6 col-lg-3 d-flex justify-content-center  justify-content-sm-start justify-content-lg-center py-2">
                        <form action="{{ route('admin.orders.index') }}" method="GET">
                            @csrf
                            <input type="text" class="hide" name="restaurant_id" value="{{ $curRestaurant->id }}">
                            <button type="submit"
                                class="btn btn-primary d-flex justify-content-center align-items-center gap-1">
                                <i class="fa-solid fa-list-ul"></i>
                                <span>
                                    Visualizza Ordini
                                </span>
                            </button>
                        </form>
                    </div>
                    {{-- /Btn orders --}}

                    {{-- btn add dish --}}
                    <div class=" col-sm-6  col-lg-3 d-flex justify-content-center  justify-content-sm-end justify-content-lg-center py-2">
                        <form action="{{ route('admin.dishes.create') }}" method="GET" class="md_index-btn">
                            <input type="text" class="hide" name="restaurant_id" value="{{ $curRestaurant->id }}">
                            <button type="submit"
                                class="btn btn-primary d-flex justify-content-center align-items-center gap-1">
                                <i class="fa-solid fa-plus"></i>
                                <span>
                                    Aggiungi Piatto
                                </span>
                            </button>
                        </form>
                        
                    </div>
                    {{-- /btn add dish --}}

                    {{-- Show menu --}}
                    <div class="col col-sm-6 col-lg-3 d-flex justify-content-center justify-content-sm-start justify-content-lg-center py-2">
                        <form action="{{ route('admin.dishes.index') }}" method="GET" class="md_index-btn">
                            <input type="text" class="hide" name="restaurant_id" value="{{ $curRestaurant->id }}">
                            <button type="submit"
                                class="btn btn-primary d-flex justify-content-center align-items-center gap-1">
                                <i class="fa-solid fa-list"></i>
                                <span>
                                    Visualizza Menu
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

                <h1 class="text-center mb-4">Dettagli ristorante</h1>
                {{-- header --}}
                <div class="container d-flex flex-wrap align-itenms-center justify-content-center gap-2 mb-2">



                </div>
                {{-- /header --}}


                {{-- container main --}}
                <div class="row justify content-center align-items-center">

                    {{-- restaurant-img --}}
                    <div class="col-lg-6 col-md-12">
                        <img class="img-fluid" src="{{ asset('storage/' . $curRestaurant->image) }}" alt="img-restaurant">
                    </div>
                    {{-- /restaurant-img --}}


                    {{-- restaurant text --}}
                    <div class="col-lg-6 col-md-8 mb-3 text-lg-start ">

                        {{-- name --}}
                        <div class="p-0 m-0">
                            <span>
                                <strong>Nome Ristorante: </strong>
                            </span>
                            <span class=" mt-5 mb-5">{{ $curRestaurant->name }}</span>
                        </div>
                        {{-- /name --}}

                        {{-- city --}}
                        <div class="p-0 m-0">
                            <span>
                                <strong>Città: </strong>
                            </span>
                            <span class=" mt-5 mb-5">{{ $curRestaurant->city }}</span>
                        </div>
                        {{-- /city --}}

                        {{-- address --}}
                        <div class="p-0 m-0">
                            <span>
                                <strong>Indirizzo: </strong>
                            </span>
                            <span class=" mt-5 mb-5">{{ $curRestaurant->address }}</span>
                        </div>
                        {{-- /address --}}

                        {{-- types --}}
                        <div class="p-0 m-0">
                            <span>
                                @if (count($curRestaurant->types) === 1)
                                    <strong>Tipologia: </strong>
                                @else
                                    <strong>Tipologie: </strong>
                                @endif
                            </span>
                            <ul>
                                @foreach ($curRestaurant->types as $type)
                                    <li>
                                        <span class=" mt-5 mb-5">{{ $type->name }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        {{-- /types --}}


                    </div>
                    {{-- /restaurant text --}}


                </div>
                {{-- /container main --}}


            </div>
            {{-- /container --}}
        @endforeach
        </div>
    @else
        <div class="form-container d-flex justify-content-center align-items-center p-5 gap-5">
            <p class="fs-3">Nessun ristorante aggiunto. Aggiungine uno</p>
            <a class="btn btn-primary" href="{{ route('admin.restaurants.create') }}">
                <i class="fa-solid fa-plus"></i> Nuovo ristorante
            </a>
        </div>
    @endif

@endsection
