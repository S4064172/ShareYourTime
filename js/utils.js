"use strict";

/*
* Questo file racchiude funzioni e variabili
* generiche che possono essere richiamate
* in diversi contesti
*/

//variabili globali per google maps
var latitude;
var longitude;

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


/***************************/

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}


function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function resizingCarousel() {
	var w = $("#idCarousel").width();
	
	var cookie = getCookie("sizeC");
	
	if(w > 1600){
		if(cookie === "" || cookie !== "3"){
			setCookie("sizeC", "3", 1);
			//document.cookie="size = 3";
			$("#idCarousel").load(location.href + " #idCarousel");
		}
	}else{
		if(w > 800){
			if(cookie === "" || cookie !== "2") {
				setCookie("sizeC", "2", 1);
				//document.cookie="size = 2";
				$("#idCarousel").load(location.href + " #idCarousel");
			}		
		}else{
			if(cookie === "" || cookie !== "1"){
				setCookie("sizeC", "1", 1);
				//document.cookie="size = 1";	
				$("#idCarousel").load(location.href + " #idCarousel");
			}
		}
	}
}
