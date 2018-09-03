"use strict";



/** @description
*	Questa funzione ci permette di creare 
*	una richiesta in post per controllare
*	i campi che l'utente ha inserito durante
*	la fase di login.  
*	Viene utilizzata una chiamata ajax
*	per rimanere nella stessa pagina
*	in caso di errore
*/

function checkLoginAllField(idUser,IdPws,IdErrLog,idWait)
{
	showItem(idWait);
	var request = getRequest();
	request.open("POST", "../utils/checkLoginUser.php", true);	
	request.onreadystatechange = validateCheckLoginAllField(IdErrLog, idWait, request);
	
	var formData = new FormData();
	var htmlTagUser = document.getElementById(idUser);
	var htmlTagPws = document.getElementById(IdPws);
	
	formData.append(htmlTagUser.name, htmlTagUser.value);
	formData.append(htmlTagPws.name, htmlTagPws.value)
    request.send(formData);
	
}

/** @description
*	Questa callback ci permette di
*	informare l'utente sull'esito
*	dei controlli fatti
*/

function validateCheckLoginAllField(idErrField, idWait, request)
{
	return function(){
		hideItem(idWait);
		if (request.readyState === 4 && request.status === 200) {
			if (request.responseText != null) {
				
				var jsonObj = JSON.parse(request.responseText);
				var notify = document.getElementById(idErrField);
				if (jsonObj['code'] === -1) {
					notify.style.fontSize = '1.4em';
					notify.style.color = 'red';
					notify.innerHTML = jsonObj['msg'];
					return
				}				
				window.location.href = '../homepage/homepage.php';
				
			}
		}
	}
}

/** @description
 * Questa funzione effettua un click se l'utente preme ENTER
 * sul pulsante per effettuare il login
 */

function handleKey(e) {
	if (e.keyCode === 13 || e.keyCode === 14)
		document.getElementById('logBtn').click();
}
