"use strict";

/*
    Questo file contiene tutti i controlli 
    necessari per validare i campi dei 
    lavori sia in fase di modifica che
    inserimento sia in locale che in remoto
*/

/*********** Controlli locali ***************/
function checkUserName(idCheck, idErr){

    var user = document.getElementById(idCheck);
    var errUser = document.getElementById(idErr);
    errUser.style.fontSize = '1.4em';
    errUser.style.color = 'red';
		
    if( user == null || user.value === "" || !alphaNumRegex.test(user.value) 
                     || !checkMinLength(user.value, UserNameMinLength ) 
                     || !checkMaxLength(user.value, UserNameMaxLength)) {
        errUser.innerHTML = "UserName non valido";
        return;
    }
    checkUserField (idCheck, idErr);
}

function checkTag(idCheck, idErr){

    var tag = document.getElementById(idCheck);
    var errTag = document.getElementById(idErr);
    errTag.style.fontSize = '1.4em';
    errTag.style.color = 'red';
		
    if( tag == null || tag.value === "" || !alphaRegex.test(tag.value)
                     || !checkMaxLength(tag.value, TagMaxLength)) {
        errTag.innerHTML = "Tag non valido";
        return;
    }
    checkTagField(idCheck, idErr);
}

function checkDescription(idCheck, idErr)
{   
    var desc = document.getElementById(idCheck);
    var errDesc = document.getElementById(idErr);
    errDesc.style.fontSize = '1.4em';
    errDesc.style.color = 'red';
		
    if( desc == null || desc.value === "" || !alphaNumRegex.test(desc.value) ) {
        errDesc.innerHTML = "La descrizione non &egrave; valida";
        return;
    }

    if( !checkMinLength(desc.value, DescriptionMinLength) ) {
        errDesc.innerHTML = "La descrizione &egrave; troppo corta";
        return;
    }

    if( !checkMaxLength(desc.value, DescriptionMaxLength) ) {
        errDesc.innerHTML = "La descrizione &egrave; troppo lunga";
        return;
    }
}

function checkCost(idCost, idErr)
{   
    var cost = document.getElementById(idCost);
    var errCost = document.getElementById(idErr);
    errCost.style.fontSize = '1.4em';
    errCost.style.color = 'red';
    
	if( cost == null || cost.value === "" || !checkMin(parseInt(cost.value), CostMin) || !numRegex.test(cost.value) ) {
        errCost.innerHTML = "Costo non valido";
        return;
    }
}

function checkDistance(idDist, idErr)
{   
    var dist = document.getElementById(idDist);
    var errDist = document.getElementById(idErr);
    errDist.style.fontSize = '1.4em';
    errDist.style.color = 'red';

    if( dist == null || dist.value === "" || !checkMin(parseInt(dist.value), DistanceMin) || !numRegex.test(dist.value) ) {
        errDist.innerHTML = "Distanza non valida";
        return;
    }
}

function checkDistanceSearch(idStreer, idDist, idErr)
{
    if( document.getElementById(idStreer).value !== '' ){
        checkDistance(idDist, idErr)
        return;
    }
    var errDist = document.getElementById(idErr);
    errDist.style.fontSize = '1.4em';
    errDist.style.color = 'red';
    errDist.innerHTML = "Via non selezionata";
}

function checkTime(idDate1, idTime1, idDate2, idTime2, idErr, idJob)
{
	var dateS = document.getElementById(idDate1).value;
	var timeS = document.getElementById(idTime1).value;
	var dateE = document.getElementById(idDate2).value;
	var timeE = document.getElementById(idTime2).value;

	var dateStart = new Date(dateS + ' ' + timeS);
    var dateEnd = new Date(dateE + ' ' + timeE);
    var now = new Date();
   
	var err = document.getElementById(idErr);
	err.style.fontSize = '1.4em';
    err.style.color = 'red';
    
	//non si possono caricare lavori nel passato
	if ( dateStart.getTime() < now.getTime() || dateEnd.getTime() < now.getTime() ) {
        err.innerHTML = "Non puoi caricare un lavoro nel passato";
        return;
    }

	//la data di inizio non puo' essere maggiore di quella di fine lavoro
    if( dateStart.getTime() >= dateEnd.getTime() ) {
        err.innerHTML = "La data di inizio lavoro non pu&ograve; essere successiva a quella di fine";
        return;
    }

	//mando una richiesta al server per controllare eventuali overlaps
	//la richiesta viene mandata solo in presenza di tutti e 4 i campi
	//in modo da non esagerare con le chiamate al server
	if ( dateS === '' || timeS === '' || dateE === '' || timeE === '' )
		return;

	var formData = new FormData();
	var request = getRequest();
	request.open("POST", "../utils/checkJobsSingleField.php", true);
	request.onreadystatechange = validateCheckSingleJobField(request, idErr);

	if (idJob != null)
		formData.append('sameJob', idJob);

	formData.append('dateS', dateStart);
	formData.append('dateE', dateEnd);

	request.send(formData);
}

