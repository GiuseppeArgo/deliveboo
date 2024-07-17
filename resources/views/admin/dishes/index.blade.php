@extends('layouts.admin')

@section('content')
    {{-- header --}}
    <div class="d-flex gap-2 justify-content-center align-items-center mt-5">
        <div class="d-flex flex-column justify-content-center align-items-center gap-2 mb-2">
            <h1 class="text-center p-0">Piatti Del menu ( {{ count($dishesList) }} )</h1>

            {{-- btn --}}
            <div class="d-flex gap-2">
                {{-- btn home --}}
                <a class="btn btn-primary" href="{{ route('admin.restaurants.index') }}">
                    <i class="fa-solid fa-user"></i> Home
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

    {{-- table --}}
    <div class="container m-auto p-5">
        <table class="table table-striped table-responsive text-center">

            {{-- thead --}}
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Prezzo</th>
                    <th scope="col">Att/Disat</th>
                    <th scope="col">Azioni</th>
                </tr>
            </thead>
            {{-- /thead --}}

            {{-- tbody --}}
            <tbody>
                @foreach ($dishesList as $dish)
                    <tr>
                        <td class="align-middle">{{ $dish->name }}</td>
                        <td class="align-middle">{{ $dish->price }} €</td>

                        {{-- change visibility --}}
                        <td>
                            <div class="text-center d-flex gap-2 justify-content-center align-items-center">
                                <span>
                                    {{ $dish->visibility == 1 ? 'Visibile' : 'Non visibile' }}
                                </span>
                                <form action="{{ route('admin.dishes.toggle', ['id' => $dish->id]) }}" method="POST"
                                    class="d-flex gap-1 justify-content-center">
                                    @csrf
                                    @method('PUT')
                                    <input type="text" class="hide" name="restaurant_id" value="{{$restaurant_id}}">
                                    <input type="text" class="hide" name="visibility" value="{{$dish->visibility}}">
                                    <button type="submit" class="btn btn-outline-danger">
                                        <i class="fa-solid fa-rotate"></i>
                                    </button>
                                </form>
                            </div>

                            {{-- <form action="{{ route('admin.dishes.toggle', ['id' => $dish->id]) }}" method="POST"
                                class="d-flex gap-1 justify-content-center">
                                @csrf
                                @method('PUT')
                                <select name="visibility" id="visibility" class="form-control w-50">

                                    <option @selected($dish->visibility === 1) value="1">
                                        Attivo
                                    </option>
                                    <option @selected($dish->visibility === 0) value="0">
                                        Non Attivo
                                    </option>
                                </select>
                                <input type="text" class="hide" name="restaurant_id" value="1">
                                <button type="submit" class="btn btn-outline-danger">
                                    <i class="fa-solid fa-rotate"></i>
                                </button>
                            </form> --}}
                        </td>
                        {{-- /change visibility --}}


                        {{-- button --}}
                        <td class="d-flex gap-1 justify-content-center">
                            <a class="btn btn-primary"
                                href="{{ route('admin.dishes.show', ['dish' => $dish->slug]) }}">
                                <i class="fa-solid fa-eye"></i> Dettagli
                            </a>
                            <a class="btn btn-primary"
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
@endsection
