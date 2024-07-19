@extends('layouts.admin')

@section('content')
    <div class="form-container p-5">
        <div class="d-flex flex-column justify-content-center align-items-center gap-2 mb-2">
            <h1 class="text-center">Aggiungi un piatto</h1>
            <div>
                <a href="{{ route('admin.dishes.index') }}" class="btn btn-primary">
                    <i class="fa-solid fa-circle-arrow-left"></i>
                    Torna al menu
                </a>
                <a class="btn btn-primary" href="{{ route('admin.restaurants.index') }}">
                    <i class="fa-solid fa-circle-arrow-left"></i>
                    Torna alla home
                </a>
            </div>
        </div>

        <form action="{{ route('admin.dishes.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Nome --}}
            <div class="mb-3">
                <label for="name" class="form-label">Nome Piatto *
                    {{-- error message --}}
                    @error('name')
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @enderror
                    {{-- /error message --}}
                    {{-- errore nome piatto esistente --}}
                    @if (session('error'))
                        <span class="text-danger">{{ session('error') }}</span>
                    @endif
                </label>
                <input value="{{ old('name') }}" type="text" minlength="5" maxlength="20" name="name"
                    class="form-control @error('name') is-invalid @enderror"
                    placeholder="es. Lasagna" required id="name" aria-describedby="name">
            </div>
            {{-- /Nome --}}

            {{-- Descrizione --}}
            <div class="mb-3">
                <label for="description" class="form-label">Descrizione *
                    {{-- error message --}}
                    @error('description')
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                    @enderror
                    {{-- /error message --}}
                </label>
                <textarea class="form-control @error('description') is-invalid @enderror" name="description"
                    minlength="5" maxlength="200" id="description" rows="3"
                    placeholder="es. breve descrizione e ingredienti..." required>{{ old('description') }}</textarea>
            </div>
            {{-- /Descrizione --}}

            {{-- Prezzo --}}
            <div class="mb-3">
                <label for="price" class="form-label">Prezzo *
                    {{-- error message --}}
                    @error('price')
                        <span class="text-danger">{{ $errors->first('price') }}</span>
                    @enderror
                    {{-- /error message --}}
                </label>
                <input value="{{ old('price') }}" type="number" name="price"
                       class="form-control @error('price') is-invalid @enderror"
                       placeholder="es. 10.00" id="price" aria-describedby="price" required
                       min="3" max="30" step="0.01">
            </div>
            {{-- /Prezzo --}}

            {{-- Restaurant ID --}}
            <input type="text" name="restaurant_id" class="hide" value="{{ $restaurant_id }}" required>

            {{-- Immagine --}}
            <div class="mb-3">
                <label for="image" class="form-label">Immagine *
                    {{-- error message --}}
                    @error('image')
                        <span class="text-danger">{{ $errors->first('image') }}</span>
                    @enderror
                    {{-- /error message --}}
                </label>
                <span id="errorImage" class="text-danger"></span>
                <input type="file" name="image" id="image" aria-describedby="image"
                    class="form-control @error('image') is-invalid @enderror" required>
            </div>
            {{-- /Immagine --}}

            <div class="container-preview m-auto mt-3">
                {{-- img preview --}}
                <div class="mt-2 card-img">
                    <img id="imagePreview" class="hide mb-3" src="" alt="new-image">
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

    <script>
        function validateImage(file) {
            return new Promise((resolve) => {
                // Verifica dell'estensione del file
                const allowedExtensions = ['jpg', 'jpeg', 'png'];
                const extension = file.name.split('.').pop().toLowerCase();
                if (!allowedExtensions.includes(extension)) {
                    resolve({ valid: false, error: 'Tipo di file non valido.' });
                    return;
                }

                // Verifica delle dimensioni del file
                const maxSize = 1024 * 1024; // 1 MB
                if (file.size > maxSize) {
                    resolve({ valid: false, error: 'Il file è troppo grande. Dimensione massima consentita: 1 MB.' });
                    return;
                }

                resolve({ valid: true });
            });
        }

        document.querySelector('#image').addEventListener('change', async function() {
            const file = this.files[0];
            const imgElem = document.getElementById("imagePreview");
            const errImg = document.getElementById("errorImage");

            if (file) {
                const { valid, error } = await validateImage(file);
                if (!valid) {
                    imgElem.src = "";
                    imgElem.classList.add('hide');
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

                    // Rimuovi il messaggio di errore
                    errImg.textContent = "";
                }
            }
        });

        // Nascondere l'anteprima se non è presente alcuna immagine
        document.addEventListener('DOMContentLoaded', function() {
            const imagePreview = document.getElementById("imagePreview");
            if (!imagePreview.src) {
                imagePreview.classList.add('hide');
            }
        });
    </script>
@endsection
