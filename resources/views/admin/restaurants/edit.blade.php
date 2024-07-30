@extends('layouts.admin')

@section('content')
    {{-- container  --}}
    <div class="text-center mt-5">
        <a class="btn btn-primary text-white" href="{{ route('admin.restaurants.index') }}">
            <i class="fa-solid fa-circle-arrow-left"></i>
            Indietro
        </a>
    </div>
    <div class="form-container p-5">

        {{-- header --}}
        <div class="mb-4">
            <h1 class="text-center">Modifica i tuoi dati</h1>
        </div>
        {{-- header --}}


        {{-- form --}}
        <form class="d-flex flex-column" action="{{ route('admin.restaurants.update', ['restaurant' => $restaurant->slug]) }}"
            method="POST" enctype="multipart/form-data" class="w-100">
            @csrf
            @method('put')


            {{-- title --}}
            <div class="mb-3">
                <label for="name">Nome attività <span class="asterisco">*</span>

                    {{-- error message --}}
                    @error('name')
                        <span class="text-danger"> {{ $errors->first('name') }} </span>
                    @enderror
                    {{-- /error message --}}

                </label>
                <input class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name"
                    minlength="3" maxlength="20" value="{{ old('name', $restaurant->name) }}" placeholder="es. Bar Portici"
                    required>
            </div>
            {{-- /title --}}


            {{-- address --}}
            <div class="mb-3">
                <label for="address">Indirizzo <span class="asterisco">*</span>

                    {{-- error message --}}
                    @error('address')
                        <span class="text-danger"> {{ $errors->first('address') }} </span>
                    @enderror
                    {{-- /error message --}}

                </label>
                <input class="form-control @error('address') is-invalid @enderror" type="text" id="address"
                    name="address" minlength="3" maxlength="20" value="{{ old('address', $restaurant->address) }}"
                    placeholder="es. Via Ugo Foscolo" required>
            </div>
            {{-- /address --}}


            {{-- description --}}
            <div class="mb-3">
                <label for="description">Descrizione <span class="asterisco">*</span>

                    {{-- error message --}}
                    @error('description')
                        <span class="text-danger"> {{ $errors->first('description') }} </span>
                    @enderror
                    {{-- /error message --}}

                </label>
                <textarea class="form-control @error('description') is-invalid @enderror" minlength="5" maxlength="200"
                    id="description" name="description" required placeholder="es. Situati vicino alle stalle dei cavalli di San Siro">{{ old('description', $restaurant->description) }}</textarea>
            </div>
            {{-- /description --}}


            {{-- Tiypologies --}}
            <span class="label">Tipologie <span class="asterisco">*</span> </span>

            {{-- errors typologies --}}
            @if ($errors->first('tipologies'))
                @error('tipologies')
                    <span class="text-danger"> {{ $errors->first('tipologies') }} </span>
                @enderror
            @else
                <span id="error-message" class="text-danger" style="display:none;">
                    Non puoi inserire piu di 2 tipologie.
                </span>
            @endif
            {{-- errors typologies --}}

            <div class="container mb-4">
                <div class="row" role="group" aria-label="Basic checkbox toggle button group">
                    @foreach ($listTypes as $curType)
                        <div
                            class="col-lg-4 col-md-6 btn-group flex flex-wrap justify-content-center align-items-center mt-3">
                            <input type="checkbox" class="btn-check" id="tech-{{ $curType->id }}" name="tipologies[]"
                                value="{{ $curType->id }}" @checked(in_array($curType->id, old('tipologies', $restaurant->types->pluck('id')->toArray())))>
                            <label class="btn btn-outline-primary"
                                for="tech-{{ $curType->id }}">{{ $curType->name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
            {{-- /Tiypologies --}}


            {{-- input file image --}}
            <div class="mb-3">
                <label for="image"> Immagine <span class="asterisco">*</span></label>
                <span id="errorImage" class="text-danger"></span>
                {{-- <input class="form-control @error('image') is-invalid @enderror" type="file" name="image"
                    id="image"> --}}

                <!-- customize button -->
                <button type="button" class="custom-file-upload btn btn-primary d-block">Scegli file</button>

                <!--  hide Input file -->
                <input class="form-control @error('image') is-invalid @enderror" type="file" name="image"
                    id="image" style="display:none;">

                {{-- error message --}}
                @if (!empty($restaurant->image))
                    @error('image')
                        <span class="text-danger"> {{ $errors->first('image') }} </span>
                    @enderror
                @endif
                {{-- /error message --}}

            </div>
            {{-- /input file image --}}


            {{-- image --}}
            <div class="container-preview m-auto mt-3 square-image-container">
                <div class="mt-2 card-img">
                    {{-- old image --}}
                    @if ($restaurant->image)
                        <img id="oldImg" src="{{ asset('storage/' . $restaurant->image) }}" alt="old-image"
                            class="img-fluid mb-2 square-image square-image-edit-restaurant">
                    @endif
                    {{-- /old image --}}

                    {{-- new image --}}
                    <img id="imagePreview" class="hide square-image" src="" alt="new-image">
                    {{-- /new image --}}

                </div>
                {{-- /image --}}
            </div>

            {{-- btn-remove --}}
            <div class="flex-center mb-2">
                <button id="btnDelete" class="btn btn-danger hide mt-3"
                    onclick="removeImage(event)">Rimuovi</button>
            </div>
            {{-- /btn-remove --}}

            {{-- button submit --}}
            <div class="flex-center">
                <button class="btn btn-success m-0" type="submit">Conferma</button>
            </div>
            {{-- /button submit --}}

        </form>
        {{-- form --}}
        <div class="mt-5">
            <span class="asterisco">*</span>
            <span class="field-required">
                ⁠questi campi sono obbligatori
            </span>
        </div>
    </div>
    {{-- /container  --}}

    <script>
        // VALIDATION IMAGE
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
                const maxSize = 1024 * 1024 * 2; // 2 MB
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

        document.querySelector('#image').addEventListener('change', async function() {
            const file = this.files[0];
            const imgElem = document.getElementById("imagePreview");
            const errImg = document.getElementById("errorImage");
            const removeImg = document.getElementById("btnDelete");

            if (file) {
                const {
                    valid,
                    error
                } = await validateImage(file);
                //if big image o invalid format reset input and hide image
                if (!valid) {
                    imgElem.src = "";
                    imgElem.classList.add('hide');
                    removeImg.classList.add('hide');
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

                    // show button remove image
                    removeImg.classList.remove('hide');
                    errImg.textContent = "";
                }
            } else {
                // hide preview if file dosn't exist
                imgElem.classList.add('hide');
                removeImg.classList.add('hide');
            }
        });

        // hide image to start
        document.addEventListener('DOMContentLoaded', function() {
            const oldImg = document.getElementById("oldImg");
            const imagePreview = document.getElementById("imagePreview");
            const btnDelete = document.getElementById("btnDelete");

            // if (!oldImg || oldImg.src === '') {
            //     imagePreview.classList.add('hide');
            //     btnDelete.classList.add('hide');
            // }
            if (!imagePreview.src) {
                imagePreview.classList.add('hide');
            }

        });
        // /VALIDATION IMAGE



        // INPUT FILE
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
        // /INPUT FILE


    </script>
@endsection
