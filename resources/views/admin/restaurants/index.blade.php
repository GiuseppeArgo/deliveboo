@extends('layouts.admin')

@section('content')
<!DOCTYPE html>
<html>




<body>
        <h1>Lista dei Ristoranti</h1>

        <ul>

                <!-- resources/views/restaurants/index.blade.php -->

                


                <div class="container">
                        <h1>Ristoranti</h1>
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



        </ul>
</body>

</html>

@endsection