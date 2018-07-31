"use strict";


function bookJobs(idJob)
{
    var request = getRequest();
	request.open("POST", "../utils/bookJobs.php", true);
	request.onreadystatechange = validateBookJobs(request, idJob);
   
   	var formData = new FormData();
    formData.append('IdJob', idJob);
	
	request.send(formData);
	
}


function validateBookJobs(request, idJob) 
{
	return function() {
		if ( request.readyState === 4 && request.status === 200 ) {
			if ( request.responseText != null ) {
				console.log(request.responseText);
				var jsonObj = JSON.parse(request.responseText);	
				if ( jsonObj == 0 ){
					var htmlTag = document.getElementById("alertDelete");
					htmlTag.classList.add("alert-success");
					htmlTag.classList.add("myAllert");
					var htmlTagText = document.getElementById("alertText");
					htmlTagText.innerHTML="lavoro prenotato con successo";
					showItem('alertDelete');
					hideItem(idJob);
				}else{
					var htmlTag = document.getElementById("alertDelete");
					htmlTag.classList.add("alert-danger");
					htmlTag.classList.add("myAllert");
					var htmlTagText = document.getElementById("alertText");
					htmlTagText.innerHTML="errore nella prenotazione del lavoro";
					showItem('alertDelete');
				}	
					
			}		
		}
	}
}
