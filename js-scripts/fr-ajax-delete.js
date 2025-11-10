export function clickToDelete(id){
    DeletFriend(id);
}
$(document).ready(function(){
    console.log('Module "delete" is start');
});
function DeletFriend(idFriend){
    $.ajax({
            method: "POST",
            url: "../friends/del-friend.php",
            data: {id: idFriend},
            })
            .done(function(msg){
                console.log(msg);
            })
}