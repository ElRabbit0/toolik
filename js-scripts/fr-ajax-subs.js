import { click as clicker } from "./fr-ajax-add-friend.js";
import {clickToDelete as clickdel} from "./fr-ajax-delete.js";
let subList;
$(document).ready(function(){
    console.log('Module "subs" is start');
    subList = document.getElementById('subscriber-list-div');
    sendMsg();
});

function sendMsg(){
    $.ajax({
        method: "POST",
        url: "../friends/render-sub.php",
        })
            .done(function(msg){
                Render(msg);
            })
}

function Render(data){
    if(data != 'No'){
        subList.innerHTML = data;
        $('.add-friend-button').on('click', function(event){
            clicker(event.target.value);
            if(event.target.classList.contains('notcancel-button')){
                event.target.classList.replace('notcancel-button', 'cancel-button');
                event.target.innerText = "Отмена";
            }
            else if(event.target.classList.contains('cancel-button')){
                event.target.classList.replace('cancel-button', 'notcancel-button');
                event.target.innerText = "Добавить";
            }
        });
        $('.del-friend-button').on('click', function(event){
            clickdel(event.target.value, event.target.name);
            if(event.target.classList.contains('notcancel-button')){
                event.target.classList.replace('notcancel-button', 'cancel-button');
                event.target.innerText = "Отмена";
            }
            else if(event.target.classList.contains('cancel-button')){
                event.target.classList.replace('cancel-button', 'notcancel-button');
                event.target.innerText = "Отклонить";
            }
        });
    }
    else{
        subList.innerHTML = `<div class="friend">
                        <h1>Ничего не найдено :(</h1>
                    </div>`
    }
}
