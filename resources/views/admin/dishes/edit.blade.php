@extends('layouts.admin')

@section('content')

    <div class="d-flex flex-column gap-2 align-items-center justify-content-center mt-5">
        <h1 class="text-center">Modifica Piatto: </h1>
        <a href="{{ route('admin.dishes.index') }}" class="btn btn-primary">Torna al menu</a>
    </div>

    {{-- @include('partials.errors') --}}
    <div class="form-container p-5">

        <form action="{{ route('admin.dishes.update', ['dish' => $dish->slug]) }}" method="POST"
            class="d-flex flex-column gap-2" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- name --}}
            <label for="name">
                <strong>Nome:</strong>
                @error('name')
                    <span class="text-danger"> {{ $errors->first('name') }} </span>
                @enderror

                {{-- gestiamo errore nome del piatto gia esistente --}}
                @if (session('error'))
                    <span class="text-danger">{{ session('error') }}</span>
                @endif
                {{-- gestiamo errore nome del piatto gia esistente --}}
            </label>
            <input type="text" id="name" name="name" class="form-control mb-3"
                value="{{ old('name', $dish->name) }}" placeholder="es. Carbonara" required>
            {{-- /name --}}

            {{-- description  --}}
            <label for="decription">
                <strong>Descrizione:</strong>
                @error('description')
                    <span class="text-danger"> {{ $errors->first('description') }} </span>
                @enderror
            </label>
            <textarea name="description" id="description" class="form-control" cols="30" rows="10"
                placeholder="es. breve descrizione e ingredienti..." required>{{ old('description', $dish->description) }}</textarea>
            {{-- /description  --}}

            {{-- price --}}
            <label for="price">
                <strong>Prezzo:</strong>
                @error('price')
                    <span class="text-danger"> {{ $errors->first('price') }} </span>
                @enderror
            </label>
            <input class="form-control" type="text" pattern="\d*(\.\d{1,2})?" name="price"
                value="{{ old('price', $dish->price) }}" placeholder="es. 10.00" required>
            {{-- /price --}}

            {{-- visibility --}}
            {{-- <label for="visibility">
                <strong>Disponibilità:</strong>
                <span class="text-danger"> {{ $errors->first('visibility') }} </span>
            </label>
            <select name="visibility" id="visibility" class="">
                <option @selected($dish->visibility === 1) value="1">
                    Attivo
                </option>
                <option @selected($dish->visibility === 0) value="0">
                    Non Attivo
                </option>
            </select> --}}
            {{-- /visibility --}}

            {{-- visibility --}}
            {{-- <label for="visibility">
                <strong>Disponibilità:</strong>
                <span class="text-danger">{{ $errors->first('visibility') }}</span>
            </label>
            <div class="form-check">
                <input type="radio" name="visibility" id="active" value="1"
                    {{ $dish->visibility == 1 ? 'checked' : '' }}>
                <label for="active">Attivo</label>
            </div>
            <div class="form-check">
                <input type="radio" name="visibility" id="inactive" value="0"
                    {{ $dish->visibility == 0 ? 'checked' : '' }}>
                <label for="inactive">Non Attivo</label>
            </div> --}}
            {{-- /visibility --}}

            <div class="btn-group" role="group" aria-label="Disponibilità">
                <input type="radio" name="visibility" id="active" value="1" class="btn-check"
                    {{ $dish->visibility == 1 ? 'checked' : '' }}>
                <label class="btn btn-outline-primary" for="active">Disponibile</label>
                <input type="radio" name="visibility" id="inactive" value="0" class="btn-check"
                    {{ $dish->visibility == 0 ? 'checked' : '' }}>
                <label class="btn btn-outline-primary" for="inactive">Non disponibile</label>
            </div>

            {{-- file image --}}

            <label for="image">
                <strong>Immagine:</strong>
            </label>
            <input class="form-control" type="file" name="image" id="image" {{-- dynamic class with red border --}}
                @error('image') is-invalid @enderror {{-- /dynamic class with red border --}} value="{{ old('image', $dish->image) }}">

            {{-- /file image --}}

            @if (!empty($dish->image))
                @error('image')
                    <span class="text-danger"> {{ $errors->first('image') }} </span>
                @enderror
            @endif

            {{-- old and new img --}}
            <div class="container-preview m-auto mt-3">

                <div class="mt-2 card-img">
                    <img id="oldImg" src="{{ asset('storage/' . $dish->image) }}" alt="">
                    <img id="imagePreview" class="hide" src="" alt="new-image">
                    <a id="btnDelete" class="btn btn-danger col-5 hide w-100 mt-3">Rimuovi immagine</a>
                </div>
                {{-- /old and new img --}}

                {{-- button add and remove --}}
                <div class="container mt-3 mb-3">
                    <div class="row gap-2 justify-content-center">
                        <button class="btn btn-success col-5 w-100" type="submit">Aggiorna dettagli</button>

                    </div>
                </div>
                {{-- /button add and remove --}}

            </div>

            <input type="text" name="restaurant_id" class="hide" value="{{ $restaurant_id }}">
            <input type="text" name="oldname" class="hide" value="{{ $dish->name }}">

        </form>

    </div>
@endsection
