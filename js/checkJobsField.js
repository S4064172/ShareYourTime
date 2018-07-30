"use strict";

/*
    Questo file contiene tutti i controlli 
    necessari per validare i campi dei 
    lavori sia in fase di modifica che
    inserimento sia in locale che in remoto
*/

/*********** Controlli locali ***************/
function checkDescription(idCheck, idErr)
{   
    var desc = document.getElementById(idCheck);
    var errDesc = document.getElementById(idErr);
    errDesc.style.fontSize = '0.9em';
    errDesc.style.color = 'darkred';
		
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
    errCost.style.fontSize = '0.9em';
    errCost.style.color = 'darkred';
    
	if( cost == null || cost.value === "" || !checkMin(parseInt(cost.value), CostMin) || !numRegex.test(cost.value) ) {
        errCost.innerHTML = "Costo non valido";
        return;
    }
}

function checkDistance(idDist, idErr)
{   
    var dist = document.getElementById(idDist);
    var errDist = document.getElementById(idErr);
    errDist.style.fontSize = '0.9em';
    errDist.style.color = 'darkred';

    if( dist == null || dist.value === "" || !checkMin(parseInt(dist.value), DistanceMin) || !numRegex.test(dist.value) ) {
        errDist.innerHTML = "Distanza non valida";
        return;
    }
}

function checkTime(idDate1, idTime1, idDate2, idTime2, idErr)
{
    var dateStart = new Date(document.getElementById(idDate1).value + ' ' + document.getElementById(idTime1).value);
    var dateEnd = new Date(document.getElementById(idDate2).value + ' ' + document.getElementById(idTime2).value);
    var now = new Date();
   
	var err = document.getElementById(idErr);
	err.style.fontSize = '0.9em';
    err.style.color = 'darkred';
    
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
}

function checkStreet(idCheck, idErr)
{   
    var addr = document.getElementById(idCheck);
    
	var errAddr = document.getElementById(idErr);
    errAddr.style.fontSize = '0.9em';
    errAddr.style.color = 'darkred';

    if( addr == null || addr.value === "" || !addressRegex.test(addr.value) ) {
        errAddr.innerHTML = "Indirizzo non valido";
        return;
    }

    if( !checkMinLength(addr.value, StreetMinLength) ) {
        errAddr.innerHTML = "Indirizzo troppo corto";
        return;
    }

    if( !checkMaxLength(addr.value, StreetMaxLength) ) {
        errAddr.innerHTML = "Strada troppo corta";
        return;
    }
}






/************ Controllo tutti i campi definitivo al submit ******************/
function checkAllSearchJob()
{
    var request = getRequest();
	request.open("POST", "../utils/checkAllSearchJob.php", true);
	request.onreadystatechange = validateCheckJob(request);

	var formData = new FormData();

	var htmlTagAddress = document.getElementById('optionStreet');
	var htmlTagCost = document.getElementById('optionCost');
	var htmlTagDist = document.getElementById('optionDistance');
    var htmlTagTag = document.getElementById('optionTag');
    
    formData.append(htmlTagAddress.name, htmlTagAddress.value);
    formData.append(htmlTagDist.name, htmlTagDist.value);
    formData.append(htmlTagCost.name, htmlTagCost.value);
    formData.append(htmlTagTag.name, htmlTagTag.value);

    request.send(formData);
}




function checkJobAllFields() 
{
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
	
	//formData.append("insert", 0);
		
	request.send(formData);
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
                        if(document.getElementById('printCard')!==null)
                            document.getElementById('printCard').innerHTML='';
                        else
                            return;
            
                    //stampa degli errori rilevati
                    for(var key in jsonObj) {
                        //console.log(jsonObj[key]);
                        var notify = document.getElementById(key);
                        notify.style.fontSize = '0.9em';
                        notify.style.color = 'darkred';
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

function checkDatesAndTimes(dateS, timeS, dateE, timeE)
{

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
                    notify.style.fontSize = '0.9em';
                    notify.style.color = 'darkred';
                    notify.innerHTML = jsonObj['msg'];
                }

			}
		}
	}
}
