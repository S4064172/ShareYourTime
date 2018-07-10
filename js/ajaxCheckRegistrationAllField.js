"use strict";

function getRequest() 
{
	var request = null;
	if (window.XMLHttpRequest) 
		request = new XMLHttpRequest();
	return request;
}

/** @description
*	Questa funzione ci permette di creare 
*	una richiesta in post per controllare
*	i campi che l'utente ha inserito.  
*	Viene utilizzata una chiamata ajax
*	per rimanere nella stessa pagina.
*/
function checkRegistrationAllField(idWait)
{
	waitLoginStart(idWait)
	var request = getRequest();
	request.open("POST", "modalRegistrazione-Login/checkRegistrationAllField.php", true);	
	request.onreadystatechange = validateCheckRegistrationAllField(idWait, request);
	request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	var hmllTagUser = document.getElementById('usernameReg');
    var hmllTagEmail = document.getElementById('emailReg');
    var hmllTagPws = document.getElementById('pswReg');
    var hmllTagPwsConf = document.getElementById('pswRegConf');
  	var hmllTagName = document.getElementById('nameReg');
    var hmllTagSurname = document.getElementById('surnameReg');
    var hmllTagAddress = document.getElementById('addressReg');
	var hmllTagPhone = document.getElementById('telephoneReg');
	var hmllTagPhoto = document.getElementById('photoReg');
   	request.send(	hmllTagUser.name + "=" + hmllTagUser.value+"&"+
                    hmllTagEmail.name+ "=" +hmllTagEmail.value+"&"+
                    hmllTagPws.name+ "=" +hmllTagPws.value+"&"+
                    hmllTagPwsConf.name+ "=" +hmllTagPwsConf.value+"&"+
                    hmllTagName.name+ "=" +hmllTagName.value+"&"+
					hmllTagSurname.name+ "=" +hmllTagSurname.value+"&"+
					hmllTagAddress.name+ "=" +hmllTagAddress.value+"&"+
                    hmllTagPhone.name+ "=" +hmllTagPhone.value+"&"+
					hmllTagPhoto.name+ "=" +hmllTagPhoto.value);
	
}

/** @description
*	Questa callback ci permette di
*	informare l'utente sull'esito
*	dei controlli fatti
*/
function validateCheckRegistrationAllField(idWait, request)
{
	return function(){
		waitLoginEnd(idWait)
		if (request.readyState === 4 && request.status === 200) {
			if (request.responseText != null) {
				var jsonObj = JSON.parse(request.responseText);
				if(jsonObj.length==0){
					window.location.href = 'homepage.php';
					return;
				}
				for(var key in jsonObj){
					var notify = document.getElementById(key);
					notify.style.color = 'darkred';
					notify.innerHTML = jsonObj[key];
				}
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
