@extends('layouts.app')
@section('content')

{{-- home page back --}}
<div class="jumbotron p-5 mb-4 bg-light rounded-3">
    <div class="container py-5">

        {{-- logo --}}
        <div class="logo_laravel_home">
            <img class="logoext" src="{{ asset('storage/img/logo_esteso.png') }}" class="w-100" alt="logo">
        </div>
        {{-- /logo --}}

        {{-- title --}}
        <h1 class="display-5 fw-bold">
           Benvenuto nel Back-Office di DeliveBoo
        </h1>
        {{-- /title --}}

        {{-- subtitle --}}
        <p class="col-md-8 fs-4">Qui potrai visualizzare il tuo ristorante, gestire il tuo menu e visualizzare i tuoi ordini</p>
        {{-- /subtitle --}}

        {{-- btn to access the dashboard if you are logged in otherwise the login page --}}
        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary btn-lg" type="button">Entra nella dashboard</a>
        {{-- /btn to access the dashboard if you are logged in otherwise the login page --}}

    </div>
</div>
{{-- /home page back --}}

@endsection
