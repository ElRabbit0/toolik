import { click as clicker } from "./fr-ajax-add-friend.js";
import {clickToDelete as clickdel} from "./fr-ajax-delete.js";
let folList;
$(document).ready(function(){
    console.log('Module "follow" is start');
    folList = document.getElementById('following-list-div');
    sendMsg();
});

function sendMsg(){
    $.ajax({
        method: "POST",
        url: "../friends/render-fol.php",
        })
            .done(function(msg){
                Render(msg);
            })
}

function Render(data){
    if(data != 'No'){
        let butFol;
        folList.innerHTML = data;
        butFol = folList.querySelectorAll('.del-friend-button');
        butFol.forEach(button => {
            button.addEventListener('click', function(event) {
                clickdel(event.target.value, event.target.name);
                if(event.target.classList.contains('notcancel-button')){
                    event.target.classList.replace('notcancel-button', 'cancel-button');
                    event.target.innerText = "Отмена";
                }
                else if(event.target.classList.contains('cancel-button')){
                    event.target.classList.replace('cancel-button', 'notcancel-button');
                    event.target.innerText = "Отписаться";
                }
            });
        });
    }
    else{
        folList.innerHTML = `<div class="friend">
                        <h1>Ничего не найдено :(</h1>
                    </div>`
    }
}
