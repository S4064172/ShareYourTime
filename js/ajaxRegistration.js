"use strict";

var request = null;

function checkFieldReg(idField,idErrField,checkField)
{
	if (window.XMLHttpRequest) {
			request = new XMLHttpRequest();
			request.open("POST", "modalRegistrazione-Login/validate.php", true);	
			request.onreadystatechange = validateField(idErrField);
			request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			var hmllTag = document.getElementById(idField);
			if(checkField==null)
				request.send(hmllTag.name + "=" + hmllTag.value);
			else{
				var htmlTag1 = document.getElementById(checkField);
				request.send(	hmllTag.name + "=" + hmllTag.value 
								+'&'+htmlTag1.name+'c'+"="+htmlTag1.value);
			}
				
	}
}

function validateField(idErrField)
{
	return function(){
		if (request.readyState === 4 && request.status === 200) {
			if (request.responseText != null) {
				console.log(request.responseText);
				var jsonObj = JSON.parse(request.responseText);
				//console.log(jsonObj);
				var notify = document.getElementById(idErrField);
				notify.style.fontSize = '0.9em';
				if (jsonObj['code'] === -1) {
					notify.style.color = 'darkred';
				} else {
					if(jsonObj['code'] === 0){
						notify.style.color = 'green';
					}else{
						return;
					}
						
				}
				notify.innerHTML = jsonObj['msg'];
			}
		}
	}
}

function cleanErr(id){
	var notify = document.getElementById(id);
	notify.innerHTML = "";
}
