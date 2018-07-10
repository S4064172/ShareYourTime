"use strict";


/** @description
 *  Questa funzione ci permette
 *  di visualizzare il menu 
 *  nascosto 
 */

 function showMenu(idMenu){
    document.getElementById(idMenu).style.display = "block";
 }

 /** @description
 *  Questa funzione ci permette
 *  di nascondere il menu 
 *  visibile 
 */

function hideMenu(idMenu){
    document.getElementById(idMenu).style.display = "none";
 }