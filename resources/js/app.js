import "./bootstrap";
import "~resources/scss/app.scss";
import.meta.glob(["../img/**"]);
import * as bootstrap from "bootstrap";


// section modal for softDeletes

const deleteBtns = document.querySelectorAll('.delete button');

if(deleteBtns.length>0){

    deleteBtns.forEach((btn) => {

        btn.addEventListener('click', function (e){

            e.preventDefault();
                const title = btn.dataset.title;

            document.getElementById('message').innerHTML = `stai per cancellare<br> <strong>${title}</strong>,<br> ne sei sicuro?`;

            const modal = new bootstrap.Modal(document.getElementById('delete-modal'));

            document.getElementById("modal-delete-btn")

                .addEventListener("click", function () {
                    btn.parentElement.submit();
                });

             modal.show();
        });
});
}


// section preview image

// mi collego a degli elemnti in pagina
const oldImgElem = document.getElementById('oldImg')
const imgElem = document.getElementById('imagePreview');
const btnDeleteElem = document.getElementById('btnDelete');
const inputElem = document.getElementById('cover_image');

//listen change
function pippo(){
    console.log("ciao");
}
if(inputElem){
    inputElem.addEventListener('change', function(e) {
        // Istanzia nuovo oggetto FileReader (è un API che ha dei metodi per leggere il contenuto dei file).
        const reader = new FileReader();

        // Usa la funzione callback per leggere l'input
        reader.onload = function() {
            // Imposta il valore del reader nella src dell'tag img
            imgElem.src = reader.result;
            // Rimuove e aggiunge la classe "hide" (bottoni rimuovere, anteprima immagine, vecchia anteprima immagine)
            imgElem.classList.remove('hide');
            btnDeleteElem.classList.remove('hide');
            oldImgElem.classList.add('hide');
        };

        // Converte la stringa in URL per la directory dell'immagine
        reader.readAsDataURL(e.target.files[0]);
    });
}

// remove btn to reset input value and add class hide
btnDeleteElem.addEventListener('click', function(e){
    e.preventDefault();
    btnDeleteElem.classList.add('hide');
    imgElem.classList.add('hide');
    oldImgElem.classList.remove('hide');
    inputElem.value = "";
});


