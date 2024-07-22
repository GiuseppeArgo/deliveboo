@extends('layouts.app')

@section('content')

{{-- container --}}
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">

            {{-- body --}}
            <div class="card">
                <div class="card-header">{{ __('Conferma Password') }}</div>

                <div class="card-body">
                    {{ __('Perfavore conferma la password prima di continuare.') }}

                    {{-- form --}}
                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        {{-- password --}}
                        <div class="mb-4 row">

                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                {{-- error --}}
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                {{-- error --}}

                            </div>

                        </div>
                        {{-- /password --}}

                        {{-- password confirm --}}
                        <div class="mb-4 row mb-0">
                            <div class="col-md-8 offset-md-4">

                                {{-- btn-confirm --}}
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Conferma password') }}
                                </button>
                                {{-- /btn-confirm --}}

                                {{-- btn-forget --}}
                                @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Non ricordi la password?') }}
                                </a>
                                @endif
                                {{-- btn-forget --}}

                            </div>
                        </div>
                        {{-- /password confirm --}}

                    </form>
                    {{-- /form --}}

                </div>
            </div>
            {{-- body --}}

        </div>
    </div>
</div>
{{-- container --}}

@endsection
