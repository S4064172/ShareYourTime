"use strict";

//var request = null;

function getRequest() 
{
	var request = null;
	if (window.XMLHttpRequest) 
		request = new XMLHttpRequest();
	return request;
}

function checkLogin(idUser,IdPws,IdErrLog,idWait)
{
	waitLoginStart(idWait);
	var request = getRequest();
	request.open("POST", "modalRegistrazione-Login/checkLogin.php", true);	
	request.onreadystatechange = validateFieldCheckLogin(IdErrLog, idWait, request);
	request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	var hmllTagUser = document.getElementById(idUser);
    var hmllTagPws = document.getElementById(IdPws);
    request.send(   hmllTagUser.name + "=" + hmllTagUser.value+"&"+
                    hmllTagPws.name+ "=" +hmllTagPws.value);
	
}

function validateFieldCheckLogin(idErrField, idWait, request)
{
	return function(){
		waitLoginEnd(idWait);
		if (request.readyState === 4 && request.status === 200) {
			if (request.responseText != null) {
				//console.log(request.responseText);
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

function waitLoginStart(idWait){
	document.getElementById(idWait).style.display = "inline";
}

function waitLoginEnd(idWait){
	document.getElementById(idWait).style.display = "none";
}

