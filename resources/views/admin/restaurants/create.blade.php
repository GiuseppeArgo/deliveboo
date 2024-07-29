@extends('layouts.admin')

@section('content')
    {{-- container  --}}
    <div class="form-container p-5">

        {{-- title --}}
        <h1 class="text-center">Crea Il tuo ristorante</h1>
        {{-- /title --}}

        {{-- form --}}
        <form action="{{ route('admin.restaurants.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- name --}}
            <div class="mb-3">
                <label for="name" class="form-label">Nome ristorante <span class="asterisco">*</span>

                    {{-- error message --}}
                    @error('name')
                        <span class="text-danger"> {{ $errors->first('name') }} </span>
                    @enderror
                    {{-- /error message --}}

                </label>
                <input value="{{ old('name') }}" type="text" minlength="3" maxlength="20" name="name"
                    class="form-control @error('name') is-invalid @enderror" placeholder="es. Da Mario" id="name"
                    aria-describedby="name_restaurant" required>
            </div>
            {{-- /name --}}


            {{-- address --}}
            <div class="mb-3">
                <label for="address" class="form-label">Indirizzo <span class="asterisco">*</span>

                    {{-- error message --}}
                    @error('address')
                        <span class="text-danger"> {{ $errors->first('address') }} </span>
                    @enderror
                    {{-- /error message --}}

                </label>
                <input value="{{ old('address') }}" type="text" name="address" minlength="3" maxlength="20"
                    class="form-control @error('address') is-invalid @enderror" id="address" aria-describedby="address"
                    required placeholder="es. Via Delle Alpi 15">
            </div>
            {{-- address --}}


            {{-- Description --}}
            <div class="mb-3">
                <label for="description" class="form-label">Descrizione <span class="asterisco">*</span>

                    {{-- error message --}}
                    @error('description')
                        <span class="text-danger"> {{ $errors->first('description') }} </span>
                    @enderror
                    {{-- /error message --}}

                </label>
                <textarea minlength="5" maxlength="200" class="form-control @error('description') is-invalid @enderror"
                    name="description" id="description" rows="3" required
                    placeholder="es. ristorante accogliente in una corte del 700">{{ old('description') }}</textarea>
            </div>
            {{-- Description --}}


            {{-- Typologies --}}
            <span>Tipologie <span class="asterisco">*</span> </span>

            {{-- errors typologies --}}
            @if (!$errors->first('tipologies'))
                <span id="error-message" class="text-danger" style="display:none;">
                    {{-- dynamic message not 0 and not more 2 typologies. --}}
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
                        <div class="col-sm-12 col-md-6 col-lg-4 btn-group flex flex-wrap justify-content-center align-items-center mt-3">
                            <input type="checkbox" class="btn-check" id="tech-{{ $curType->id }}" name="tipologies[]"
                                value="{{ $curType->id }}" @checked(in_array($curType->id, old('tipologies', [])))>
                            <label class="btn btn-outline-primary"
                                for="tech-{{ $curType->id }}">{{ $curType->name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
            {{-- Typologies --}}


            {{-- P.Iva --}}
            <div class="mb-3">
                <label for="p_iva" class="form-label">Partita Iva <span class="asterisco">*</span>

                    {{-- error message --}}
                    @error('p_iva')
                        <span class="text-danger"> {{ $errors->first('p_iva') }} </span>
                    @enderror
                    {{-- /error message --}}

                </label>
                <input value="{{ old('p_iva') }}" type="text" name="p_iva" pattern="^\d{11}$" maxlength="11"
                    placeholder="es. 12345678901 -> 11 numeri" class="form-control @error('p_iva')
is-invalid
@enderror"
                    id="p_iva" aria-describedby="p_iva" required>
            </div>
            {{-- P.Iva --}}


            {{-- input file image --}}
            <div class="mb-3">
                <label for="image" class="form-label">Immagine <span class="asterisco">*</span>

                    {{-- error image --}}
                    @error('image')
                        <span class="text-danger">{{ $errors->first('image') }}</span>
                    @enderror
                    {{-- /error image --}}

                </label>
                <span id="errorImage" class="text-danger"></span>

                <!-- customize button -->
                <button type="button" class="custom-file-upload btn btn-primary d-block">Scegli file</button>

                <!--  hide Input file -->
                <input class="form-control @error('image') is-invalid @enderror" type="file" name="image"
                    id="image" style="display:none;">
            </div>
            {{-- /input file image --}}


            {{-- image --}}
            <div class="container-preview m-auto mt-3 mb-3 square-image-container">
                {{-- img preview --}}
                <div class="mt-2 card-img">
                    <img id="imagePreview" class="hide square-image square-image-edit-restaurant" src="" alt="new-image">
                </div>
                {{-- /img preview --}}

            </div>
            {{-- /image --}}

            {{-- button submit --}}
            <div class="flex-center">
                <button class="btn btn-success m-0" type="submit">Conferma</button>
            </div>
            {{-- /button submit --}}

        </form>
        {{-- /form --}}
        <div class="mt-5">
            <span class="asterisco">*</span> ⁠questi campi sono obbligatori
        </div>
    </div>
    {{-- /container  --}}

    {{-- javascript validation image --}}
    <script>
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
                const maxSize = 1024 * 1024 * 2; // max 2 MB
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
            if (file) {
                const {
                    valid,
                    error
                    //wait return of the function
                } = await validateImage(file);
                const imgElem = document.getElementById("imagePreview");
                const errImg = document.getElementById("errorImage");
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


        // control typologies for create and edit restaurants. max 2 not 0
const checkboxes = document.querySelectorAll('input[type=checkbox][name="tipologies[]"]');
const errorMessage = document.getElementById('error-message');

checkboxes.forEach(function(checkbox) {
    checkbox.addEventListener('click', function(e) {
        var selectedCount = Array.from(document.querySelectorAll('input[name="tipologies[]"]:checked')).length;
        if (selectedCount > 2) {
            e.preventDefault();
            errorMessage.style.display = 'inline-block';
            errorMessage.innerHTML = "puoi selezionare al massimo 2 tipologie";
            Array.from(checkboxes).slice(-1)[0].click();
        }else if(selectedCount === 0) {
            errorMessage.style.display = 'inline-block';
            errorMessage.innerHTML = "devi selezionare almeno una tipologia";
        } else{
            errorMessage.style.display = 'none';
        }

    });
});
// control typologies for create and edit restaurants. max 2 not 0
    </script>
@endsection
