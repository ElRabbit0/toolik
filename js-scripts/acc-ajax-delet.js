import {clickToDelete as clickdel} from "./fr-ajax-delete.js";
import {kostil as kostil} from "./acc-ajax-edit.js";
export function allRender(data){
    Render(data);
}
let frList;
$(document).ready(function(){
    console.log('Module "friend list" is start');
    frList = document.querySelector('.friend-div');
    sendMsg();
});

function sendMsg(){
    $.ajax({
        method: "POST",
        url: "../pages/account-render-friend.php",
        })
            .done(function(msg){
                Render(msg);
                kostil();
            })
}

function Render(data){
    let frSubs;
        frList.innerHTML = `<h1>Ваши друзья</h1>`;
        frList.innerHTML += data;
        frList.innerHTML += `<div class="more-button">
                <button class="func-button black-button"
                    onclick="window.location.href='../friends/main.php'">Больше</button>
            </div>`;
        frSubs = frList.querySelectorAll('.del-friend-button');
        frSubs.forEach(button => {
            button.addEventListener('click', function(event) {
                clickdel(event.target.value, event.target.name);
                if(event.target.classList.contains('notcancel-button')){
                    event.target.classList.replace('notcancel-button', 'cancel-button');
                    event.target.innerText = "Отмена";
                }
                else if(event.target.classList.contains('cancel-button')){
                    event.target.classList.replace('cancel-button', 'notcancel-button');
                    event.target.innerText = "Удалить";
                }
            });
        });
}
