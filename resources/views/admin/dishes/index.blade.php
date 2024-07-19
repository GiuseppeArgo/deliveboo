@extends('layouts.admin')

@section('content')
    {{-- header --}}
    <div class="d-flex gap-2 justify-content-center align-items-center mt-5">
        <div class="d-flex flex-column justify-content-center align-items-center gap-2 mb-2">
            <h1 class="text-center p-0">Menu del ristorante ( {{ count($dishesList) }} Piatti )</h1>

            {{-- btn --}}
            <div class="d-flex gap-2">
                {{-- btn home --}}
                <a class="btn btn-primary" href="{{ route('admin.restaurants.index') }}">
                    <i class="fa-solid fa-circle-arrow-left"></i>
                    Torna alla home
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
        <div class="container w-75 m-auto">
            <table class="table table-striped table-responsive text-center">

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
                            <td class="align-middle">{{ $dish->name }}</td>
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
                                <form action="{{ route('admin.dishes.toggle', ['id' => $dish->id]) }}" method="POST"
                                    class="d-flex gap-1 justify-content-center">
                                    @csrf
                                    @method('PUT')
                                    <input type="text" class="hide" name="restaurant_id" value="{{ $restaurant_id }}">
                                    <input type="text" class="hide" name="visibility" value="{{ $dish->visibility }}">
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
                                    <i class="fa-solid fa-eye"></i> Dettagli
                                </a>
                            </td>
                            <td>
                                <a class="btn btn-outline-primary"
                                    href="{{ route('admin.dishes.edit', ['dish' => $dish->slug]) }}">
                                    <i class="fa-solid fa-pen"></i> Modifica
                                </a>
                            </td>
                            {{-- /button --}}

                        </tr>
                    @endforeach
                </tbody>
                {{-- /tbody --}}

            </table>
            {{-- /table --}}

        </div>
    @else
        <div class="form-container p-5 text-center">
            <p class="fs-3"> Non ci sono ancora piatti nel tuo menu</p>
        </div>
    @endif
@endsection
