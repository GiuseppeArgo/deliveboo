@extends('layouts.admin')

@section('content')
    <h1 class="text-center mt-5">Piatti Del menu ( {{count($dishesList)}}  )</h1>
    <div class="container m-auto">
        <table class="table table-striped table-responsive text-center">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Prezzo</th>
                    <th scope="col">Att/Disat</th>
                    <th scope="col">Button</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dishesList as $dish)
                    <tr>
                        <td>{{ $dish->name }}</td>
                        <td>{{ $dish->price }} €</td>

                            <td>
                                    <form action="{{ route('admin.dishes.toggle', ['id' => $dish->id]) }}" method="POST"
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
                                    </form>
                            </td>
                        <td class="d-flex gap-1">
                            <a class="text-black btn btn-info"
                                href="{{ route('admin.dishes.show', ['dish' => $dish->slug]) }}">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <a class="text-black btn btn-success"
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
