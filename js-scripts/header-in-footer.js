let buttons = document.querySelectorAll('.menu-button');
let number = "-1";
let headerLogo = document.getElementById('header-logo');

if(sessionStorage.getItem("num") != null && sessionStorage.getItem("num") != undefined && sessionStorage.getItem("num")!=NaN)
{
    number = sessionStorage.getItem("num");
}
number = Number(number);


for(let i = 0; i < buttons.length; i++){
    buttons[i].addEventListener('click', ()=>{selecter(buttons[i], i)});
}

window.onload = ()=>{
    if(number != -1)
    {
        selecter(buttons[number], number);
    }
}



function selecter(ThisButton, num){
    for(let i = 0; i < buttons.length; i++){
        buttons[i].classList= 'menu-button';
    }
    ThisButton.classList += ' menu-button-selected';
    num = num.toString();
    sessionStorage.setItem("num", num);
}

headerLogo.addEventListener('click', ()=>{
    for(let i = 0; i < buttons.length; i++){
        buttons[i].classList= 'menu-button';
    }
    sessionStorage.removeItem("num");
})
window.addEventListener('beforeunload', ()=>{
    for(let i = 0; i < buttons.length; i++){
        buttons[i].classList= 'menu-button';
    }
    sessionStorage.removeItem("num");
})