@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-4">
                <div class="card ">
                    <div class="card-header alert alert-primary p-2 m-0">{{ __('Deliveboo Dashboard') }}</div>


                    <div class="card-body">
                        @if (session('status'))
                            <div class="" role="alert">
                                {{ session('status') }}
                            </div>
                            @endif

                            {{ __('Bentornato') }} {{$user->name}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
