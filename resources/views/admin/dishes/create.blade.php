@extends('layouts.admin')

@section('content')
    <div class="form-container p-5">
        <div class="d-flex flex-column justify-content-center align-items-center gap-2 mb-2">
            <h1 class="text-center">Aggiungi un piatto</h1>
            <div>
                <a href="{{ route('admin.dishes.index') }}" class="btn btn-primary">Visualizza menu</a>
                <a class="btn btn-primary" href="{{ route('admin.restaurants.index') }}">
                    Torna alla home
                </a>
            </div>

        </div>
        {{-- @include('partials.errors') --}}

        <form action="{{ route('admin.dishes.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Nome --}}
            <div class="mb-3">
                <label for="name" class="form-label">Nome Piatto *

                    {{-- error message --}}
                    @error('name')
                        <span class="text-danger"> {{ $errors->first('name') }} </span>
                    @enderror
                    {{-- /error message --}}

                    {{-- gestiamo errore nome del piatto gia esistente --}}
                    @if (session('error'))
                        <span class="text-danger">{{ session('error') }}</span>
                    @endif
                    {{-- gestiamo errore nome del piatto gia esistente --}}
                </label>
                <input value="{{ old('name') }}" type="text" name="name"
                    class="form-control
                    {{-- dynamic class with red border --}}
                    @error('name') is-invalid @enderror"
                    placeholder="es. Lasagna" required {{-- /dynamic class with red border --}} id="name" aria-describedby="name">
            </div>
            {{-- /Nome --}}


            {{-- Descrizione --}}
            <div class="mb-3">
                <label for="description" class="form-label">Descrizione *
                    {{-- error message --}}
                    @error('description')
                        <span class="text-danger"> {{ $errors->first('description') }} </span>
                    @enderror
                    {{-- /error message --}}
                </label>
                <textarea for="description @error('description') is-invalid @enderror"
                    class="form-control   @error('description') is-invalid @enderror" name="description" id="description" rows="3"
                    placeholder="es. breve descrizione e ingredienti..." required>{{ old('description') }}</textarea>
            </div>
            {{-- Descrizione --}}

            {{-- Prezzo --}}
            <div class="mb-3">
                <label for="price" class="form-label">Prezzo *
                    {{-- error message --}}
                    @error('price')
                        <span class="text-danger"> {{ $errors->first('price') }} </span>
                    @enderror
                    {{-- /error message --}}
                </label>
                <input value="{{ old('price') }}" type="text" pattern="\d*(\.\d{1,2})?" name="price"
                    class="form-control
                    {{-- dynamic class with red border --}}
                    @error('price') is-invalid @enderror"
                    placeholder="es. 10.00" {{-- /dynamic class with red border --}} id="price" aria-describedby="price" required>
            </div>
            {{-- Prezzo --}}

            {{-- restaurant id che dovra passarci l'index adesso lo impostiamo noi a mano --}}
            <input type="text" name="restaurant_id" class="hide" value="{{ $restaurant_id }}" required>

            {{-- Immagine --}}
            <div class="mb-3">
                <label for="image" class="form-label"> Immagine *
                    {{-- error message --}}
                    @error('image')
                        <span class="text-danger"> {{ $errors->first('image') }} </span>
                    @enderror
                    {{-- /error message --}}
                </label>
                <input value="{{ old('image') }}" type="file" name="image" id="image" aria-describedby="image"
                    class="form-control @error('image') is-invalid @enderror" required>
            </div>
            {{-- /Immagine --}}

            <div class="container-preview m-auto mt-3">

                {{-- img preview --}}
                <div class="container-preview m-auto mt-3">
                    <div class="mt-2 card-img">
                        <img id="imagePreview" class="hide mb-3" src="" alt="new-image">
                        <a id="btnDelete" class="btn btn-danger col hide w-100">Rimuovi immagine</a>
                    </div>
                </div>
                {{-- /img preview --}}

                {{-- button add and remove --}}
                <div class="container">
                    <div class="row gap-2 mt-3 align-items-center justify-content-center">
                        <button class="btn btn-success col" type="submit">Crea piatto</button>
                    </div>
                </div>
                {{-- /button add and remove --}}

            </div>

        </form>

    </div>
@endsection
