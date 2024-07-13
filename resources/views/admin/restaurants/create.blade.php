@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Crea Il tuo Ristorante</h1>

        @include('partials.errors')

        <form action="{{ route('admin.restaurants.store') }}" method="POST">

            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nome Ristorante</label>
                <input value="{{ old('name') }}" type="text" name="name" class="form-control" id="name"
                    aria-describedby="name_restaurant">
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Indirizzo</label>
                <input value="{{ old('address') }}" type="text" name="address" class="form-control" id="address"
                    aria-describedby="address">
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Poster</label>
                <input value="image" type="file" name="image" class="form-control" id="image"
                    aria-describedby="cover_image">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descrizione</label>
                <textarea for="description" class="form-control" name="description" id="description" rows="3">
                        {{ old('description') }}
            </textarea>
            </div>

            {{-- Tipologia --}}
            <p>Tipologie:</p>
            <div class="container mb-4">
                <div class="row" role="group" aria-label="Basic checkbox toggle button group">

                    @foreach ($listTypes as $curType)
                        <div class="col-4 btn-group flex flex-wrap mt-3">

                            <input type="checkbox" class="btn-check" id="tech-{{ $curType->id }}" name="tipologies[]"
                                value="{{ $curType->id }}" @checked(in_array($curType->id, old('tipologies',[])))>


                            <label class="btn btn-outline-primary"
                                for="tech-{{ $curType->id }}">{{ $curType->name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
            {{-- Tipologia --}}

            <div class="mb-3">
                <label for="p_iva" class="form-label">Partita Iva</label>
                <input value="{{ old('address') }}" type="number" name="p_iva" class="form-control" id="p_iva"
                    aria-describedby="p_iva">
            </div>

            <button type="submit" class="btn btn-primary">Aggiungi</button>
        </form>
    </div>
@endsection
