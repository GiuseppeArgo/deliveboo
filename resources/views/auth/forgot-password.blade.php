@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Resetta Password') }}</div>

                {{-- body --}}
                <div class="card-body">

                    {{-- message --}}
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    {{-- /message --}}


                    {{-- form --}}
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        {{-- /email --}}
                        <div class="mb-4 row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Indirizzo e-Mail') }}</label>

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


                        {{-- btn submit --}}
                        <div class="mb-4 row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Invia link per resettare la password') }}
                                </button>
                            </div>
                        </div>
                        {{-- /btn submit --}}

                    </form>
                    {{-- /form --}}

                </div>
                {{-- /body --}}

            </div>
        </div>
    </div>
</div>
@endsection
