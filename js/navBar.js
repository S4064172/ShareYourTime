"use strict";

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
    console.log(htmlMenu.style.visibility);
    if(htmlMenu.style.visibility === "visible")
        hideItem(idMenu);
    else
        showItem(idMenu);
}