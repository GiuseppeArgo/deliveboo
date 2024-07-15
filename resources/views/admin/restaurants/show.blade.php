@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-center align-items-center mt-5 gap-2">
        <h1>Ristorante: {{ $restaurant->name }}</h1>
        <a class="btn btn-success" href="{{ route('admin.restaurants.edit', ['restaurant' => $restaurant->slug]) }}">
            <i class="fa-solid fa-pen"></i>
        </a>
        {{-- ORDINI --}}
        <form action="{{ route('admin.orders.index') }}" method="GET">
            @csrf
            <input type="text" class="hide" name="restaurant_id" value="{{ $restaurant->id }}">
            <button type="submit" class="btn btn-secondary">
                <i class="fa-solid fa-list-ul"></i> Ordini
            </button>
        </form>
        {{-- ORDINI --}}
    </div>
    <div class="container">
        <div class="row flex-column align-items-center justify-content-center  text-center">
            <div class="col-6 mt-3">
                <h3>Descrizione:</h3>
                <dd>{{ $restaurant->description }}</dd>
            </div>
            <div class="col-6">
                <img src="{{ asset('storage/' . $restaurant->image) }}" alt="img-restaurant">
            </div>
        </div>
    </div>
    <div class="form-container p-5 ">
        <div class="d-flex gap-2">
            {{-- Aggiungi piatto --}}
            <form action="{{ route('admin.dishes.create') }}" method="GET">
                <input type="text" class="hide" name="restaurant_id" value="{{ $restaurant->id }}">
                <button type="submit" class="btn btn-primary mb-4">
                    <i class="fa-solid fa-plus"></i> Piatto
                </button>
            </form>
            {{-- Aggiungi piatto --}}

            {{-- modifica visibilità --}}
            <form action="{{ route('admin.dishes.index')}}" method="GET">
                <input type="text" class="hide" name="restaurant_id" value="{{ $restaurant->id }}">
                <button type="submit" class="btn btn-success mb-4">
                    <i class="fa-solid fa-pen"></i> Visibilità
                </button>
            </form>
            {{-- modifica visibilità --}}
        </div>

        @if (count($restaurant->dishes) > 0)
            <table class="table table-responsive">
                <thead>
                    <th scope="col">Nome</th>
                    <th scope="col">Prezzo</th>
                </thead>
                @foreach ($restaurant->dishes as $dish)
                <tbody>
                    <td>
                        {{ $dish->name }}
                    </td>
                    <td>
                        {{ $dish->price }} €
                    </td>
                </tbody>
                    @endforeach
            </table>
        @else
            <p class="fs-2 mt-3">
                <strong>
                    Non ci sono piatti
                </strong>
            </p>
        @endif
    </div>
@endsection
