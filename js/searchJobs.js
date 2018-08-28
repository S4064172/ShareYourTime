"use strict"


function resetOptionSearch(){
    cleanErr('errOptionUser');
    cleanErr('errOptionTag');
    cleanErr('errOptionCost');
    cleanErr('errOptionDistance');
    cleanErr('errOptionStreet');
    document.getElementById("optionUser").value="Seleziona l'utente";
    document.getElementById("optionTag").value="Scegli il tag";
    document.getElementById("optionDistance").value="Seleziona la distanza";
    document.getElementById("optionCost").value="Seleziona il costo";
    document.getElementById("optionStreet").value="";
    
}


function resetSearch(){
    resetOptionSearch();
    $("#resetResault").load(location.href + " #resetResault");
    
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
	var addrJob = document.getElementById('optionStreet');
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