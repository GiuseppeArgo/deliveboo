@extends('layouts.admin')

@section('content')
    @include('partials.errors')

    <div class="form-container">

        {{-- form --}}
        <form class="w-50 m-auto d-flex flex-column pt-5"
            action="{{ route('admin.restaurants.update', ['restaurant' => $restaurant->slug]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('put')

            {{-- title --}}
            <label for="name">Nome Attività :
                {{-- error message --}}
                @error('name')
                    <span class="text-danger"> {{ $errors->first('name') }} </span>
                @enderror
                {{-- /error message --}}
            </label>

            <input class="form-control" type="text" id="name" name="name"
            {{-- dynamic class with red border --}}
                @error('name') is-invalid @enderror
            {{-- /dynamic class with red border --}}
            value="{{ old('name', $restaurant->name) }}">
            {{-- /title --}}

            {{-- address --}}
            <label for="address">Indirizzo :
                {{-- error message --}}
                @error('address')
                    <span class="text-danger"> {{ $errors->first('address') }} </span>
                @enderror
                {{-- /error message --}}
            </label>

            <input class="form-control" type="text" id="address" name="address" {{-- dynamic class with red border --}}
                @error('address') is-invalid @enderror {{-- /dynamic class with red border --}}
                value="{{ old('address', $restaurant->address) }}">
            {{-- /address --}}


            {{-- description --}}
            <label for="description">Descrizione :
                {{-- error message --}}
                @error('description')
                    <span class="text-danger"> {{ $errors->first('description') }} </span>
                @enderror
                {{-- /error message --}}
            </label>

            <textarea class="form-control" type="text" id="description" name="description" {{-- dynamic class with red border --}}
                @error('description') is-invalid @enderror>{{ old('description', $restaurant->description) }}</textarea>
            {{-- /description --}}


            {{-- Tipologia --}}
            <p>Tipologie:</p>
            <div class="container mb-4">
                <div class="row" role="group" aria-label="Basic checkbox toggle button group">

                    @foreach ($listTypes as $curType)
                        <div class="col-4 btn-group flex flex-wrap mt-3">

                            @if (old('tipologies') !== null)
                                <input type="checkbox" class="btn-check" id="tech-{{ $curType->id }}" name="tipologies[]"
                                    value="{{ $curType->id }}" @checked(in_array($curType->id, old('tipologies')))>
                            @else
                                <input type="checkbox" class="btn-check" id="tech-{{ $curType->id }}" name="tipologies[]"
                                    value="{{ $curType->id }}" @checked($restaurant->types->contains($curType))>
                            @endif

                            <label class="btn btn-outline-primary"
                                for="tech-{{ $curType->id }}">{{ $curType->name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
            {{-- Tipologia --}}


            {{-- file image --}}

            <label for="image"> Immagine</label>
            <input class="form-control" type="file" name="image" id="image" {{-- dynamic class with red border --}}
                @error('image') is-invalid @enderror>
            {{-- /dynamic class with red border --}}

            {{-- error message --}}
            @error('image')
                <span class="text-danger"> {{ $errors->first('image') }} </span>
            @enderror
            {{-- /error message --}}

            {{-- /file image --}}

            {{-- old and new img --}}
            <div class="container-preview m-auto mt-3">

                <div class="mt-2 card-img">
                    <img id="oldImg" src="{{ asset('storage/' . $restaurant->image) }}" alt="">
                    <img id="imagePreview" class="hide" src="" alt="new-image">
                </div>
                {{-- /old and new img --}}

                {{-- button add and remove --}}
                <div class="container mt-3 mb-3">
                    <div class="row gap-2 justify-content-center">
                        <button class="btn btn-success p-0 col-5" type="submit">Aggiorna</button>
                        <a id="btnDelete" class="btn btn-danger col-5">Rimuovi</a>
                    </div>
                </div>
                {{-- /button add and remove --}}

            </div>

        </form>
    </div>
@endsection
