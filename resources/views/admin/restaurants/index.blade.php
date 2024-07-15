@extends('layouts.admin')

@section('content')

        <h1 class="text-center mt-5 mb-5">Lista dei Ristoranti</h1>

                <div class="form-container p-5">
                        <table class="table">
                                <thead>
                                        <tr>
                                                <th>Nome</th>
                                                <th>Città</th>
                                                <th>Indirizzo</th>

                                        </tr>
                                </thead>
                                <tbody>
                                        @foreach($restaurants as $restaurant)
                                        <tr>
                                                <td>{{ $restaurant->name }}</td>
                                                <td>{{ $restaurant->city }}</td>
                                                <td>{{ $restaurant->address }}</td>
                                                <td>
                                                        <a href="{{ route('admin.restaurants.show', ['restaurant' => $restaurant->slug]) }}" class="btn btn-info">Show</a>
                                                        <a href="{{ route('admin.restaurants.edit', ['restaurant' => $restaurant->slug]) }}" class="btn btn-warning">Edit</a>
                                                </td>

                                        </tr>
                                        @endforeach
                                </tbody>
                        </table>
                </div>

@endsection
