const imgDiv = document.querySelector('.profile-pic-div');
const img = document.getElementById('photo');
const file = document.getElementById('file');
const upload = document.getElementById('uploadBtn');
const prof = document.getElementById('prof');

var model_bg = document.querySelector('.modal-bg');
var model_close = document.querySelector('.btn-modal-cancel');

upload.addEventListener('click', function(){
     model_bg.classList.add('bg-active');
});

model_close.addEventListener('click', function(){
     model_bg.classList.remove('bg-active');
});

imgDiv.addEventListener('mouseenter', function()
{
    upload.style.display = "block";
});

imgDiv.addEventListener('mouseleave', function()
{
    upload.style.display = "none";
});

file.addEventListener('change', function(){
    const choosedFile = this.files[0];

    if(choosedFile){
        const reader = new FileReader();

        reader.addEventListener('load', function(){
            prof.setAttribute('src', reader.result);
        });

        reader.readAsDataURL(choosedFile);
    }
})