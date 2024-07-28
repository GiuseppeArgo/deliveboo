@extends('layouts.admin')

@section('content')
    {{-- btn --}}
    <div class="flex-center mt-5 gap-2">
        {{-- btn home --}}
        <a class="btn btn-primary" href="{{ route('admin.restaurants.index') }}">
            <i class="fa-solid fa-circle-arrow-left"></i>
            Indietro
        </a>
        {{-- btn home --}}

        {{-- Aggiungi piatto --}}
        <form action="{{ route('admin.dishes.create') }}" method="GET">
            <input type="text" class="hide" name="restaurant_id" value="{{ $restaurant_id }}">
            <button type="submit" class="btn btn-primary">
                <i class="fa-solid fa-plus"></i> Piatto
            </button>
        </form>
        {{-- /Aggiungi piatto --}}
    </div>
    {{-- /btn --}}

    <div class="container-fluid">
        <div class="row justify-content-center">
            {{-- header --}}
            <div class="flex-center gap-2 mt-5">
                <div class="flex-center flex-column gap-2 mb-2">
                    <h1 class="text-center p-0">Menu del ristorante<br>( {{ count($dishesList) }} Piatti )</h1>



                </div>
            </div>
            {{-- /header --}}


            @if (count($dishesList) > 0)
                {{-- table --}}
                <div class="table-responsive text-center">
                    <table class="table table-bordered">

                        {{-- thead --}}
                        <thead>
                            <tr>
                                <th scope="col">Nome</th>
                                <th scope="col">Prezzo</th>
                                <th scope="col">Status</th>
                                <th scope="col">Azioni</th>
                                {{-- <th scope="col">Dettagli</th>
                                <th scope="col">Modifica</th> --}}
                            </tr>
                        </thead>
                        {{-- /thead --}}


                        {{-- tbody --}}
                        <tbody>
                            @foreach ($dishesList as $dish)
                                <tr>
                                    {{-- name --}}
                                    <td class="align-middle">{{ ucfirst(strtolower($dish->name)) }}</td>

                                    {{-- price --}}
                                    <td class="align-middle">{{ $dish->price }} €</td>


                                    {{-- statuts --}}
                                    <td class="align-middle d-cell d-md-flex justify-content-center align-items-center gap-2">
                                            <span>
                                                {{ $dish->visibility == 1 ? 'Disponibile' : 'Non disponibile' }}
                                            </span>
                                            {{-- change status --}}
                                            <div class="">
                                                <form action="{{ route('admin.dishes.toggle', ['id' => $dish->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="text" class="hide" name="restaurant_id"
                                                        value="{{ $restaurant_id }}">
                                                    <input type="text" class="hide" name="visibility"
                                                        value="{{ $dish->visibility }}">
                                                    <button type="submit" class="btn btn-outline-primary d-none d-md-inline-block">
                                                        <i class="fa-solid fa-rotate"></i>
                                                    </button>
                                                </form>
                                            </div>
                                            {{-- change status --}}

                                    </td>
                                    {{-- /status --}}

                                    <td class="">
                                        <a class="btn btn-outline-primary p-1"
                                            href="{{ route('admin.dishes.show', ['dish' => $dish->slug]) }}">
                                            <span class="d-none d-sm-none d-md-block d-lg-block">
                                                Dettagli
                                            </span>
                                            <i class="fa solid fa-eye d-iline-block d-sm-inline-block d-md-none d-lg-none"></i>
                                        </a>
                                        <a class="btn btn-outline-primary p-1"
                                            href="{{ route('admin.dishes.edit', ['dish' => $dish->slug]) }}">
                                            <span class="d-none d-sm-none d-md-block d-lg-block">
                                                Modifica
                                            </span>
                                            <i class="fa-solid fa-pen d-iline-block d-sm-inline-block d-md-none d-lg-none"></i>
                                        </a>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                        {{-- /tbody --}}

                    </table>
                </div>
                {{-- /table --}}
            @else
                <div class="form-container p-5 text-center">
                    <p class="fs-3"> Non ci sono ancora piatti nel tuo menu</p>
                </div>
            @endif
        </div>
    </div>
@endsection
