"use strict";

/*
    questo file contiene tutte 
    le funzioni js utilizzate per
    gestire la navBar
*/




/** @description
*   Questa funzione ci permette di 
*   chiudere manualmente il 
*   "collapse" utilizzato per la 
*   navBar
*/

function myCollapseHide() 
{
    $(".collapse").collapse('hide');
}

/** @description
*   Questa funzione ci permette di 
*   nascondere o mostrare
*   manualmente il menu
*/

function showOrHideMenu(idMenu)
{
    var htmlMenu = document.getElementById(idMenu);
    if(htmlMenu.style.display === "block")
        hideItem(idMenu);
    else
        showItem(idMenu);
}