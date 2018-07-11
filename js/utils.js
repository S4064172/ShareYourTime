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

function showItem(idItem){
	document.getElementById(idItem).style.display = "block"; 
}

/** @description
*	Questa funzione mi permette di 
*	nascondere item visibili
*/

function hideItem(idItem){
	document.getElementById(idItem).style.display = "none"; 
}

/** @description
*	Questa funzione ci permette
*	di "ripulire" il taghtml
*	utilizzato per mostrare
* 	l'errore
*/

function cleanErr(id){
	var notify = document.getElementById(id);
	notify.innerHTML = "";
}


/** @description
*	Questa funzione ci permette di creare 
*	una richiesta in post per controllare
*	ogni singolo campo che l'utente ha inserito.  
*/

function checkGenericSingleField(idField,idErrField,checkField)
{
	var request = getRequest();
	request.open("POST", "utils/checkGenericSingleField.php", true);	
	request.onreadystatechange = validateCheckGenericSingleField(idErrField, request);
	request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	var htmlTag = document.getElementById(idField);
	if(checkField==null)
		request.send(htmlTag.name + "=" + htmlTag.value);
	else{
		var htmlTag1 = document.getElementById(checkField);

		request.send(htmlTag.name + "=" + htmlTag.value + '&_' + 
						htmlTag1.name+"=" + htmlTag1.value);
	}
}

/** @description
*	Questa callback ci permette di
*	informare l'utente sull'esito
*	dei controlli fatti
*/

function validateCheckGenericSingleField(idErrField, request)
{
	return function(){
		if (request.readyState === 4 && request.status === 200) {
			if (request.responseText != null) {
				var jsonObj = JSON.parse(request.responseText);
				var notify = document.getElementById(idErrField);
				notify.style.fontSize = '0.9em';
				if (jsonObj['code'] === -1) {
					notify.style.color = 'darkred';
					notify.innerHTML = jsonObj['msg'];
				} else {
					if(jsonObj['code'] === 0){
						notify.style.color = 'green';
					}else{
						return;
					}
						
				}
				
			}
		}
	}
}

