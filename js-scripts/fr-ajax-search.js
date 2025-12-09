export let searchList;
let searchForm;
import { click as clicker } from "./fr-ajax-add-friend.js";
import {clickToDelete as clickdel} from "./fr-ajax-delete.js";
$(document).ready(function(){
    console.log('Module "search" is start');
    searchList = document.getElementById('search-list');
    searchForm = document.querySelector('.search-name');
    $('.go-search').on('click', function(){
        sendMsg();
    });
    searchForm.addEventListener('focus', ()=>{
        document.addEventListener('keydown', (e) => {
            if(e.key == "Enter")
            {
                sendMsg();
            }
        });
    });
    $('.del-friend-button').on('click', function(event){
            clickdel(event.target.value, event.target.name);
            if(event.target.name != "subs")
            {
                if(event.target.classList.contains('notcancel-button')){
                    event.target.classList.replace('notcancel-button', 'cancel-button');
                    event.target.innerText = "Отмена";
                }
                else if(event.target.classList.contains('cancel-button')){
                    event.target.classList.replace('cancel-button', 'notcancel-button');
                    event.target.innerText = "Удалить";
                }
            }
            else{
                if(event.target.classList.contains('notcancel-button')){
                    event.target.classList.replace('notcancel-button', 'cancel-button');
                    event.target.innerText = "Отмена";
                }
                else if(event.target.classList.contains('cancel-button')){
                    event.target.classList.replace('cancel-button', 'notcancel-button');
                    event.target.innerText = "Отклонить";
                }
            }
        });
});

function sendMsg(){
    var nameUs = $('.search-name').val();
        if(nameUs != ''){
            $.ajax({
            method: "POST",
            url: "../friends/search.php",
            data: {name: nameUs},
            })
            .done(function(msg){
                Render(msg);
            })
        }
}

function Render(data){
    if(data != 'No'){
        searchList.innerHTML = data;
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
    }
    else{
        searchList.innerHTML = `<div class="friend">
                        <h1>Ничего не найдено :(</h1>
                    </div>`
    }
}