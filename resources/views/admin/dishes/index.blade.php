@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            {{-- header --}}
            <div class="d-flex gap-2 justify-content-center align-items-center mt-5">
                <div class="d-flex flex-column justify-content-center align-items-center gap-2 mb-2">
                    <h1 class="text-center p-0">Menu del ristorante<br>( {{ count($dishesList) }} Piatti )</h1>

                    {{-- btn --}}

                    <div class="d-flex gap-2">
                        {{-- btn home --}}
                        <a class="btn btn-primary" href="{{ route('admin.restaurants.index') }}">
                            <i class="fa-solid fa-circle-arrow-left"></i>
                            home
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

                </div>
            </div>
            {{-- /header --}}


            @if (count($dishesList) > 0)
                {{-- table --}}
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">

                        {{-- thead --}}
                        <thead>
                            <tr>
                                <th scope="col">Nome</th>
                                <th scope="col">Prezzo</th>
                                <th scope="col">Status</th>
                                <th scope="col">Status on/off</th>
                                <th scope="col">Dettagli</th>
                                <th scope="col">Modifica</th>
                            </tr>
                        </thead>
                        {{-- /thead --}}


                        {{-- tbody --}}
                        <tbody>
                            @foreach ($dishesList as $dish)
                                <tr>
                                    {{-- name --}}
                                    <td class="align-middle">{{ $dish->name }}</td>

                                    {{-- price --}}
                                    <td class="align-middle">{{ $dish->price }} €</td>


                                    {{-- statuts --}}
                                    <td class="align-middle">
                                        <div>
                                            <span>
                                                {{ $dish->visibility == 1 ? 'Disponibile' : 'Non disponibile' }}
                                            </span>
                                        </div>
                                    </td>
                                    {{-- /status --}}


                                    {{-- change status --}}
                                    <td>
                                        <form action="{{ route('admin.dishes.toggle', ['id' => $dish->id]) }}"
                                            method="POST" class="d-flex gap-1 justify-content-center">
                                            @csrf
                                            @method('PUT')
                                            <input type="text" class="hide" name="restaurant_id"
                                                value="{{ $restaurant_id }}">
                                            <input type="text" class="hide" name="visibility"
                                                value="{{ $dish->visibility }}">
                                            <button type="submit" class="btn btn-outline-primary">
                                                <i class="fa-solid fa-rotate"></i>
                                            </button>
                                        </form>
                                    </td>
                                    {{-- change status --}}


                                    {{-- button --}}
                                    <td class="d-flex gap-1 justify-content-center">
                                        <a class="btn btn-outline-primary"
                                            href="{{ route('admin.dishes.show', ['dish' => $dish->slug]) }}">
                                            <i class="fa-solid fa-eye"></i>
                                            <span class="d-none d-sm-none d-md-none d-lg-block">
                                                Dettagli
                                            </span>
                                        </a>
                                    </td>
                                    <td>
                                        <a class="btn btn-outline-primary"
                                            href="{{ route('admin.dishes.edit', ['dish' => $dish->slug]) }}">
                                            <i class="fa-solid fa-pen"></i>
                                            <span class="d-none d-sm-none d-md-none d-lg-block">
                                                Modifica
                                            </span>
                                        </a>
                                    </td>
                                    {{-- /button --}}

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
