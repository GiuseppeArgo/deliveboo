@extends('layouts.admin')

@section('content')
    {{-- button --}}
    <div class="form-container border-white ">
        <div class="row ">
            <div class="col-6 d-flex justify-content-end">
                <a class="btn btn-primary col-lg-3 col-md-6 col-sm-6 flex-center gap-1"
                    href="{{ route('admin.dishes.index') }}">
                    <i class="fa-solid fa-circle-arrow-left"></i>
                    <span>
                        Indietro
                    </span>
                </a>
            </div>
            <div class="col-6 d-flex justify-content-start">
                <a class="btn btn-primary col-lg-3 col-md-6 col-sm-6 flex-center gap-1"
                    href="{{ route('admin.restaurants.index') }}">
                    <i class="fa-solid fa-circle-arrow-left"></i>
                    <span>
                        Home
                    </span>
                </a>
            </div>
        </div>
    </div>
    {{-- /button --}}

    {{-- container --}}
    <div class="form-container p-5">

        <div class="mb-4">
            {{-- title --}}
            <h1 class="text-center">Aggiungi un piatto</h1>
            {{-- /title --}}
        </div>

        <form action="{{ route('admin.dishes.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Name --}}
            <div class="mb-3">
                <label for="name" class="form-label">Nome piatto <span class="asterisco">*</span>
                    {{-- error message --}}
                    @error('name')
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @enderror
                    {{-- errore unique name --}}
                    @if (session('error'))
                        <span class="text-danger">{{ session('error') }}</span>
                    @endif
                    {{-- /error message --}}


                </label>
                <input value="{{ old('name') }}" type="text" minlength="5" maxlength="20" name="name"
                    class="form-control @error('name') is-invalid @enderror" placeholder="es. Lasagna" required
                    id="name" aria-describedby="name">
            </div>
            {{-- /name --}}

            {{-- Description --}}
            <div class="mb-3">
                <label for="description" class="form-label">Descrizione <span class="asterisco">*</span>

                    {{-- error message --}}
                    @error('description')
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                    @enderror
                    {{-- /error message --}}

                </label>

                <textarea class="form-control @error('description') is-invalid @enderror" name="description" minlength="5"
                    maxlength="200" id="description" rows="3" placeholder="es. breve descrizione e ingredienti..." required>{{ old('description') }}</textarea>
            </div>
            {{-- /Description --}}

            {{-- Price --}}
            <div class="mb-3">
                <label for="price" class="form-label">Prezzo <span class="asterisco">*</span>

                    {{-- error message --}}
                    @error('price')
                        <span class="text-danger">{{ $errors->first('price') }}</span>
                    @enderror
                    {{-- /error message --}}

                </label>

                <input value="{{ old('price') }}" type="number" name="price"
                    class="form-control @error('price') is-invalid @enderror" placeholder="es. 10.00" id="price"
                    aria-describedby="price" required min="3" max="30" step="0.01">
            </div>
            {{-- /Price --}}

            {{-- input file image --}}
            <div class="mb-3">
                <label for="image" class="form-label">Immagine <span class="asterisco">*</span>

                    {{-- error message --}}
                    @error('image')
                        <span class="text-danger">{{ $errors->first('image') }}</span>
                    @enderror
                    {{-- /error message --}}

                </label>

                <span id="errorImage" class="text-danger"></span>
                {{-- <input type="file" name="image" id="image" aria-describedby="image"
                    class="form-control @error('image') is-invalid @enderror" required> --}}

                <!-- customize button -->
                <button type="button" class="custom-file-upload btn btn-primary d-block">Scegli file</button>

                <!--  hide Input file -->
                <input class="form-control @error('image') is-invalid @enderror" type="file" name="image"
                    id="image" style="display:none;">

            </div>
            {{-- /input file image --}}

            <div class="m-auto mt-3 square-image-container">
                {{-- img preview --}}
                <div class="mt-2 card-img ">
                    <img id="imagePreview" class="from-control hide mb-3 square-image square-image-edit-restaurant" src="" alt="new-image">
                </div>
                {{-- /img preview --}}

            </div>

            {{-- button add and remove --}}
            <div class="flex-center">
                <button class="btn btn-success m-0" type="submit">Crea piatto</button>
            </div>
            {{-- /button add and remove --}}

            <div class="mt-5">
                <span class="asterisco">*</span>
                <span class="field-required">
                    ⁠questi campi sono obbligatori
                </span>
            </div>

            {{-- hide input --}}
            <input type="text" name="restaurant_id" class="hide" value="{{ $restaurant_id }}" required>
            {{-- hide input --}}

        </form>
    </div>
    {{-- /container --}}

    <script>
        // {{-- javascript validation image --}}
        function validateImage(file) {
            return new Promise((resolve) => {
                // control extension image
                const allowedExtensions = ['jpg', 'jpeg', 'png'];
                const extension = file.name.split('.').pop().toLowerCase();
                if (!allowedExtensions.includes(extension)) {
                    resolve({
                        valid: false,
                        error: 'Tipo di file non valido.'
                    });
                    return;
                }

                // control size image
                const maxSize = 1024 * 1024 * 2; // max 2 mm
                if (file.size > maxSize) {
                    resolve({
                        valid: false,
                        error: 'Il file è troppo grande. Dimensione massima consentita: 2 MB.'
                    });
                    return;
                }

                resolve({
                    valid: true
                });
            });
        }
        //listen change tu imput file
        document.querySelector('#image').addEventListener('change', async function() {
            const file = this.files[0];
            const imgElem = document.getElementById("imagePreview");
            const errImg = document.getElementById("errorImage");

            if (file) {
                // wait return of function
                const {
                    valid,
                    error
                } = await validateImage(file);
                //if big image o invalid format reset input and hide image
                if (!valid) {
                    imgElem.src = "";
                    imgElem.classList.add('hide');
                    errImg.textContent = error;
                    this.value = '';
                } else {
                    // show img preview
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        imgElem.src = event.target.result;
                        imgElem.classList.remove('hide');
                    };
                    reader.readAsDataURL(file);

                    // reset value error
                    errImg.textContent = "";
                }
            }
        });

        // hide image to start
        document.addEventListener('DOMContentLoaded', function() {
            const imagePreview = document.getElementById("imagePreview");
            if (!imagePreview.src) {
                imagePreview.classList.add('hide');
            }
        });
        // {{-- /javascript validation image --}}

        // {{-- input file --}}
        document.addEventListener("DOMContentLoaded", function() {
            // Mostra l'input file quando l'utente clicca sul pulsante personalizzato
            document.querySelector('.custom-file-upload').addEventListener('click', function() {
                document.getElementById('image').click();
            });

            // Nasconde l'input file dopo che un file è stato selezionato
            document.getElementById('image').addEventListener('change', function() {
                this.style.display = 'none'; // Nasconde l'input file
            });
        });
        // {{-- input file --}}
    </script>
@endsection
