@extends('layouts.admin')

@section('content')
<div class="d-flex align-items-center justify-content-center mt-5 gap-3">
    <h1 class="text-center">Dettagli Piatto</h1>
    <a class="text-black btn btn-success" href="{{ route('admin.dishes.edit', ['dish' => $dish->slug]) }}">
        <i class="fa-solid fa-pen"></i>
    </a>
</div>
    {{-- success message --}}
    @if (session('message'))
        <div class="alert alert-success">
            <span class="info-info-success">{{ session('message') }}</span>
        </div>
    @endif
    {{-- /success message --}}

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



    </div>
@endsection
