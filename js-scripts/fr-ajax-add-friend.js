import {AgainRender as AgainRender} from "./fr-ajax-helper.js";
import {UpdateFriend as UpdateFriend} from "./fr-ajax-helper.js";
export function click(id, pos){
    addFriend(id, pos);
}
$(document).ready(function(){
    console.log('Module "add" is start');
});
function addFriend(idFriend, posForm){
    $.ajax({
            method: "POST",
            url: "../friends/add-friend.php",
            data: {id: idFriend},
            })
            .done(function(msg){
                AgainRender(posForm);
                UpdateFriend(posForm);
            })
}