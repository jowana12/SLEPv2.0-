var submit =document.querySelector('.btn-submit');
var model_bg =document.querySelector('.modal-bg');
var model_close = document.querySelector('.btn-modal-cancel');

submit.addEventListener('click', function(){
    model_bg.classList.add('bg-active');

});

model_close.addEventListener('click', function(){
    model_bg.classList.remove('bg-active');

});