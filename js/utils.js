"use strict";

/*
* Questo file racchiude funzioni
* generiche che possono essere richiamate
* in diversi contesti
*/

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

function showItem(idItem)
{
	document.getElementById(idItem).style.display = "block"; 
}

/** @description
*	Questa funzione mi permette di 
*	nascondere item visibili
*/

function hideItem(idItem)
{
	document.getElementById(idItem).style.display = "none"; 
}


/** @description
*	Questa funzione ci permette
*	di "ripulire" il tag html
*	utilizzato per mostrare
* 	l'errore
*/

function cleanErr(id)
{
	var notify = document.getElementById(id);
	notify.innerHTML = "";
}

function checkMatchRegex(inputSent, regexToMatch) 
{
	return regexToMatch.test(inputSent);
}

function checkMin(num, min) 
{
	return num > min;
}

function checkMinLength(string, min) 
{
	return string.length >= min;
}

function checkMaxLength(string, max) 
{
	return string.length <= max;
}

function notValidString(string, regex, minLen, maxLen) 
{
	return !checkMinLength(string, minLen) ||
			!checkMaxLength(string, maxLen) ||
			!checkMatchRegex(string, regex);
}
