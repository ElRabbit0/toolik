let iconButton = document.getElementById('icon-button');
let iconButtonIsClick = true;
let iconForm = document.getElementById('icon-form');
let inputFile = document.getElementById('input__file');
iconButtonIsClick = Edit(iconButtonIsClick, iconForm, iconButton, "Изменить");
iconButton.addEventListener('click', ()=>{
    iconButtonIsClick = Edit(iconButtonIsClick, iconForm, iconButton, "Изменить");
});
inputFile.addEventListener('change', (event)=>{
    console.log(inputFile.value);
    const file = event.target.files[0];
    document.getElementById('inp').innerHTML = `${file.name}`; 
});

let nameButton = document.getElementById('name-button');
let nameButtonIsClick = true;
let nicknameForm = document.getElementById('nickname-form');
nameButtonIsClick = Edit(nameButtonIsClick, nicknameForm, nameButton, "Изменить");
nameButton.addEventListener('click', ()=>{
    nameButtonIsClick = Edit(nameButtonIsClick, nicknameForm, nameButton, "Изменить");
});

let editPassButton = document.getElementById('edit-pass-button');
let editPassButtonIsClick = true;
let passwordForm = document.getElementById('password-form');
editPassButtonIsClick = Edit(editPassButtonIsClick, passwordForm, editPassButton, "Сменить пароль");
editPassButton.addEventListener('click', ()=>{
    editPassButtonIsClick = Edit(editPassButtonIsClick, passwordForm, editPassButton, "Сменить пароль");
});



function Edit(isClick, Form, Button, Text){
    if(isClick){
        isClick = false;
        Form.style.display = 'none';
        Button.innerHTML = `${Text}`;
    }
    else{
        isClick = true;
        Form.style.display = 'flex';
        Button.innerHTML = 'Отмена';
    }
    return isClick;
}
