"use strict";

//var request = null;

function getRequest() 
{
	var request = null;
	if (window.XMLHttpRequest) 
		request = new XMLHttpRequest();
	return request;
}

function checkFieldReg(idField,idErrField,checkField)
{
	var request = getRequest();
	request.open("POST", "modalRegistrazione-Login/validate.php", true);	
	request.onreadystatechange = validateField(idErrField, request);
	request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	var hmllTag = document.getElementById(idField);
	if(checkField==null)
		request.send(hmllTag.name + "=" + hmllTag.value);
	else{
		var htmlTag1 = document.getElementById(checkField);

		request.send(hmllTag.name + "=" + hmllTag.value + '&_' + 
						htmlTag1.name+"=" + htmlTag1.value);
	}
}

function validateField(idErrField, request)
{
	return function(){
		if (request.readyState === 4 && request.status === 200) {
			if (request.responseText != null) {
				console.log(request.responseText);
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

function cleanErr(id){
	var notify = document.getElementById(id);
	notify.innerHTML = "";
}
