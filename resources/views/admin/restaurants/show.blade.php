@extends('layouts.app')

@section('content')
    <h3 class="text-center mt-5">Ristorante: {{ $restaurant->name }}</h3>
    <div class="form-container p-5">

        <p>{{ $restaurant->description }}</p>
        <table class="table table-striped text-center">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Prezzo</th>
                    <th scope="col">Bottoni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($restaurant->dishes as $dish)
                    <tr>
                        <td>{{ $dish->name }}</td>
                        <td>{{ $dish->price }}</td>
                        <td>
                            <a class="text-black btn btn-info"
                                href="{{ route('admin.dishes.show', ['dish' => $dish->slug]) }}">
                                <i class="fa-solid fa-eye">Dettagli</i>
                            </a>
                            <a class="text-black btn btn-warning"
                                href="{{ route('admin.dishes.edit', ['dish' => $dish->slug]) }}">
                                <i class="fa-solid fa-pen">Modifica</i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
