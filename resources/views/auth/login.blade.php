@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                {{-- form --}}
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        {{-- email --}}
                        <div class="mb-4 row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Inserisci e-mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                {{-- error --}}
                                @error('email')
                                <span class="invalid-feedback" role="alert">

                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                {{-- error --}}

                            </div>
                        </div>
                        {{-- /email --}}

                        {{-- password --}}
                        <div class="mb-4 row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                {{-- error --}}
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    {{-- messaggio errore password --}}
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                {{-- /error --}}
                            </div>
                        </div>
                        {{-- password --}}

                        {{-- checkbox remember me --}}
                        <div class="mb-4 row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Ricordati di me') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        {{-- /checkbox remember me --}}

                        {{-- btn submit and forget password --}}
                        <div class="mb-4 row mb-0">
                            <div class="col-md-8 offset-md-4">

                                {{-- btn --}}
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Accedi') }}
                                </button>
                                {{-- /btn --}}

                                {{-- forget --}}
                                @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('non ricordi la password?') }}
                                </a>
                                @endif
                                {{-- /forget --}}

                            </div>
                        </div>
                        {{-- /btn submit and forget password --}}


                    </form>
                </div>
                {{-- form --}}

            </div>
        </div>
    </div>
</div>
@endsection
