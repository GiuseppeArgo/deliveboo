@extends('layouts.admin')

@section('content')
@include('partials.errors')
{{-- form --}}
<form class="w-50 m-auto d-flex flex-column pt-5"
    action="{{ route('admin.restaurants.update', ['restaurant' => $restaurant->slug]) }}" method="POST"
    enctype="multipart/form-data">
    @csrf
    @method('put')

    {{-- title --}}
    <label for="name_restaurant">Nome Attività :

        {{-- error message --}}
        @error('name_restaurant')
            <span class="text-danger">
                {{ $errors->first('name_restaurant') }}
            </span>
        @enderror
        {{-- /error message --}}

    </label>
    <input
        class="form-control

    {{-- dynamic class with red border --}}
    @error('name_restuarant')
        is-invalid
    @enderror"
        {{-- /dynamic class with red border --}} type="text" id="name_restaurant" name="name_restaurant" value="{{ old('name_restaurant', $restaurant->name_restaurant) }}">
    {{-- /title --}}

    {{-- address --}}
    <label for="address">Indirizzo :

        {{-- error message --}}
        @error('address')
            <span class="text-danger">
                {{ $errors->first('address') }}
            </span>
        @enderror
        {{-- /error message --}}

    </label>
    <textarea
        class="form-control

    {{-- dynamic class with red border --}}
    @error('address')
        is-invalid
    @enderror"
        {{-- /dynamic class with red border --}} type="text" id="address" name="address">{{ old('address', $restaurant->address) }}</textarea>

    {{-- /address --}}


    {{-- description --}}
    <label for="description">Descrizione :

        {{-- error message --}}
        @error('description')
            <span class="text-danger">
                {{ $errors->first('description') }}
            </span>
        @enderror
        {{-- /error message --}}

    </label>
    <textarea
        class="form-control

    {{-- dynamic class with red border --}}
    @error('description')
        is-invalid
    @enderror"
        {{-- /dynamic class with red border --}} type="text" id="description" name="description">{{ old('description', $restaurant->description) }}</textarea>

    {{-- /description --}}


    {{-- Tipologia --}}
    <p>Tipologie:</p>
    <div class="btn-group flex flex-wrap" role="group" aria-label="Basic checkbox toggle button group">
        @foreach ($listTypes as $curType)
            @if (old('tipologies') !== null)
                <input type="checkbox" class="btn-check w-25" id="tech-{{ $curType->id }}" name="tipologies[]"
                    value="{{ $curType->id }}" @checked(in_array($curType->id, old('tipologies')))>
            @else
                <input type="checkbox" class="btn-check w-25" id="tech-{{ $curType->id }}" name="tipologies[]"
                    value="{{ $curType->id }}" @checked($restaurant->types->contains($curType))>
            @endif

            <label class="btn btn-outline-primary w-25"
                for="tech-{{ $curType->id }}">{{ $curType->name }}</label>
        @endforeach
    </div>
    {{-- Tipologia --}}


    {{-- file cover_image --}}

    <label for="cover_image"> Immagine</label>
    <input
        class="form-control
    {{-- dynamic class with red border --}}
    @error('cover_image')
        is-invalid
    @enderror"
        {{-- /dynamic class with red border --}} type="file" name="cover_image" id="cover_image">

    {{-- error message --}}
    @error('cover_image')
        <span class="text-danger">
            {{ $errors->first('cover_image') }}
        </span>
    @enderror
    {{-- /error message --}}

    {{-- /file cover_image --}}

    {{-- check remove image --}}
    @if ($restaurant->cover_image !== null)
        <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
            <input class="btn-check" type="checkbox" id="removeImage" name="removeImage">
            <label class="btn btn-outline-primary mt-3" for="removeImage">Rimuovi immagine :</label>
        </div>
    @endif
    {{-- /check remove image --}}

    {{-- old and new img --}}
    <div class="container-preview">

        <div class="mt-2 img-container w-100">
            <img id="oldImg" src="{{ asset('storage/' . $restaurant->cover_image) }}" alt="">
            <img id="imagePreview" class="hide" src="" alt="new-image">
        </div>
        {{-- /old and new img --}}

        {{-- button add and remove --}}
        <div>
            <button class="btn btn-success mt-3 w-25" type="submit">Aggiorna</button>
            <a id="btnDelete" class="btn btn-danger mt-3 hide w-25">rimuovi</a>
        </div>
        {{-- /button add and remove --}}

    </div>



</form>
@endsection
