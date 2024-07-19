@extends('layouts.admin')

@section('content')
<div class="d-flex flex-column justify-content-center align-items-center gap-2 mt-5">
    <h1 class="text-center">Modifica i tuoi dati</h1>
    <a class="btn btn-primary text-white" href="{{ route('admin.restaurants.index') }}">
        Torna Alla Home
    </a>
</div>
    <div class="form-container p-5">
        {{-- form --}}
        <form class="d-flex flex-column" action="{{ route('admin.restaurants.update', ['restaurant' => $restaurant->slug]) }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')

            {{-- title --}}
            <div class="mb-3">

                <label for="name">Nome Attività *
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
                    {{-- /dynamic class with red border --}} type="text" id="name" name="name" minlength="3" maxlength="20"
                    value="{{ old('name', $restaurant->name) }}" placeholder="es. Bar Portici" required>
            </div>
            {{-- /title --}}

            {{-- address --}}
            <div class="mb-3">

                <label for="address">Indirizzo *
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
                    {{-- /dynamic class with red border --}} type="text" id="address" name="address" minlength="3" maxlength="20"
                    value="{{ old('address', $restaurant->address) }}" placeholder="es. Via Ugo Foscolo" required>
            </div>
            {{-- /address --}}


            {{-- description --}}
            <div class="mb-3">

                <label for="description">Descrizione *
                    {{-- error message --}}
                    @error('description')
                        <span class="text-danger"> {{ $errors->first('description') }} </span>
                    @enderror
                    {{-- /error message --}}
                </label>

                <textarea class="form-control @error('description') is-invalid @enderror" type="text" minlength="5" maxlength="200" id="description"
                    name="description" required placeholder="es. Situati vicino alle stalle dei cavalli di San Siro">{{ old('description', $restaurant->description) }}</textarea>
            </div>
            {{-- /description --}}


            {{-- Tipologia --}}

            <span>Tipologie * </span>
            <span id="error-message" class="text-danger" style="display:none;">
                Non puoi inserire piu di 2 tipologie.
            </span>
            {{-- errors typologies --}}
            @if ($errors->first('tipologies'))
                <span id="error-message" class="text-danger" style="display:none;">

                </span>
            @else
                @error('tipologies')
                    <span class="text-danger"> {{ $errors->first('tipologies') }} </span>
                @enderror
            @endif
            {{-- errors typologies --}}
            <div class="container mb-4">
                <div class="row" role="group" aria-label="Basic checkbox toggle button group">

                    @foreach ($listTypes as $curType)
                        <div class="col-4 btn-group flex flex-wrap mt-3">

                            @if (old('tipologies') !== null)
                                <input type="checkbox" class="btn-check" id="tech-{{ $curType->id }}" name="tipologies[]"
                                    value="{{ $curType->id }}" @checked(in_array($curType->id, old('tipologies')))   data-msg-required="ciao">
                            @else
                                <input type="checkbox" class="btn-check" id="tech-{{ $curType->id }}" name="tipologies[]"
                                    value="{{ $curType->id }}" @checked($restaurant->types->contains($curType))   data-msg-required="ciao">
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

                <label for="image"> Immagine *</label>
                <span id="errorImage" class="text-danger"></span>
                <input class="form-control
                @error('image') is-invalid @enderror" type="file"
                    name="image" id="image"
                    value="{{ old('image', $restaurant->image) }}">


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

    <script>
        function validateImage(file) {
            return new Promise((resolve, reject) => {
                // Verifica dell'estensione del file
                const allowedExtensions = ['jpg', 'jpeg', 'png'];
                const extension = file.name.split('.').pop().toLowerCase();
                if (!allowedExtensions.includes(extension)) {
                    alert('Tipo di file non valido.');
                    return resolve(false);
                }
                
                // Verifica del tipo MIME
                const allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];
                const reader = new FileReader();
                reader.onload = function(event) {
                    const mimeType = event.target.result.match(/:(.*?);/)[1];
                    if (!allowedMimeTypes.includes(mimeType)) {
                        alert('Tipo di file non valido.');
                        return resolve(false);
                    }
                    
                    // Verifica delle dimensioni del file
                    const maxSize = 1024 * 1024; // 1 MB
                    if (file.size > maxSize) {
                        // alert('Il file è troppo grande. Dimensione massima consentita: 1 MB.');
                        return resolve(false);
                    } 

                    return resolve(true);
                };
                reader.readAsDataURL(file);
            });
        }
        
        // Utilizzo
        document.querySelector('#image').addEventListener('change', async function() {
            const isValid = await validateImage(this.files[0]);
            const imgElem = document.getElementById("imagePreview");
            const errImg = document.getElementById("errorImage");
            const removeImg = document.getElementById("btnDelete");
            if (!isValid) {
                imgElem.src = "";
                imgElem.classList.add('hide');
                removeImg.classList.add('hide');
                errImg.innerHTML = "Immagine troppo grande";
                this.value = ''; // Ripristina il valore dell'input per rimuovere il file selezionato
            } else {
                imgElem.classList.remove('hide');
                removeImg.classList.remove('hide');
                errImg.innerHTML = "";
            }
        });
    </script>
@endsection
