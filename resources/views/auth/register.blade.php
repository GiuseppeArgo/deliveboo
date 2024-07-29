@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Registrati') }}</div>

                {{-- form --}}
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        {{-- name --}}
                        <div class="mb-4 row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">
                                {{ __('Nome ') }} <span class="asterisco">*</span>
                            </label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" minlength="3" maxlength="20" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                {{-- error --}}
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                {{-- /error --}}

                            </div>
                        </div>
                        {{-- /name --}}

                        {{-- lastname --}}
                        <div class="mb-4 row">
                            <label for="lastname" class="col-md-4 col-form-label text-md-right">
                                {{ __('Cognome ') }} <span class="asterisco">*</span>
                            </label>

                            <div class="col-md-6">
                                <input  id="lastname" type="text" minlength="3" maxlength="20" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname" autofocus required>

                                {{-- error --}}
                                @error('lastname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                {{-- /error --}}

                            </div>
                        </div>
                        {{-- /lastname --}}


                        {{-- email --}}
                        <div class="mb-4 row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">
                                {{ __('E-mail ') }}<span class="asterisco">*</span>
                            </label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" required>

                                {{-- error --}}
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                {{-- /error --}}

                            </div>
                        </div>
                        {{-- /email --}}


                        {{-- password --}}
                        <div class="mb-4 row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">
                                {{ __('Password ') }} <span class="asterisco">*</span>
                            </label>

                            <div class="col-md-6">
                                <input id="password" type="password" minlength="8" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" required>

                                {{-- error --}}
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                {{-- /error --}}

                            </div>
                        </div>
                        {{-- /password --}}


                        {{-- password-confirm --}}
                        <div class="mb-4 row">
                            <label for="password_confirmation" class="col-md-4 col-form-label text-md-right">
                                {{ __('Conferma Password ') }} <span class="asterisco">*</span>
                            </label>

                            <div class="col-md-6">
                                <input id="password_confirmation" minlength="8" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        {{-- /password-confirm --}}


                        {{-- btn submit --}}
                        <div class="mb-4 row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary btn.register">
                                    {{ __('Registrati') }}
                                </button>
                            </div>
                        </div>
                        <div class="mt-5">
                            <span class="asterisco">*</span> ⁠questi campi sono obbligatori
                        </div>
                        {{-- btn submit --}}


                    </form>
                </div>
                {{-- /form --}}

            </div>
        </div>
    </div>
</div>

{{-- control password.length --}}
<script>
document.addEventListener("DOMContentLoaded", function() {
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('password_confirmation');

    function checkPasswordLength() {
        if (passwordInput.value.length !== confirmPasswordInput.value.length) {
            confirmPasswordInput.setCustomValidity("Le password devono avere la stessa lunghezza.");
        } else {
            confirmPasswordInput.setCustomValidity("");
        }
    }

    passwordInput.addEventListener('input', checkPasswordLength);
    confirmPasswordInput.addEventListener('input', checkPasswordLength);

    // Verifica iniziale quando la pagina viene caricata
    checkPasswordLength();
});
</script>
{{-- control password.length --}}

@endsection
