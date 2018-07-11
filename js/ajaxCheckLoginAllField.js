"use strict";


/** @description
*	Questa funzione ci permette di creare 
*	una richiesta in post per controllare
*	i campi che l'utente ha inserito.  
*	Viene utilizzata una chiamata ajax
*	per rimanere nella stessa pagina
*/
function checkLoginAllField(idUser,IdPws,IdErrLog,idWait)
{
	waitLoginStart(idWait);
	var request = getRequest();
	request.open("POST", "modalRegistrazione-Login/checkLoginAllField.php", true);	
	request.onreadystatechange = validateCheckLoginAllField(IdErrLog, idWait, request);
	request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	var htmlTagUser = document.getElementById(idUser);
    var htmlTagPws = document.getElementById(IdPws);
    request.send(   htmlTagUser.name + "=" + htmlTagUser.value+"&"+
                    htmlTagPws.name+ "=" +htmlTagPws.value);
	
}

/** @description
*	Questa callback ci permette di
*	informare l'utente sull'esito
*	dei controlli fatti
*/

function validateCheckLoginAllField(idErrField, idWait, request)
{
	return function(){
		waitLoginEnd(idWait);
		if (request.readyState === 4 && request.status === 200) {
			if (request.responseText != null) {
				var jsonObj = JSON.parse(request.responseText);
				var notify = document.getElementById(idErrField);
				notify.style.fontSize = '0.9em';
				if (jsonObj['code'] === -1) {
					notify.style.color = 'darkred';
					notify.innerHTML = jsonObj['msg'];
					return
				}				
				window.location.href = 'homepage.php';
				
			}
		}
	}
}



