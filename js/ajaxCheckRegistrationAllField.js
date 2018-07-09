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
*	per rimanere nella stessa pagina.
*/
function checkRegistrationAllField()
{
	var request = getRequest();
	request.open("POST", "modalRegistrazione-Login/checkRegistrationAllField.php", true);	
	request.onreadystatechange = validateCheckRegistrationAllField(request);
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

/*
*	Questa callback ci permette di
*	informare l'utente sull'esito
*	dei controlli fatti
*/
function validateCheckRegistrationAllField(request)
{
	return function(){
		if (request.readyState === 4 && request.status === 200) {
			if (request.responseText != null) {
				console.log(request.responseText);
				var jsonObj = JSON.parse(request.responseText);
				
				for(var key in jsonObj){
					console.log(key);
					var notify = document.getElementById(key);
					notify.style.color = 'darkred';
					notify.innerHTML = jsonObj[key];
				}
			}
		}
	}
}


