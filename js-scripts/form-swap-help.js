let Account = true;
if(JSON.parse(sessionStorage .getItem('Account')) != undefined)
{
Account = JSON.parse(sessionStorage .getItem('Account'));
}


const loginButtom = document.getElementById('log-but');
const createButton = document.getElementById('create-but');
const loginForm = document.getElementById('login');
const createForm = document.getElementById('create');
formSwap(Account);

loginButtom.addEventListener('click', ()=>{
    Account = false;
    formSwap(Account);
    document.getElementById('error-create').innerHTML = '';
});
createButton.addEventListener('click', ()=>{
    Account = true;
    formSwap(Account);
    document.getElementById('error-login').innerHTML = '';
});

function formSwap(hasAccount){
    if(hasAccount){
        loginForm.style.display = 'flex';
        createForm.style.display = 'none';
    }
    else{
        createForm.style.display = 'flex';
        loginForm.style.display = 'none';
    }
    sessionStorage .setItem('Account', JSON.stringify(hasAccount));
}

