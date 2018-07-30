"use strict";


function bookJobs(idJob)
{
    var request = getRequest();
	request.open("POST", "../utils/bookJobs.php", true);
	request.onreadystatechange = validateBookJobs(request);
   
   	var formData = new FormData();
    formData.append('IdJob', idJob);
	
	request.send(formData);
	
}


function validateBookJobs(request) 
{
	return function() {
		if ( request.readyState === 4 && request.status === 200 ) {
			if ( request.responseText != null ) {
				console.log("da sistemare segnalazione query effettuata o meno")
			}		
		}
	}
}
