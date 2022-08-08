'use strict';

const form = document.querySelector('#addPunch');
const btnSubmit = document.querySelector('#submit');
const btnCancel = document.querySelector('#cancel');
const fieldAdd = form.querySelectorAll('.field-add');

form.reset();

fieldAdd.forEach(element => {
    element.addEventListener('click', () => {
        let newInput = element.parentNode.children[1].cloneNode();
        element.parentNode.insertBefore(newInput,element);
        newInput.value = '';
    });
});
