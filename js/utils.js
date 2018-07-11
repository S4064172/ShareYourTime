"use strict";

function getRequest() 
{
	var request = null;
	if (window.XMLHttpRequest) 
		request = new XMLHttpRequest();
	return request;
}

/** @description
*	Questa funzione mi permette di 
*	mostrare item nascosti
*/

function showItem(idItem){
	document.getElementById(idItem).style.visibility = "visible"; 
}

/** @description
*	Questa funzione mi permette di 
*	nascondere item visibili
*/

function hideItem(idItem){
	document.getElementById(idItem).style.visibility = "hidden"; 
}

/*
*	Questa funzione ci permette
*	di "ripulire" il taghtml
*	utilizzato per mostrare
* 	l'errore
*/
function cleanErr(id){
	var notify = document.getElementById(id);
	notify.innerHTML = "";
}