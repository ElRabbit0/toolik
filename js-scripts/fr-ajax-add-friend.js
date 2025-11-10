export function click(id){
    addFriend(id);
}
$(document).ready(function(){
    console.log('Module "add" is start');
});
function addFriend(idFriend){
    $.ajax({
            method: "POST",
            url: "../friends/add-friend.php",
            data: {id: idFriend},
            })
}