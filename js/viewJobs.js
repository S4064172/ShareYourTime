"use strict";

/*
    questo file contiene tutte 
    le funzioni js utilizzate per
    gestire viewJobs
*/

/**
 * @description
 * questa funzione ci permette
 * di riempire il modalJobs in 
 * fase di modifica 
 */

function fillModalFieldJobs(id)
{
    var num = id.split("_");
    document.getElementById('modalDescription').value =
        document.getElementById('cardDescription_' + num[1]).getAttribute('value');
    document.getElementById('modalCost').value =
        document.getElementById('cardCost_' + num[1]).getAttribute('value');
    
    var startDate = document.getElementById('cardTimeStart_' + num[1]).getAttribute('value').split(" ");
    document.getElementById('modalDateStart').value = startDate[0];
    var startTime = startDate[1].split(":");
    document.getElementById('modalTimeStart').value = startTime[0] + ":" + startTime[1];
        
    var endDate = document.getElementById('cardTimeEnd_' + num[1]).getAttribute('value').split(" ");
    document.getElementById('modalDateEnd').value = endDate[0];
    var endTime = endDate[1].split(":")
    document.getElementById('modalTimeEnd').value = endTime[0] + ":" + endTime[1];

    document.getElementById('modalDistance').value =
        document.getElementById('cardDistance_' + num[1]).getAttribute('value');
    document.getElementById('modalStreet').value =
        document.getElementById('cardStreet_' + num[1]).getAttribute('value');
  
	document.getElementById('optionModalTag').value =
		document.getElementById('cardTag_' + num[1]).getAttribute('value');

	//bottone all'interno del modal
	var button = document.getElementById('modButton');
	button.innerHTML = 'Salva modifiche';
}

/**
 * @description
 * questa funzione pulisce tutti
 * i campi del modal dei lavori
 */

function emptyModalJobs()
{
    document.getElementById('modalDescription').value = "";
    document.getElementById('modalCost').value = "";
    document.getElementById('modalDateStart').value = "";
    document.getElementById('modalTimeStart').value = "";
    document.getElementById('modalDateEnd').value = "";
    document.getElementById('modalTimeEnd').value = "";
    document.getElementById('modalDistance').value = "";
    document.getElementById('modalStreet').value = "";
	document.getElementById('optionModalTag').value = "";
	
	//bottone all'interno del modal
	var button = document.getElementById('modButton');
	button.innerHTML = 'Inserisci lavoro';
}

/*
 * @description
 * questa funzione abilita
 * l'autocompletamento degli
 * indirizzi delle api di google
 */

function initAddr() 
{	
	//Autocompletamento google maps per inserire indirizzi in fase di inserimento/modifica di un lavoro
	var addrJob = document.getElementById('modalStreet');
	var autocompleteJob = new google.maps.places.Autocomplete(addrJob, {types:['geocode']});
	google.maps.event.addListener(autocompleteJob, 'place_changed', function () {
                var place = autocompleteJob.getPlace();
                console.log(place.name);
                console.log('cityLat: ' + place.geometry.location.lat());
                console.log('cityLng: ' + place.geometry.location.lng());
				latitude = place.geometry.location.lat();
				longitude = place.geometry.location.lng();
    });
}
