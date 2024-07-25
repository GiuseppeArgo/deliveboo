
{{--  abbiamo scelto di non usare questa pagina show di restaurant --}}



@extends('layouts.admin')

@section('content')

    {{-- restaurant details --}}
    <div class="form-container p-2">

        {{-- header --}}
        <div class="d-flex justify-content-center align-items-center gap-2">

            {{-- title --}}
            <h1>Ristorante: {{ $restaurant->name }}</h1>

            {{-- btn edit --}}
            <a class="btn btn-success" href="{{ route('admin.restaurants.edit', ['restaurant' => $restaurant->slug]) }}">
                <i class="fa-solid fa-pen"></i>
            </a>
            {{-- /btn edit --}}


            {{-- Btn orders --}}
            <form action="{{ route('admin.orders.index') }}" method="GET">
                @csrf
                <input type="text" class="hide" name="restaurant_id" value="{{ $restaurant->id }}">
                <button type="submit" class="btn btn-secondary">
                    <i class="fa-solid fa-list-ul"></i> Ordini
                </button>
            </form>
            {{-- /Btn orders --}}

        </div>
        {{-- /header --}}


        <div class="mt-3 mb-3">
            <div class="row align-items-center justify-content-center  text-center">
                <div class="col-6 mt-3 restaurant-text">
                    <h3>Descrizione:</h3>
                    <dd>{{ $restaurant->description }}</dd>
                </div>
                <div class="col-6 restaurant-img">
                    <img src="{{ asset('storage/' . $restaurant->image) }}" alt="img-restaurant">
                </div>
            </div>

        </div>
    </div>
    {{-- /restaurant details --}}


    {{-- menu restaurant  --}}
    <div class="form-container p-5 ">

        {{-- menu btn --}}
        <div class="d-flex gap-2">

            {{-- btn add dish --}}
            <form action="{{ route('admin.dishes.create') }}" method="GET">
                <input type="text" class="hide" name="restaurant_id" value="{{ $restaurant->id }}">
                <button type="submit" class="btn btn-primary mb-4">
                    <i class="fa-solid fa-plus"></i> Piatto
                </button>
            </form>
            {{-- /btn add dish --}}

            {{-- btn edit visibility --}}
            <form action="{{ route('admin.dishes.index') }}" method="GET">
                <input type="text" class="hide" name="restaurant_id" value="{{ $restaurant->id }}">
                <button type="submit" class="btn btn-success mb-4">
                    <i class="fa-solid fa-pen"></i> Visibilità
                </button>
            </form>
            {{-- /btn edit visibility --}}

        </div>
        {{-- /menu btn --}}

        {{-- menu dish --}}
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
        {{-- /menu dish --}}

    </div>
    {{-- /menu restaurant  --}}

@endsection
