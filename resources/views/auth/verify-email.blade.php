@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verifica il tuo indirizzo e-Mail') }}</div>

                {{-- body --}}
                <div class="card-body">

                    {{-- message verify --}}
                    @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('Ti è stato mandato un link di verifica al tuo indirizzo e-Mail.') }}
                    </div>
                    @endif
                    {{-- /message verify --}}

                    {{-- resend notification --}}
                    {{ __('Prima di procedere, controlla la tua e-Mail per un link di verifica.') }}
                    {{ __('Se non hai ricevuto un e-Mail') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('Clicca qui per richiederne un altra') }}</button>.
                    </form>
                    {{-- /resend notification --}}

                </div>
                {{-- /body --}}

            </div>
        </div>
    </div>
</div>
@endsection
