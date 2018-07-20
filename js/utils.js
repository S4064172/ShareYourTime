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
	*	di "ripulire" il tag html
	*	utilizzato per mostrare
	* 	l'errore
	*/

	function cleanErr(id){
		var notify = document.getElementById(id);
		notify.innerHTML = "";
	}


	/** @param 	idField  campo da analizzare
	 * 	@param	idErrField campo per notifica errore
	 * 	@param  registrationOrModified 0 registrazione 1 modifica
	 *  @param 	checkField 	se registrazione utilizzato per confronto pws
	 * 						se modifica utilizzato per confronto campi per disponibilità
	 * 								 
	 *  @description
	*	Questa funzione ci permette di creare 
	*	una richiesta in post per controllare
	*	ogni singolo campo che l'utente ha inserito. 
	*	sia in fase di registrazione che modifica 
	*/

	function checkGenericSingleField(idField,idErrField,registrationOrModified,checkField)
	{
		var request = getRequest();
		request.open("POST", "../utils/checkGenericSingleField.php", true);	
		request.onreadystatechange = validateCheckGenericSingleField(idErrField, request);	
		var formData = new FormData();
		var htmlTag = document.getElementById(idField);
		
		if(	idField==null || idErrField==null || registrationOrModified==null || 
			(registrationOrModified!==1 && registrationOrModified!==0)) {
			console.log("Parametro non valido");
			return;
		}
		
		// non devo confrontare il campo inserito con un altro campo
		if(checkField == null)
			formData.append(htmlTag.name,htmlTag.value);
		else{
			//se sto modficando il profilo
			if (registrationOrModified === 1 ){
				// e devo mandare una foto
				if(htmlTag.name === 'photo')
					formData.append(htmlTag.name,htmlTag.files[0]);
				else
					formData.append(htmlTag.name,htmlTag.value);
				
				//campo per il confronto, nel caso della foto
				//utilizzato per constuire il path
				formData.append('oldField',checkField);
			}else{
				//sto registrando un profilo
				//checkField per controllo pws
				var htmlTag1 = document.getElementById(checkField);
				if(htmlTag1.name!=='psw' || htmlTag.name!=='pswConf'){
					console.log("Parametro non valido");
					return;
				}
				formData.append(htmlTag.name,htmlTag.value);
				formData.append(htmlTag1.name,htmlTag1.value);
			}
			
		}
		formData.append("registration",registrationOrModified);
		request.send(formData);
	}

	/**	@description
	*	Questa callback ci permette di
	*	informare l'utente sull'esito
	*	dei controlli ffatti sia in fase di 
	*	registrazione che modifica
	*/

	function validateCheckGenericSingleField(idErrField, request)
	{
		return function(){
			if (request.readyState === 4 && request.status === 200) {
				if (request.responseText != null) {
					var jsonObj = JSON.parse(request.responseText);

					//stampa dell'errore sul campo
					if (jsonObj['code'] === -1) {
						var notify = document.getElementById(idErrField);
						notify.style.fontSize = '0.9em';
						notify.style.color = 'darkred';
						notify.innerHTML = jsonObj['msg'];
					}else
						//aggiornamento foto
						if(jsonObj['code'] === 1)							
							refreshImg(jsonObj['msg']+'?'+new Date().getTime());
				}
			}
		}
	}


	/** @description
	*	Questa callback ci permette di
	*	informare l'utente sull'esito
	*	dei controlli fatti sia in fase di 
	*	registrazione che modifica
	*/
	function validateCheckGenericAllField(idWait, request)
	{
		return function(){
			hideItem(idWait)
			if (request.readyState === 4 && request.status === 200) {
				if (request.responseText != null) {
					var jsonObj = JSON.parse(request.responseText);
					
					// mi sono registrato con successo
					// mi sposto nella home page
					if(jsonObj == 0){
						window.location.href = '../homepage/homepage.php';
						return;
					}

					// ho modificato i campi del profilo con
					// successo torno sulla modifica del profilo
					if( jsonObj == 1 ){
						disableChanges();
						window.location.href = '../viewProfile/viewProfile.php';
						return;
					}
			
					//stampa degli errori rilevati
					for(var key in jsonObj){
						var notify = document.getElementById(key);
						notify.style.fontSize = '0.9em';
						notify.style.color = 'darkred';
						notify.innerHTML = jsonObj[key];		
					}
					
				}
			}
		}
	}


	function checkMatchRegex(inputSent, regexToMatch) 
	{
		return regexToMatch.test(inputSent);
	}

	function checkMin(num, min) {
		return num > min;
	}

	function checkMinLength(string, min) {
		return string.length >= min;
	}

	function checkMaxLength(string, max) {
		return string.length <= max;
	}

	function notValidString(string, regex, minLen, maxLen) {
		return !checkMinLength(string, minLen) ||
			   !checkMaxLength(string, maxLen) ||
			   !checkMatchRegex(string, regex);
	}