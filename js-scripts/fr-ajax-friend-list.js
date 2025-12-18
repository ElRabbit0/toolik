import {clickToDelete as clickdel} from "./fr-ajax-delete.js";
import {kostil as kostil} from "./fr-ajax-edit.js";
$(document).ready(function(){
    console.log('Module "list" is start');
    kostil();
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
        });
});



