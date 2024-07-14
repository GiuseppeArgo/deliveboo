@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Crea Il tuo Ristorante</h1>



        <form action="{{ route('admin.restaurants.store') }}" method="POST" enctype="multipart/form-data">

            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nome Ristorante:
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
                    {{-- /dynamic class with red border --}} id="name" aria-describedby="name_restaurant">
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Indirizzo :
                    {{-- error message --}}
                    @error('address')
                        <span class="text-danger"> {{ $errors->first('address') }} </span>
                    @enderror
                    {{-- /error message --}}
                </label>
                <input value="{{ old('address') }}" type="text" name="address"
                    class="form-control
                @error('address') is-invalid @enderror
                "
                    id="address" aria-describedby="address">
            </div>
            
            {{-- Immaggine --}}
            <div class="mb-3">
                <label for="image" class="form-label"> Immagine</label>
                <input @error('image') is-invalid @enderror value="{{ old('image') }}" type="file" name="image"
                    class="form-control" id="image" aria-describedby="image">
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
                    class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="3">
                        {{ old('description') }}
            </textarea>
            </div>
            {{-- Descrizione --}}
            
            {{-- Tipologia --}}
            <p>Tipologie:</p>
            @error('tipologies')
                <span class="text-danger"> {{ $errors->first('tipologies') }} </span>
            @enderror
            <div class="container mb-4">
                <div class="row" role="group" aria-label="Basic checkbox toggle button group">

                    @foreach ($listTypes as $curType)
                        <div class="col-4 btn-group flex flex-wrap mt-3">
                            @if ('tipologies' !== null)
                                <input type="checkbox" class="btn-check" id="tech-{{ $curType->id }}" name="tipologies[]"
                                    value="{{ $curType->id }}" @checked(in_array($curType->id, old('tipologies', [])))>
                            @endif

                            <label class="btn btn-outline-primary"
                                for="tech-{{ $curType->id }}">{{ $curType->name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
            {{-- Tipologia --}}

            <div class="mb-3">
                <label for="p_iva" class="form-label">Partita Iva: 
                    {{-- error message --}}
                    @error('p_iva')
                        <span class="text-danger"> {{ $errors->first('p_iva') }} </span>
                    @enderror
                    {{-- /error message --}}
                </label>
                <input value="{{ old('address') }}" type="number" name="p_iva" class="form-control  @error('p_iva') is-invalid @enderror" id="p_iva"
                    aria-describedby="p_iva">
            </div>

            <button type="submit" class="btn btn-primary">Aggiungi</button>
        </form>
    </div>
@endsection
