export function kostil(){
  $(document).ready(function(){
      console.log('Module "edit" is start');
      const friendDiv = document.querySelector('.friend-div');
      let friendButtonsEdit = document.querySelectorAll('.edit-button');
      friendButtonsEdit.forEach(button => {
        button.addEventListener('click', function(event) {
          editFrienStatus(event.target.value, event.target.name, event.target);
        });
      });
  });
  

  function editFrienStatus(idFriend, statusFriend, button){
      const editForm = document.createElement('div');
      editForm.classList.add("edit-form");
      editForm.value = idFriend;

      const selectStatus = document.createElement('select');
      selectStatus.id = idFriend;
      const listOptions = ["friend", "bestfriend", "partner"];
      const listText = ["Друг", "Лучший друг", "Партнёр"];

    for (let i = 0; i < listOptions.length; i++) {
      const option = document.createElement("option");
      option.value = listOptions[i];
      option.text = listText[i];
      selectStatus.add(option);
    }
    selectStatus.selectedOptions.innerText = event.target.name;
    const saveButton = document.createElement('button');
    saveButton.innerText = "Сохранить";
    saveButton.classList.add("func-button");
    saveButton.classList.add("black-button");
    saveButton.classList.add("save-button");
    editForm.appendChild(selectStatus);
    editForm.appendChild(saveButton);
    button.replaceWith(editForm);
    let oldButton = button;
    button = editForm;
    saveButton.addEventListener('click',function(event) {
      saveStatus(idFriend, statusFriend, button, oldButton);
    });
    
  }

  function saveStatus(idFriend, statusFriend, editForm, oldButton){
    const inputStatus = document.getElementById(`${idFriend}`).value;
    if(statusFriend != inputStatus){
      $.ajax({
        method: "POST",
        url: "../friends/friend-status.php",
        data: {id: idFriend, status: inputStatus}
      })
      .done(function(msg){
        if(msg == "All Good")
        {
          oldButton.name = inputStatus;
          $.ajax({
                  method: "POST",
                  url: "../pages/account-render-friend.php",
                  })
                      .done(function(msg){
                        allRender(msg);
                        let friendButtonsEdit = document.querySelectorAll('.edit-button');
                        friendButtonsEdit.forEach(button => {
                          button.addEventListener('click', function(event) {
                            editFrienStatus(event.target.value, event.target.name, event.target);
                          });
                        });
                      })
        }
        else{
          editForm.replaceWith(oldButton);
        }
      })
    }
    else{
      editForm.replaceWith(oldButton);
    }
  }
}
import {allRender as allRender} from "./acc-ajax-delet.js";