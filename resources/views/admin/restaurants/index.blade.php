@extends('layouts.admin')

@section('content')

    @if ($restaurant->isNotEmpty())

    <div class="mt-5">
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    </div>
        @foreach ($restaurant as $curRestaurant)
            <div class="form-container p-5">
                <div class="container d-flex align-itenms-center justify-content-center gap-2 mb-2">
                    {{-- btn edit --}}
                    <div>
                        <a class="btn btn-primary"
                            href="{{ route('admin.restaurants.edit', ['restaurant' => $curRestaurant->slug]) }}">
                            <i class="fa-solid fa-pen"></i> Mod. Ristorante
                        </a>
                    </div>

                    {{-- Btn orders --}}
                    <form action="{{ route('admin.orders.index') }}" method="GET">
                        @csrf
                        <input type="text" class="hide" name="restaurant_id" value="{{ $curRestaurant->id }}">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-list-ul"></i> Visualizza Ordini
                        </button>
                    </form>
                    {{-- /Btn orders --}}

                    {{-- btn Aggiungi piatto --}}
                    <form action="{{ route('admin.dishes.create') }}" method="GET">
                        <input type="text" class="hide" name="restaurant_id" value="{{ $curRestaurant->id }}">
                        <button type="submit" class="btn btn-primary mb-4">
                            <i class="fa-solid fa-plus"></i> Aggiungi Piatto
                        </button>
                    </form>
                    {{-- /btn Aggiungi piatto --}}

                    {{-- Visualizza menu --}}
                    <form action="{{ route('admin.dishes.index') }}" method="GET">
                        <input type="text" class="hide" name="restaurant_id" value="{{ $curRestaurant->id }}">
                        <button type="submit" class="btn btn-primary mb-4">
                            <i class="fa-solid fa-list"></i> Visualizza Menu
                        </button>
                    </form>
                    {{-- /Visualizza menu --}}

                </div>
                <div class="row justify content-center align-items-center">
                    {{-- restaurant-img --}}
                    <div class="col-lg-6 col-md-12">
                        <img class="img-fluid" src="{{ asset('storage/' . $curRestaurant->image) }}" alt="img-restaurant">
                    </div>
                    {{-- /restaurant-img --}}

                    {{-- restaurant text --}}
                    <div class="col-lg-6 col-md-8 mb-3 text-lg-start ">

                        <div class="p-0 m-0">
                            <span>
                                <strong>Nome Ristorante: </strong>
                            </span>
                            <span class=" mt-5 mb-5">{{ $curRestaurant->name }}</span>
                        </div>
                        <div class="p-0 m-0">
                            <span>
                                <strong>Città: </strong>
                            </span>
                            <span class=" mt-5 mb-5">{{ $curRestaurant->city }}</span>
                        </div>
                        <div class="p-0 m-0">
                            <span>
                                <strong>Indirizzo: </strong>
                            </span>
                            <span class=" mt-5 mb-5">{{ $curRestaurant->address }}</span>
                        </div>
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


            </div>
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
{{-- <a href="{{ route('admin.restaurants.show', ['restaurant' => $restaurant->slug]) }}" class="btn btn-info">
                        <i class="fa-solid fa-eye"></i>
                    </a>
                    <a href="{{ route('admin.restaurants.edit', ['restaurant' => $restaurant->slug]) }}"
                        class="btn btn-success">
                        <i class="fa-solid fa-pen"></i>
                    </a> --}}
