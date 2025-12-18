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
        let butSubs;
        subList.innerHTML = data;
        butSubs = subList.querySelectorAll('.add-friend-button');
        butSubs.forEach(button => {
            button.addEventListener('click', function(event) {
                clicker(event.target.value, event.target.name);
            });
        });
        butSubs = subList.querySelectorAll('.del-friend-button');
        butSubs.forEach(button => {
            button.addEventListener('click', function(event) {
                clickdel(event.target.value, event.target.name);
            });
        });
    }
    else{
        subList.innerHTML = `<div class="friend">
                        <h1>Ничего не найдено :(</h1>
                    </div>`
    }
}
