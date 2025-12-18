console.log("Helper is Ready!");
import {clickToDelete as clickdel} from "./fr-ajax-delete.js";
export function AgainRender(position){
    switch(position){
        case 'subs':
            $.ajax({
            method: "POST",
            url: "../friends/render-sub.php"
            })
            .done(function(msg){
                let subList = document.getElementById('subscriber-list-div');
                if(msg != 'No')
                {
                    subList.innerHTML = msg;
                }
                else{
                    subList.innerHTML = `<div class="friend">
                        <h1>Ничего не найдено :(</h1>
                    </div>`
                }
                let butSubs = subList.querySelectorAll('.del-friend-button');
                butSubs.forEach(button => {
                    button.addEventListener('click', function(event) {
                        clickdel(event.target.value, event.target.name);
                    });
                });
                butSubs = subList.querySelectorAll('.add-friend-button');
                butSubs.forEach(button => {
                    button.addEventListener('click', function(event) {
                        clicker(event.target.value);
                    });
                });
            });
        break;
        case 'fol':
            $.ajax({
            method: "POST",
            url: "../friends/render-fol.php"
            })
            .done(function(msg){
                let folList = document.getElementById('following-list-div');
                if(msg != 'No')
                {
                    folList.innerHTML = msg;
                }
                else{
                    folList.innerHTML = `<div class="friend">
                        <h1>Ничего не найдено :(</h1>
                    </div>`
                }
                let butfol = folList.querySelectorAll('.del-friend-button');
                butfol.forEach(button => {
                    button.addEventListener('click', function(event) {
                        clickdel(event.target.value, event.target.name);
                    });
                });
                butfol = folList.querySelectorAll('.add-friend-button');
                butfol.forEach(button => {
                    button.addEventListener('click', function(event) {
                        clicker(event.target.value);
                    });
                });
            });
        break;
    }
}
export function UpdateFriend(position){
    if(position == 'subs')
    {
        $.ajax({
        method: "POST",
        url: "../friends/render-my-friend.php"
    })
    .done(function(msg){
        const friendList = document.getElementById('friend-list');
        friendList.innerHTML = msg;
        let buts = friendList.querySelectorAll('.del-friend-button');
                buts.forEach(button => {
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
    });
    }
}