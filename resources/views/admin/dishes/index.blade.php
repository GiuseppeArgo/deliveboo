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
                                    <form class="d-flex gap-1 justify-content-center" action="{{ route('admin.dishes.toggle', ['id' => $dish->id]) }}" method="POST">
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
                                        <button type="submit" class="btn btn-success"> ok</button>
                                    </form>
                            </td>
                        <td>
                            <a class="text-black btn btn-info"
                                href="{{ route('admin.dishes.show', ['dish' => $dish->slug]) }}">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <a class="text-black btn btn-warning"
                            href="{{ route('admin.dishes.edit', ['dish' => $dish->slug]) }}">
                            <i class="fa-solid fa-pen"></i>
                        </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
