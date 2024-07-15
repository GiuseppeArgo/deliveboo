@extends('layouts.admin')

@section('content')
    <h1 class="text-center mt-5">Modifica Piatto: </h1>
    {{-- @include('partials.errors') --}}
    <div class="w-50 m-auto p-5">

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
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $dish->name) }}">
            {{-- /name --}}

            {{-- description  --}}
            <label for="decription">
                <strong>Descrizione:</strong>
                @error('description')
                    <span class="text-danger"> {{ $errors->first('description') }} </span>
                @enderror
            </label>
            <textarea name="description" id="description" class="form-control" cols="30" rows="10">{{ old('description', $dish->description) }}</textarea>
            {{-- /description  --}}

            {{-- price --}}
            <label for="price">
                <strong>Prezzo:</strong>
                @error('price')
                    <span class="text-danger"> {{ $errors->first('price') }} </span>
                @enderror
            </label>
            <input type="number" id="price" name="price" class="form-control"
                value="{{ old('price', $dish->price) }}">
            {{-- /price --}}

            {{-- visibility --}}
            <label for="visibility">
                <strong>Disponibilità:</strong>
                <span class="text-danger"> {{ $errors->first('visibility') }} </span>
            </label>
            <select name="visibility" id="visibility" class="form-control">
                <option @selected($dish->visibility === 1) value="1">
                    Attivo
                </option>
                <option @selected($dish->visibility === 0) value="0">
                    Non Attivo
                </option>
            </select>
            {{-- /visibility --}}

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
                </div>
                {{-- /old and new img --}}

                {{-- button add and remove --}}
                <div class="container mt-3 mb-3">
                    <div class="row gap-2 justify-content-center">
                        <button class="btn btn-success p-0 col-5" type="submit">Aggiorna</button>
                        <a id="btnDelete" class="btn btn-danger col-5 hide">Rimuovi</a>
                    </div>
                </div>
                {{-- /button add and remove --}}

            </div>

            <input type="text" name="restaurant_id" class="hide" value="{{ $restaurant_id }}">
            <input type="text" name="oldname" class="hide" value="{{ $dish->name }}">

        </form>

    </div>
@endsection
