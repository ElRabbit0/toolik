import {AgainRender as AgainRender} from "./fr-ajax-helper.js";
export function clickToDelete(id, pos){
    DeletFriend(id, pos);
}
$(document).ready(function(){
    console.log('Module "delete" is start');
});
function DeletFriend(idFriend, posForm){
    $.ajax({
            method: "POST",
            url: "../friends/del-friend.php",
            data: {id: idFriend,position: posForm},
            })
            .done(function(msg){
                AgainRender(posForm);
            })
}