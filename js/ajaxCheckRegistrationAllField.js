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
	
    var formData = new FormData();

	var htmlTagUser = document.getElementById('usernameReg');
    var htmlTagEmail = document.getElementById('emailReg');
    var htmlTagPsw = document.getElementById('pswReg');
    var htmlTagPswConf = document.getElementById('pswRegConf');
  	var htmlTagName = document.getElementById('nameReg');
    var htmlTagSurname = document.getElementById('surnameReg');
    var htmlTagAddress = document.getElementById('addressReg');
	var htmlTagPhone = document.getElementById('telephoneReg');
	var htmlTagPhoto = document.getElementById('photoReg');
    
	formData.append(htmlTagPhoto.name, htmlTagPhoto.files[0]);
	formData.append(htmlTagUser.name, htmlTagUser.value);
    formData.append(htmlTagEmail.name, htmlTagEmail.value);
    formData.append(htmlTagPsw.name, htmlTagPsw.value);
    formData.append(htmlTagPswConf.name, htmlTagPswConf.value);
    formData.append(htmlTagName.name, htmlTagName.value);
    formData.append(htmlTagSurname.name, htmlTagSurname.value);
    formData.append(htmlTagAddress.name, htmlTagAddress.value);
    formData.append(htmlTagPhone.name, htmlTagPhone.value);

	request.send(formData);
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
				console.log(request.responseText);
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
