@extends('layouts.admin')

@section('content')
    <h1 class="text-center mt-5">index piatti</h1>
    <div class="w-50 m-auto">
        <table class="table table-striped text-center">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Prezzo</th>
                    <th scope="col">Att/Disat</th>
                    <th scope="col">Button</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($listDishes as $dish)
                    <tr>
                        <td>{{ $dish->name }}</td>
                        <td>{{ $dish->price }}</td>
                        <td>
                        @if ($dish->visibility === 1)
                            <span class="text-success">Attivo</span>
                        @else
                            <span class="text-danger">Non Attivo</span>
                        @endif
                        </td>

                        <td>
                            <a class="text-black btn btn-info"
                                href="{{ route('admin.dishes.show', ['dish' => $dish->slug]) }}">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
