@extends('layouts.admin')

@section('content')
    <div class="form-container p-5">
        <h1 class="text-center mt-5 mb-5">Aggiungi un piatto</h1>
        {{-- @include('partials.errors') --}}
        <form action="{{ route('admin.dishes.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Nome --}}
            <div class="mb-3">
                <label for="name" class="form-label">Nome Piatto:
                    {{-- error message --}}
                    @error('name')
                        <span class="text-danger"> {{ $errors->first('name') }} </span>
                    @enderror
                    {{-- /error message --}}
                </label>
                <input value="{{ old('name') }}" type="text" name="name"
                    class="form-control
                     {{-- dynamic class with red border --}}
                    @error('name') is-invalid @enderror"
                    {{-- /dynamic class with red border --}} id="name" aria-describedby="name">
            </div>
            {{-- /Nome --}}


            {{-- Immagine --}}
            <div class="mb-3">
                <label for="image" class="form-label"> Immagine
                    {{-- error message --}}
                    @error('image')
                        <span class="text-danger"> {{ $errors->first('image') }} </span>
                    @enderror
                    {{-- /error message --}}
                </label>
                <input value="{{ old('image') }}" type="file" name="image" id="image" aria-describedby="image"
                    class="form-control
                @error('image') is-invalid @enderror">
            </div>
            {{-- /Immagine --}}

            {{-- Descrizione --}}
            <div class="mb-3">
                <label for="description" class="form-label">Descrizione :
                    {{-- error message --}}
                    @error('description')
                        <span class="text-danger"> {{ $errors->first('description') }} </span>
                    @enderror
                    {{-- /error message --}}
                </label>
                <textarea for="description @error('description') is-invalid @enderror"
                    class="form-control   @error('description') is-invalid @enderror" name="description" id="description"
                    rows="3">
                            {{ old('description') }}
                </textarea>
            </div>
            {{-- Descrizione --}}

            {{-- Prezzo --}}
            <div class="mb-3">
                <label for="price" class="form-label">Prezzo:
                    {{-- error message --}}
                    @error('price')
                        <span class="text-danger"> {{ $errors->first('price') }} </span>
                    @enderror
                    {{-- /error message --}}
                </label>
                <input value="{{ old('price') }}" type="number" name="price"
                    class="form-control
                    {{-- dynamic class with red border --}}
                    @error('price') is-invalid @enderror"
                    {{-- /dynamic class with red border --}} id="price" aria-describedby="price">
            </div>
            {{-- Prezzo --}}

            {{-- restaurant id che dovra passarci l'index adesso lo impostiamo noi a mano --}}
            <input type="text" name="restaurant_id" class="hide" value="11">

            <button type="submit" class="btn btn-primary">Aggiungi</button>
        </form>

    </div>
@endsection
