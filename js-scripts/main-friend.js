let friendBut = document.getElementById('friend-but');
let requestBut = document.getElementById('request-but');
let friendList = document.getElementById('friend-list-container');
let requestList = document.getElementById('request-list-container');
let Pos = "";

let exitButtons = document.querySelectorAll('.exit');
let openButtons = document.querySelectorAll('.h-open');
let search_form = document.getElementById('search-form');
let subscriber_list = document.getElementById('subscriber-list');
let following_list = document.getElementById('following-list');

startPage();
friendBut.addEventListener('click',()=>{
    swapForm("friend");
});
requestBut.addEventListener('click',()=>{
    swapForm("request");
});

exitButtons.forEach((Elem)=>{
    Elem.addEventListener('click',()=>{
        hideForm(Elem.id);
    });
});
openButtons.forEach((Elem)=>{
    Elem.addEventListener('click',()=>{
        hideForm(Elem.id);
    });
});

function startPage(){
    friendList.style.display = "block";
    requestList.style.display = "none";
    friendBut.classList = 'page-header-button-active';
    Pos = "friend";
    hideForm();
}
function swapForm(form){
    switch(form){
        case "friend":
            if(Pos !== "friend"){
                friendList.style.display = "block";
                requestList.style.display = "none";
                friendBut.classList = 'page-header-button-active';
                requestBut.classList = 'page-header-button'; 
                Pos = "friend";
            }
            break;
        case "request":
            if(Pos !== "request"){
                friendList.style.display = "none";
                requestList.style.display = "block";
                friendBut.classList = 'page-header-button';
                requestBut.classList = 'page-header-button-active';
                Pos = "request";
            }
            break;
    }
}
function hideForm(form){
    switch(form){
        case "search_form_exit":
            if(search_form.style.display != 'none'){
                search_form.style.display = 'none';
            }
            else{
                search_form.style.display = 'block';
            }
            break;
        case "subscriber_list_exit":
            if(subscriber_list.style.display != 'none'){
                subscriber_list.style.display = 'none';
            }
            else{
                subscriber_list.style.display = 'block';
            }
            break;
        case "following_list_exit":
            if(following_list.style.display != 'none'){
                following_list.style.display = 'none';
            }
            else{
                following_list.style.display = 'block';
            }
            break;
        case "search-form-open":
            if(search_form.style.display != 'none'){
                search_form.style.display = 'none';
            }
            else{
                search_form.style.display = 'block';
                subscriber_list.style.display = 'none';
                following_list.style.display = 'none';
            }
            break;
        case "subscriber-list-open":
            if(subscriber_list.style.display != 'none'){
                subscriber_list.style.display = 'none';
            }
            else{
                subscriber_list.style.display = 'block';
                search_form.style.display = 'none';
                following_list.style.display = 'none';
            }
            break;
        case "following-list-open":
            if(following_list.style.display != 'none'){
                following_list.style.display = 'none';
            }
            else{
                following_list.style.display = 'block';
                search_form.style.display = 'none';
                subscriber_list.style.display = 'none';
            }
            break;
        default:
            search_form.style.display = 'none';
            subscriber_list.style.display = 'none';
            following_list.style.display = 'none';
            break;
    }
}