function checkStreet(idCheck, idErr)
{   
    var addr = document.getElementById(idCheck);
    
	var errAddr = document.getElementById(idErr);
    errAddr.style.fontSize = '1.4em';
    errAddr.style.color = 'red';
    if( addr == null || addr.value === "" || !addressRegex.test(addr.value) ) {
        errAddr.innerHTML = "Indirizzo non valido";
        return;
    }

    if( !checkMinLength(addr.value, StreetMinLength) ) {
        errAddr.innerHTML = "Indirizzo troppo corto";
        return;
    }

    if( !checkMaxLength(addr.value, StreetMaxLength) ) {
        errAddr.innerHTML = "Indirizzo troppo lungo";
        return;
    }
}

function checkStreetSearch(idCheck, idErr)
{

    if(document.getElementById(idCheck).value === '')
        return;

    checkStreet(idCheck, idErr);
}



/************ Controllo tutti i campi definitivo al submit ******************/
function checkAllSearchJob()
{
    var addr = document.getElementById('optionStreet');
	// Get geocoder instance
	var geocoder = new google.maps.Geocoder();

	// Geocode the address
	geocoder.geocode(
		{'address': addr.value},
	   	function(results, status) {
            if (addr.value =="" || status === google.maps.GeocoderStatus.OK && results.length > 0) {
		
                if(addr.value !=""){
                    var tempStr = addr.value.split(",");
                   
                    if( !results[0].formatted_address.toLowerCase().includes(tempStr[0].trim().toLowerCase())  || 
                        !results[0].formatted_address.toLowerCase().includes(tempStr[tempStr.length-1].trim().toLowerCase()) ){
                        var notify = document.getElementById('errOptionStreet');
                        notify.style.fontSize = '1.4em';
                        notify.style.color = 'red';
                        notify.innerHTML = "Scegli un indirizzo piu preciso";
                        return;
                    }
                   

                    addr.value = results[0].formatted_address;
                }
                    
				var request = getRequest();
	            request.open("POST", "../utils/checkAllSearchJob.php", true);
    
                var htmlTagUser = document.getElementById('optionUser');
                var htmlTagDist = document.getElementById('optionDistance');

                if (htmlTagUser != null){
                    request.onreadystatechange = validateCheckJob(request);
                }else {
                    if ( latitude !== 100 && longitude !== 100 ){ 
                        var usrLocation = new google.maps.LatLng(latitude, longitude);
                    }else
                        var usrLocation = new google.maps.LatLng(44.403425,8.972164);
                    
                    
                    var mapProp = {
                        center: usrLocation,
                        zoom: 13,
                        mapTypeId: google.maps.TERRAIN
                    };

                    var map = new google.maps.Map(document.getElementById('googleMap'), mapProp);

                    if ( htmlTagDist.value !== '' ) {
                        //Disegno una cerchi di raggio x
                        var circle = new google.maps.Circle({
                            center: usrLocation,
                            radius: 1000*htmlTagDist.value, //In metri
                            strokeColor: "#0000FF",
                            strokeOpacity: 0.8,
                            strokeWeight: 2,
                            fillColor: "#0000FF",
                            fillOpacity: 0.4
                        }); 
                        circle.setMap(map);
                    }
                    
                    request.onreadystatechange = printFields(request, map);
                }

                var formData = new FormData();

                var htmlTagAddress = document.getElementById('optionStreet');
                var htmlTagCost = document.getElementById('optionCost');
                var htmlTagTag = document.getElementById('optionTag');
                
                if (htmlTagUser != null)
                    formData.append(htmlTagUser.name, htmlTagUser.value);

                formData.append(htmlTagAddress.name, htmlTagAddress.value);
                formData.append(htmlTagDist.name, htmlTagDist.value);
                formData.append(htmlTagCost.name, htmlTagCost.value);
                formData.append(htmlTagTag.name, htmlTagTag.value);
                formData.append('lat', latitude);
                formData.append('lon', longitude);
                
                latitude = 100;
                longitude = 100;
                
                request.send(formData);

                resetOptionSearchValues();
                if (htmlTagUser != null)
                    resetUserOptionValue();
                            
			} else{
                var notify = document.getElementById('errOptionStreet');
                notify.style.fontSize = '1.4em';
                notify.style.color = 'red';
                notify.innerHTML = "Indirizzo non valido";	
			}
		}
	);




    
}



