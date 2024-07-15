@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-center align-items-center mt-5 gap-2">
        <h3>Ristorante: {{ $restaurant->name }}</h3>
        <a class="btn btn-warning" href="{{ route('admin.restaurants.edit', ['restaurant' => $restaurant->slug]) }}">
            <i class="fa-solid fa-pen"></i>Modifica
        </a>
        {{-- ORDINI --}}
        <form action="{{ route('admin.orders.index') }}" method="GET">
            @csrf
            <input type="text" class="hide" name="restaurant_id" value="{{ $restaurant->id }}">
            <button type="submit" class="btn btn-info">
                <i class="fa-solid fa-pen"></i> Ordini
            </button>
        </form>
        {{-- ORDINI --}}
    </div>
    <div class="container">
        <div class="row flex-column align-items-center justify-content-center  text-center">
            <div class="col-6">
                <dt>Descrizione:</dt>
                <dd>{{ $restaurant->description }}</dd>
            </div>
            <div class="col-6">
                <img src="{{ asset('storage/' . $restaurant->image) }}" alt="img-restaurant">
            </div>
        </div>
    </div>
    <div class="form-container p-5 ">
        {{-- Aggiungi piatto --}}
        <form action="{{ route('admin.dishes.create') }}" method="GET">
            @csrf
            <input type="text" class="hide" name="restaurant_id" value="{{ $restaurant->id }}">
            <button type="submit" class="btn btn-success mb-4">
                <i class="fa-solid fa-pen"></i>Aggiungi Piatto
            </button>
        </form>

        {{-- Aggiungi piatto --}}

        @if (count($restaurant->dishes) > 0)
            <ul>
                @foreach ($restaurant->dishes as $dish)
                    <li class="border">
                        <ul>
                            <li>
                                <dt>
                                    Name:
                                </dt>
                                <dd>
                                    {{ $dish->name }}
                                </dd>
                            </li>
                            <li>
                                <dt>
                                    Descrizione:
                                </dt>
                                <dd>
                                    {{ $dish->description }}
                                </dd>
                            </li>
                            <li>
                                <dt>
                                    Prezzo:
                                </dt>
                                <dd>
                                    {{ $dish->price }}
                                </dd>
                            </li>
                        </ul>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="fs-2 mt-3">
                <strong>
                    Non ci sono piatti
                </strong>
            </p>
        @endif
    </div>
@endsection
