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
const inputElem = document.getElementById('image');

//listen change
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
    console.log("ciao");
    e.preventDefault();
    btnDeleteElem.classList.add('hide');
    imgElem.classList.add('hide');
    oldImgElem.classList.remove('hide');
    inputElem.value="";

});


// typologies max 2
const checkboxes = document.querySelectorAll('input[type=checkbox][name="tipologies[]"]');
const errorMessage = document.getElementById('error-message');
checkboxes.forEach(function(checkbox) {
    checkbox.addEventListener('click', function(e) {
        var selectedCount = Array.from(document.querySelectorAll('input[name="tipologies[]"]:checked')).length;
        if (selectedCount > 2) {
            e.preventDefault(); // Prevent further selection
            errorMessage.style.display = 'inline-block';
            // Deselect the extra checkbox
            Array.from(checkboxes).slice(-1)[0].click();
        }else {
            errorMessage.style.display = 'none'; // Hide the error message if under the limit
        }
    });
});
// typologies max 2


//control password lenght     // non funziona
// document.addEventListener("DOMContentLoaded", function() {
//     const passwordInput = document.getElementById('password');
//     const confirmPasswordInput = document.getElementById('password-confirm');
//     const submitButton = document.querySelector('.btn-register'); // Seleziona il pulsante di invio

//     // Funzione per verificare se le password corrispondono
//     function checkPasswordsMatch() {
//         const password = passwordInput.value;
//         const confirmPassword = confirmPasswordInput.value;

//         if (password !== confirmPassword) {
//             passwordInput.setCustomValidity('Le password non corrispondono.');
//             confirmPasswordInput.setCustomValidity('Le password non corrispondono.');
//         } else {
//             passwordInput.setCustomValidity('');
//             confirmPasswordInput.setCustomValidity('');
//         }
//     }

//     // Aggiungi l'event listener al pulsante di invio
//     submitButton.addEventListener('click', function(event) {
//         event.preventDefault();
//         console.log("submitButton");
//         // Chiama la funzione di verifica delle password
//         checkPasswordsMatch();

//         // Se le password non corrispondono, impedisce l'invio del form
//         if (passwordInput.validity.customError || confirmPasswordInput.validity.customError) {
//             event.preventDefault(); // Impedisce l'invio del form
//         }
//     });
// });
//control password lenght




