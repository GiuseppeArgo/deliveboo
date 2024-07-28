@extends('layouts.admin')

@section('content')
<div class="flex-center gap-3 mt-5 mb-4">
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

{{-- success message --}}
@include('partials.session_message')
{{-- /success message --}}

{{-- container --}}
<div class="form-container container p-5">
        <h1 class="text-center mb-4">Dettagli piatto</h1>
        <div class="row justify-content-center align-items-center">

            {{-- img --}}
            <div class="col-sm-12 col-md-12 col-lg-6 text-center">
                {{-- <div class="square-image-container border"> --}}
                    <img src="{{ asset('storage/' . $dish->image) }}" alt="" class="square-image-restaurant">
                {{-- </div> --}}
            </div>
            {{-- /img --}}


            {{-- details dish --}}
            <div class="col-sm-12 col-md-12 col-lg-6 text-lg-start p-4 d-flex flex-column gap-2 align-items-center justify-content-center restaurants-details">
                        <div>
                            <p class="p-0 m-0">
                                <strong>Nome del piatto: </strong>
                            </p>
                            <span>
                                {{ ucfirst(strtolower($dish->name)) }}
                            </span>
                            <p class="p-0 m-0">
                                <strong>Descrizione: </strong>
                            </p>
                            <span>
                                {{ ucfirst(strtolower($dish->description)) }}
                            </span>
                            <p class="p-0 m-0">
                                <strong>Prezzo: </strong>
                            </p>
                            <span>
                                {{ $dish->price }} €
                            </span>
                        </div>
            </div>
            {{-- /details dish --}}

        </div>
    </div>
    {{-- /container --}}

@endsection
