@extends('layouts.admin')

@section('content')
    <h1 class="text-center mt-5 mb-5">Lista dei Ristoranti</h1>

    <div class="form-container p-5">
        @if (count($restaurants) >0)
        table
        <table class="table w-75 m-auto text-center">

            {{-- thead --}}
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Città</th>
                    <th>Indirizzo</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            {{-- /thead --}}

            {{-- tbody --}}
            <tbody>
                @foreach ($restaurants as $restaurant)
                    <tr>
                        <td class="align-middle">{{ $restaurant->name }}</td>
                        <td class="align-middle">{{ $restaurant->city }}</td>
                        <td class="align-middle">{{ $restaurant->address }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.restaurants.show', ['restaurant' => $restaurant->slug]) }}"
                                class="btn btn-info">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.restaurants.edit', ['restaurant' => $restaurant->slug]) }}"
                                class="btn btn-success">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                        </td>

                    </tr>
                @endforeach
            </tbody>
            {{-- /tbody --}}

        </table>
        {{-- /table --}}
        @else
            <p class="text-center p-0 m-0">Non hai ancora aggiunto un ristorante</p>
        @endif

    </div>
@endsection
