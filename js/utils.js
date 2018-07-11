"use strict";

function getRequest() 
{
	var request = null;
	if (window.XMLHttpRequest) 
		request = new XMLHttpRequest();
	return request;
}

/*
*	Queste due funzioni ci permettono di
*	"boccare" temporaneamente l'input 
*	dell'utente in modo che non cambi 
*	valori durante i controlli
*/

function waitLoginStart(idWait){
	document.getElementById(idWait).style.display = "inline";
}

function waitLoginEnd(idWait){
	document.getElementById(idWait).style.display = "none";
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