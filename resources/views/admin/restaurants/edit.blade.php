@extends('layouts.admin')

@section('content')
    @include('partials.errors')

    <h1 class="text-center mt-5">Modifica i tuoi dati</h1>
    <div class="form-container p-5">
        {{-- form --}}
        <form class="d-flex flex-column" action="{{ route('admin.restaurants.update', ['restaurant' => $restaurant->slug]) }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')

            {{-- title --}}
            <div class="mb-3">

                <label for="name">Nome Attività :
                    {{-- error message --}}
                    @error('name')
                        <span class="text-danger"> {{ $errors->first('name') }} </span>
                    @enderror
                    {{-- /error message --}}
                </label>

                <input
                    class="form-control
            {{-- dynamic class with red border --}}
                @error('name') is-invalid @enderror"
                    {{-- /dynamic class with red border --}} type="text" id="name" name="name"
                    value="{{ old('name', $restaurant->name) }}">
            </div>
            {{-- /title --}}

            {{-- address --}}
            <div class="mb-3">

                <label for="address">Indirizzo :
                    {{-- error message --}}
                    @error('address')
                        <span class="text-danger"> {{ $errors->first('address') }} </span>
                    @enderror
                    {{-- /error message --}}
                </label>

                <input
                    class="form-control
            {{-- dynamic class with red border --}}
            @error('address') is-invalid @enderror"
                    {{-- /dynamic class with red border --}} type="text" id="address" name="address"
                    value="{{ old('address', $restaurant->address) }}">
            </div>
            {{-- /address --}}


            {{-- description --}}
            <div class="mb-3">

                <label for="description">Descrizione :
                    {{-- error message --}}
                    @error('description')
                        <span class="text-danger"> {{ $errors->first('description') }} </span>
                    @enderror
                    {{-- /error message --}}
                </label>

                <textarea class="form-control
            @error('description') is-invalid @enderror" type="text" id="description"
                    name="description">{{ old('description', $restaurant->description) }}</textarea>
            </div>
            {{-- /description --}}


            {{-- Tipologia --}}

            <p>Tipologie:</p>
            @error('tipologies')
                <span class="text-danger"> {{ $errors->first('tipologies') }} </span>
            @enderror
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

                            <label class="btn btn-outline-secondary"
                                for="tech-{{ $curType->id }}">{{ $curType->name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
            {{-- Tipologia --}}


            {{-- file image --}}
            <div class="mb-3">

                <label for="image"> Immagine</label>
                <input class="form-control" type="file" name="image" id="image" {{-- dynamic class with red border --}}
                    @error('image') is-invalid @enderror {{-- /dynamic class with red border --}}
                    value="{{ old('address', $restaurant->address) }}">


                {{-- error message --}}
                @if (!empty($restaurant->image))
                    @error('image')
                        <span class="text-danger"> {{ $errors->first('image') }} </span>
                    @enderror
                @endif
                {{-- /error message --}}
            </div>
            {{-- /file image --}}

            {{-- old and new img --}}
            <div class="container-preview m-auto mt-3">

                <div class="mt-2 card-img">
                    <img id="oldImg" src="{{ asset('storage/' . $restaurant->image) }}" alt="">
                    <img id="imagePreview" class="hide" src="" alt="new-image">
                </div>
                {{-- /old and new img --}}

                {{-- button add and remove --}}
                <div class="container">
                    <div class="row gap-2 mt-3 align-items-center justify-content-center">
                        <button class="btn btn-success col" type="submit">Conferma</button>
                        <a id="btnDelete" class="btn btn-danger col hide">Rimuovi</a>
                    </div>
                </div>
                {{-- /button add and remove --}}

            </div>

        </form>
    </div>
@endsection
