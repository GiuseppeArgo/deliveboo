@extends('layouts.admin')

@section('content')
    <h1 class="text-center mt-5 mb-5">Lista dei Ristoranti</h1>

    <div class="form-container p-5">

        {{-- table --}}
        <table class="table">

            {{-- thead --}}
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Città</th>
                    <th>Indirizzo</th>
                    <th>Bottoni</th>
                </tr>
            </thead>
            {{-- /thead --}}

            {{-- tbody --}}
            <tbody>
                @foreach ($restaurants as $restaurant)
                    <tr>
                        <td>{{ $restaurant->name }}</td>
                        <td>{{ $restaurant->city }}</td>
                        <td>{{ $restaurant->address }}</td>
                        <td>
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

    </div>
@endsection
