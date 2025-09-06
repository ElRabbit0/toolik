if(window.screen.width <= 786)
{
    create();
}
window.addEventListener('resize', (e) => {
    if(window.screen.width <= 786)
    {
        create();
    }
});

function create(){
    let menuButton = document.getElementById('header-button');
    let menu = document.getElementById('header-menu');
    let isOpen = true;
    openMenu();
    menuButton.addEventListener('click', ()=>{ openMenu() });
    function openMenu(){
        if(isOpen){
            menuButton.innerHTML = '&#709;';
            menu.style.display = 'none';
            isOpen = false;
        }
        else{
            menuButton.innerHTML = '&times;';
            menu.style.display = 'block';
            isOpen = true;
        }
    }
}

