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
					showAlertSuccess("Lavoro prenotato con successo");
					hideItem(idJob);
				} else {
					showAlertError("Errore prenotazione lavoro");
				}	
			}		
		}
	}
}
