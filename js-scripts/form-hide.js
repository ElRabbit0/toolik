let form = document.getElementById('hour-form');
let funcButton = document.getElementById('js-key');
let isShow = true;
hideForm();
funcButton.addEventListener('click', ()=>{
    hideForm();
})

function hideForm(){
    if(isShow){
        form.style.display = 'none';
        isShow = false;
        funcButton.innerHTML = 'Добавить часы';
    }
    else{
        form.style.display = 'flex';
        isShow = true;
        funcButton.innerHTML = 'Я передумал';
    }
}