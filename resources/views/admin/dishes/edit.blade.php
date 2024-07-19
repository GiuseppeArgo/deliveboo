@extends('layouts.admin')

@section('content')
    <div class="d-flex flex-column gap-2 align-items-center justify-content-center mt-5">
        <h1 class="text-center">Modifica Piatto</h1>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.dishes.index') }}" class="btn btn-primary">
                <i class="fa-solid fa-circle-arrow-left"></i>
                Torna indietro
            </a>
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

            {{-- Nome --}}
            <div class="mb-3">
                <label for="name" class="form-label">Nome Piatto *
                    @error('name')
                        <span class="text-danger"> {{ $errors->first('name') }} </span>
                    @enderror

                    {{-- Errore nome piatto esistente --}}
                    @if (session('error'))
                        <span class="text-danger">{{ session('error') }}</span>
                    @endif
                </label>
                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"
                    minlength="3" maxlength="20" value="{{ old('name', $dish->name) }}" placeholder="es. Carbonara"
                    required>
            </div>
            {{-- /Nome --}}

            {{-- Descrizione --}}
            <div class="mb-3">
                <label for="description" class="form-label">Descrizione *
                    @error('description')
                        <span class="text-danger"> {{ $errors->first('description') }} </span>
                    @enderror
                </label>
                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                    minlength="5" maxlength="200" rows="5" placeholder="es. breve descrizione e ingredienti..." required>{{ old('description', $dish->description) }}</textarea>
            </div>
            {{-- /Descrizione --}}

            {{-- Prezzo --}}
            <div class="mb-3">
                <label for="price" class="form-label">Prezzo *
                    @error('price')
                        <span class="text-danger"> {{ $errors->first('price') }} </span>
                    @enderror
                </label>
                <input type="number" id="price" name="price"
                    class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $dish->price) }}"
                    placeholder="es. 10.00" required min="3" max="30" step="0.01">
            </div>
            {{-- /Prezzo --}}

            {{-- Disponibilità --}}
            <div class="mb-3">
                <label class="form-label">Disponibilità *</label>
                <div class="btn-group d-flex" role="group" aria-label="Disponibilità">
                    <input type="radio" name="visibility" id="active" value="1" class="btn-check"
                        {{ $dish->visibility == 1 ? 'checked' : '' }}>
                    <label class="btn btn-outline-primary" for="active">Disponibile</label>
                    <input type="radio" name="visibility" id="inactive" value="0" class="btn-check"
                        {{ $dish->visibility == 0 ? 'checked' : '' }}>
                    <label class="btn btn-outline-primary" for="inactive">Non disponibile</label>
                </div>
            </div>
            {{-- /Disponibilità --}}

            {{-- Immagine --}}
            <div class="mb-3">
                <label for="image" class="form-label">Immagine *</label>
                <input type="file" name="image" id="image"
                    class="form-control @error('image') is-invalid @enderror">
                <span id="errorImage" class="text-danger"></span>
            </div>
            {{-- /Immagine --}}

            {{-- Immagine Esistente e Anteprima Nuova --}}
            <div class="container-preview m-auto mt-3">
                <div class="mt-2 card-img">
                    @if (!empty($dish->image))
                        <img id="oldImg" src="{{ asset('storage/' . $dish->image) }}" alt="Old Image"
                            class="img-fluid mb-2">
                    @endif
                    <img id="imagePreview" class="hide mb-3" src="" alt="New Image Preview">
                    <a id="btnDelete" class="btn btn-danger col-5 hide w-100 mt-3" href="#"
                        onclick="removeImage(event)">Rimuovi immagine</a>
                </div>
            </div>
            {{-- /Immagine Esistente e Anteprima Nuova --}}

            {{-- button add and remove --}}
            <div class="container mt-3 mb-3 text-center">
                <div class="row gap-2 justify-content-center">
                    <button class="btn btn-success col-3" type="submit">Aggiorna dettagli</button>
                </div>
            </div>
            {{-- /button add and remove --}}

            <input type="text" name="restaurant_id" class="hide" value="{{ $restaurant_id }}">
            <input type="text" name="oldname" class="hide" value="{{ $dish->name }}">

        </form>

    </div>

    <script>
        function validateImage(file) {
            return new Promise((resolve) => {
                // Verifica dell'estensione del file
                const allowedExtensions = ['jpg', 'jpeg', 'png'];
                const extension = file.name.split('.').pop().toLowerCase();
                if (!allowedExtensions.includes(extension)) {
                    resolve({
                        valid: false,
                        error: 'Tipo di file non valido.'
                    });
                    return;
                }

                // Verifica delle dimensioni del file
                const maxSize = 1024 * 1024; // 1 MB
                if (file.size > maxSize) {
                    resolve({
                        valid: false,
                        error: 'Il file è troppo grande. Dimensione massima consentita: 1 MB.'
                    });
                    return;
                }

                resolve({
                    valid: true
                });
            });
        }

        document.querySelector('#image').addEventListener('change', async function() {
            const file = this.files[0];
            const imgElem = document.getElementById("imagePreview");
            const oldImgElem = document.getElementById("oldImg");
            const errImg = document.getElementById("errorImage");
            const removeImg = document.getElementById("btnDelete");

            if (file) {
                const {
                    valid,
                    error
                } = await validateImage(file);
                if (!valid) {
                    imgElem.src = "";
                    imgElem.classList.add('hide');
                    removeImg.classList.add('hide');
                    errImg.textContent = error;
                    this.value = ''; // Ripristina il valore dell'input per rimuovere il file selezionato
                } else {
                    // Mostra l'anteprima dell'immagine
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        imgElem.src = event.target.result;
                        imgElem.classList.remove('hide');
                    };
                    reader.readAsDataURL(file);

                    // Mostra il pulsante per rimuovere l'immagine
                    removeImg.classList.remove('hide');
                    errImg.textContent = "";
                }
            } else {
                // Nascondi l'anteprima e il pulsante di rimozione se non c'è file
                imgElem.classList.add('hide');
                removeImg.classList.add('hide');
            }
        });

        function removeImage(event) {
            event.preventDefault();
            const imageInput = document.querySelector('#image');
            const imagePreview = document.getElementById("imagePreview");
            const oldImage = document.getElementById("oldImg");
            const removeImgBtn = document.getElementById("btnDelete");
            imageInput.value = ''; // Ripristina il valore dell'input file
            imagePreview.src = '';
            imagePreview.classList.add('hide');
            removeImgBtn.classList.add('hide');
            oldImage.classList.remove('hide'); // Mostra l'immagine esistente se era nascosta
        }

        // Nascondere l'anteprima se non è presente alcuna immagine
        document.addEventListener('DOMContentLoaded', function() {
            const imagePreview = document.getElementById("imagePreview");
            if (!imagePreview.src) {
                imagePreview.classList.add('hide');
            }
        });
    </script>
@endsection
