"use strict";

function getRequest() 
{
	var request = null;
	if (window.XMLHttpRequest) 
		request = new XMLHttpRequest();
	return request;
}

/*
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
	var hmllTagUser = document.getElementById(idUser);
    var hmllTagPws = document.getElementById(IdPws);
    request.send(   hmllTagUser.name + "=" + hmllTagUser.value+"&"+
                    hmllTagPws.name+ "=" +hmllTagPws.value);
	
}

/*
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

