"use strict";

var request = null;

function checkUsernameReg() {
	if (window.XMLHttpRequest) {
			request = new XMLHttpRequest({mozSystem: true});
			request.open("POST", "modalRegistrazione-Login/validate.php", true);	
			request.onreadystatechange = validateField;
			request.setRequestHeader("Content-type","application/x-www-form-urlencoded")
			request.send("usernameReg=" + document.getElementById('usernameReg').value);
	}
}

function validateField() {
	if (request.readyState === 4 && request.status === 200) {
		if (request.responseText != null) {
			console.log(request.responseText);
			var jsonObj = JSON.parse(request.responseText);
			//console.log(jsonObj);
			var notify = document.getElementById("err");
			if (jsonObj["code"] !== 0) {
				notify.style.color = 'darkred';
				notify.style.fontSize = '0.9em';
				notify.innerHTML = "Username non valido !";
			} else {
				notify.style.color = 'green';
				notify.innerHTML = "Username OK !";
			}
		}
	}
}
