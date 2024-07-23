@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-4">
                {{-- success message --}}
                @if (session('message'))
                    <div class="alert alert-success form-container text-center border-0">
                        {{ session('message') }}
                    </div>
                @endif
                {{-- /success message --}}

                {{-- card-container --}}
                <div class="card mt-5">
                    {{-- title --}}
                    <div class="card-header alert alert-primary p-2 m-0 d-flex justify-content-center align-items-center gap-2">
                        <span>{{ __('Deliveboo Dashboard') }}</span>
                        <a href="{{ route('admin.restaurants.index') }}" class="btn btn-primary">
                            Pagina Ristorante
                        </a>
                    </div>
                    {{-- /title --}}

                    {{-- user details --}}
                    <div class="card-body">
                        @if (session('status'))
                            <div class="" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div>
                            <p class="fs-3">
                                Riepilogo dei tuoi dati:
                            </p>
                            <dt>
                                Nome utente:
                            </dt>
                            <dd>
                                {{ $user->name }}
                            </dd>
                            <dt>
                                Cognome utente:
                            </dt>
                            <dd>
                                {{ $user->lastname }}
                            </dd>
                            <dt>
                                Email:
                            </dt>
                            <dd>
                                {{ $user->email }}
                            </dd>
                            <dt>
                                Data creazione account:
                            </dt>
                            <dd>
                                {{ 'In data: ' .
                                    \Carbon\Carbon::parse($user->created_at)->format('d/m/Y') .
                                    ', alle ore: ' .
                                    \Carbon\Carbon::parse($user->created_at)->format('H:i') }}
                            </dd>
                        </div>
                    </div>
                    {{-- user details --}}

                </div>
                {{-- /card- container --}}

            </div>
        </div>
    </div>
@endsection
