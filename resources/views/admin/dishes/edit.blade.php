@extends('layouts.admin')

@section('content')

    <div class="d-flex flex-column gap-2 align-items-center justify-content-center mt-5">
        <h1 class="text-center">Modifica Piatto: </h1>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.dishes.index') }}" class="btn btn-primary">
                <i class="fa-solid fa-circle-arrow-left"></i>
                Torna indietro</a>
                {{-- btn home --}}
                <a class="btn btn-primary" href="{{ route('admin.restaurants.index') }}">
                    <i class="fa-solid fa-user"></i> Torna alla home
                </a>
                {{-- btn home --}}
        </div>
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
            <input type="text" id="name" name="name" class="form-control mb-3" minlength="3" maxlength="20"
                value="{{ old('name', $dish->name) }}" placeholder="es. Carbonara" required>
            {{-- /name --}}

            {{-- description  --}}
            <label for="decription">
                <strong>Descrizione:</strong>
                @error('description')
                    <span class="text-danger"> {{ $errors->first('description') }} </span>
                @enderror
            </label>
            <textarea name="description" id="description" class="form-control" minlength="5" maxlength="200" cols="30" rows="10"
                placeholder="es. breve descrizione e ingredienti..." required>{{ old('description', $dish->description) }}</textarea>
            {{-- /description  --}}

            {{-- price --}}
            <label for="price">
                <strong>Prezzo:</strong>
                @error('price')
                    <span class="text-danger"> {{ $errors->first('price') }} </span>
                @enderror
            </label>
            <input value="{{ old('price') }}" type="number" name="price"
                       class="form-control @error('price') is-invalid @enderror"
                       placeholder="es. 10.00" id="price" aria-describedby="price" required
                       min="3" max="30" step="0.01">
            {{-- /price --}}

            {{-- visibility --}}
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
            <span id="errorImage" class="text-danger"></span>
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
                console.log(imgElem);
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