function checkJobAllFields(op, id) 
{
	return function() {
        var addr = document.getElementById('modalStreet');
	// Get geocoder instance
	var geocoder = new google.maps.Geocoder();

	// Geocode the address
	geocoder.geocode(
		{'address': addr.value},
	   	function(results, status) {
            if ( status === google.maps.GeocoderStatus.OK && results.length > 0) {
		
				var tempStr = addr.value.split(",");
                   
                    if( !results[0].formatted_address.toLowerCase().includes(tempStr[0].trim().toLowerCase())  || 
                        !results[0].formatted_address.toLowerCase().includes(tempStr[tempStr.length-1].trim().toLowerCase()) ){
                        var notify = document.getElementById('errModalStreet');
                        notify.style.fontSize = '1.4em';
                        notify.style.color = 'red';
                        notify.innerHTML = "Scegli un indirizzo piu preciso";
                        return;
                    }
                   

                addr.value = results[0].formatted_address;
	
        
		var request = getRequest();
		request.open("POST", "../utils/checkJobsAllField.php", true);
		request.onreadystatechange = validateCheckJob(request);

		var formData = new FormData();

		var htmlTagDescription = document.getElementById('modalDescription');
		var htmlTagCost = document.getElementById('modalCost');
		var htmlTagDist = document.getElementById('modalDistance');
		var htmlTagDateS = document.getElementById('modalDateStart');
		var htmlTagTimeS = document.getElementById('modalTimeStart');
		var htmlTagDateE = document.getElementById('modalDateEnd');
		var htmlTagTimeE = document.getElementById('modalTimeEnd');
		var htmlTagAddress = document.getElementById('modalStreet');
		var htmlTagTag = document.getElementById('optionModalTag');

		formData.append(htmlTagDescription.name, htmlTagDescription.value);
		formData.append(htmlTagCost.name, htmlTagCost.value);
		formData.append(htmlTagDist.name, htmlTagDist.value);
		formData.append(htmlTagDateS.name, htmlTagDateS.value);
		formData.append(htmlTagTimeS.name, htmlTagTimeS.value);
		formData.append(htmlTagDateE.name, htmlTagDateE.value);
		formData.append(htmlTagTimeE.name, htmlTagTimeE.value);
		formData.append(htmlTagAddress.name, htmlTagAddress.value);
		formData.append(htmlTagTag.name, htmlTagTag.value);

		formData.append('lat', latitude);
		formData.append('long', longitude);
	
		if ( op === "insert" )
			formData.append("insert", true);
		else if ( op === "modify" ) 
			formData.append("insert", false);

		if (id != null) 
			formData.append("IdJob", id);

        request.send(formData);
        
    } else{
        var notify = document.getElementById('errModalStreet');
    notify.style.fontSize = '0.9em';
    notify.style.color = 'darkred';
    notify.innerHTML = "Indirizzo non valido";	
    }
}
);

	}
}

function validateCheckJob(request) 
{
	return function() {
		if ( request.readyState === 4 && request.status === 200 ) {
			if ( request.responseText != null ) {
                try {
					var jsonObj = JSON.parse(request.responseText);	
					
                    //lavoro inserito con successo
                    if ( jsonObj == 0 )
                        if(document.getElementById('printCard') != null) {
                            document.getElementById('printCard').innerHTML = '';
						} else {
                        	window.location.href = '../viewJobs/viewJobs.php';
							return;
						}
            
                    //stampa degli errori rilevati
                    for(var key in jsonObj) {
                        var notify = document.getElementById(key);
                        notify.style.fontSize = '1.4em';
                        notify.style.color = 'red';
                        notify.innerHTML = jsonObj[key];		
                    }

                } catch (error) {
                    document.getElementById('printCard').innerHTML = request.responseText;
                    
                }
			}		
		}
	}
}

/************** Controllo campi singoli con ajax *******************/
function checkUserField (idUser, idErrField) 
{
	var formData = new FormData();
	var request = getRequest();
	request.open("POST", "../utils/checkJobsSingleField.php", true);
	request.onreadystatechange = validateCheckSingleJobField(request, idErrField);

	var user = document.getElementById(idUser);
    
	formData.append(user.name, user.value);
	
	request.send(formData);
}


function checkTagField (idTag, idErrField) 
{
	var formData = new FormData();
	var request = getRequest();
	request.open("POST", "../utils/checkJobsSingleField.php", true);
	request.onreadystatechange = validateCheckSingleJobField(request, idErrField);

	var tag = document.getElementById(idTag);
	
	formData.append(tag.name, tag.value);
	
	request.send(formData);
}
	
function validateCheckSingleJobField(request, idErrField) 
{
	return function() {
		if ( request.readyState === 4 && request.status === 200 ) {
			if ( request.responseText != null ) {
				
				var jsonObj = JSON.parse(request.responseText);	
				
				//stampa dell'errore sul campo
                if ( jsonObj['code'] === -1 ) {
                    var notify = document.getElementById(idErrField);
                    notify.style.fontSize = '1.4em';
                    notify.style.color = 'red';
                    notify.innerHTML = jsonObj['msg'];
                }

			}
		}
	}
}
