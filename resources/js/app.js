import "./bootstrap";
import "~resources/scss/app.scss";
import.meta.glob(["../img/**"]);
import * as bootstrap from "bootstrap";

// section preview image new old and button
const oldImgElem = document.getElementById('oldImg')
const imgElem = document.getElementById('imagePreview');
const btnDeleteElem = document.getElementById('btnDelete');
const inputElem = document.getElementById('image');

if(inputElem){
    inputElem.addEventListener('change', function(e) {

        const reader = new FileReader();

        reader.onload = function() {

            imgElem.src = reader.result;

            imgElem.classList.remove('hide');
            btnDeleteElem.classList.remove('hide');
            oldImgElem.classList.add('hide');
        };

        reader.readAsDataURL(e.target.files[0]);
    });
}

// btn remove
btnDeleteElem.addEventListener('click', function(e){
    e.preventDefault();
    btnDeleteElem.classList.add('hide');
    imgElem.classList.add('hide');
    oldImgElem.classList.remove('hide');
    inputElem.value="";
});
// / btn remove

// /section preview image new old and button


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


// modal soft deletes pronto
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
//modal soft deletes pronto










