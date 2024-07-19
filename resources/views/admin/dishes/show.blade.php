@extends('layouts.admin')

@section('content')
<div class="d-flex  flex-column align-items-center justify-content-center mt-5 gap-3">
    <h1 class="text-center">Dettagli Piatto</h1>
    <div>
        <a href="{{ route('admin.dishes.index') }}" class="btn btn-primary">Visualizza menu</a>
        <a class="btn btn-primary" href="{{ route('admin.dishes.edit', ['dish' => $dish->slug]) }}">
            <i class="fa-solid fa-pen"></i> Modifica
        </a>
    </div>
</div>
    {{-- success message --}}
    @if (session('message'))
        <div class="alert alert-success">
            <span class="info-info-success">{{ session('message') }}</span>
        </div>
    @endif
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
                    {{ $dish->price }} €
                </dd>

            </div>
            {{-- /details dish --}}

        </div>

    </div>
    {{-- /container --}}

@endsection
