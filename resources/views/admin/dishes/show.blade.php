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
<h1 class="text-center">Dettagli Piatto</h1>

    {{-- success message --}}
    @include('partials.session_message')
    {{-- /success message --}}

    {{-- container --}}
    <div class="form-container container p-5">
        <div class="row justify-content-center align-items-center ">

            {{-- img --}}
            <div class="col-lg-6 col-md-6 col-sm-12 square-image-container">
                {{-- <div class="square-image-container border"> --}}
                    <img src="{{ asset('storage/' . $dish->image) }}" alt="" class="square-image">
                {{-- </div> --}}
            </div>
            {{-- /img --}}


            {{-- details dish --}}
            <div class="col-lg-6 col-md-6 col-sm-12 square-text-container d-flex flex-column justify-content-lg-center mt-3">
                {{-- <div class="container"> --}}
                    {{-- <div class="row align-items-center justify-content-center"> --}}
                        <span>
                            <strong>
                                Nome del Piatto:
                            </strong>
                        </span>
                        <span>
                            {{ ucfirst(strtolower($dish->name)) }}
                        </span>
                        <span>
                            <strong>
                                Descrizione:
                            </strong>
                        </span>
                        <span>
                            {{ ucfirst(strtolower($dish->description)) }}
                        </span>
                        <span>
                            <strong>
                                Prezzo:
                            </strong>
                        </span>
                        <span>
                            {{ $dish->price }} €
                        </span>
                    {{-- </div> --}}

                {{-- </div> --}}

            </div>
            {{-- /details dish --}}

        </div>
    </div>
    {{-- /container --}}

@endsection
