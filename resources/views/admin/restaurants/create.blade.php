@extends('layouts.admin')

@section('content')
    <h1>Crea Il tuo Ristorante</h1>

    <form  method="POST">
        @csrf

        <div class="mb-3">
            <label for="name_restaurant" class="form-label">Nome Ristorante</label>
            <input value={{ old('name_restaurant') }} type="text" class="form-control" id="name_restaurant"
                aria-describedby="name_restaurant">
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Indirizzo</label>
            <input value={{ old('address') }} type="text" class="form-control" id="address" aria-describedby="address">
        </div>

        <div class="mb-3">
            <label for="cover_image" class="form-label">Poster</label>
            <input value={{ old('address') }} type="file" class="form-control" id="cover_image"
                aria-describedby="cover_image">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descrizione</label>
            <textarea for="description" class="form-control" id="description" rows="3">
                        {{ old('description') }}
            </textarea>
        </div>

        <div class="mb-3">
            <label for="p_iva" class="form-label">Partita Ivan</label>
            <input value={{ old('address') }} type="number" class="form-control" id="p_iva" aria-describedby="p_iva">
        </div>

        <button type="submit" class="btn btn-primary">Aggiungi</button>
    </form>
@endsection
