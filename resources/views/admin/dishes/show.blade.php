@extends('layouts.admin')

@section('content')
    <h1 class="text-center mt-5">Dettagli Piatto</h1>
    <div class="form-container p-5">
        <dt>
            Nome del Piatto:
        </dt>
        <dd>
            {{ $dish->name }}
        </dd>
        <dt>
            Descrizione:
        </dt>
        <dd>
            {{ $dish->description }}
        </dd>
        <dt>
            Prezzo:
        </dt>
        <dd>
            {{ $dish->price }}
        </dd>
        <dt>
            Image:
        </dt>
        <dd>
            <img src="{{ asset('storage/' . $dish->image) }}" alt="">
        </dd>

        <a class="text-black btn btn-warning" href="{{ route('admin.dishes.edit', ['dish' => $dish->slug]) }}">
            <i class="fa-solid fa-pen"></i>
        </a>

    </div>
@endsection