@extends('layouts.admin')

@section('content')
<div class="d-flex  flex-column align-items-center justify-content-center mt-5 gap-3 mb-4">
    <div class="d-flex gap-2">
        <a href="{{ route('admin.dishes.index') }}" class="btn btn-primary">
            <i class="fa-solid fa-circle-arrow-left"></i>
             Indietro
        </a>
        <a class="btn btn-primary" href="{{ route('admin.dishes.edit', ['dish' => $dish->slug]) }}">
            <i class="fa-solid fa-pen"></i> Modifica
        </a>
        {{-- btn home --}}
        <a class="btn btn-primary" href="{{ route('admin.restaurants.index') }}">
            <i class="fa-solid fa-circle-arrow-left"></i>
             Home
        </a>
        {{-- btn home --}}
    </div>
    <h1 class="text-center">Dettagli Piatto</h1>
</div>

    {{-- success message --}}
    @include('partials.session_message')
    {{-- /success message --}}

    {{-- container --}}
    <div class="form-container container p-5">
        <div class="row">

            {{-- img --}}
            <div class="col-lg-6">
                    <img src="{{ asset('storage/' . $dish->image) }}" alt="">
            </div>
            {{-- /img --}}


            {{-- details dish --}}
            <div class="col-lg-6 d-flex flex-column justify-content-center">
                <dt>
                    Nome del Piatto:
                </dt>
                <dd>
                    {{ ucfirst(strtolower($dish->name)) }}
                </dd>
                <dt>
                    Descrizione:
                </dt>
                <dd>
                    {{ ucfirst(strtolower($dish->description)) }}
                </dd>
                <dt>
                    Prezzo:
                </dt>
                <dd>
                    {{ $dish->price }} €
                </dd>

            </div>
            {{-- /details dish --}}

        </div>
    </div>
    {{-- /container --}}

@endsection
