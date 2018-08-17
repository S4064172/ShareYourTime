"use strict";
function retrieveLastFive (map) 
{
	var formData = new FormData();
	var request = getRequest();
	request.open("POST", "../utils/worksForMap.php", true);
	request.onreadystatechange = printFields(request, map);
	request.send();
}
	
function printFields(request, map) 
{
	return function() {
		if ( request.readyState === 4 && request.status === 200 ) {
			if ( request.responseText != null ) {
				//console.log(request.responseText);
				var jsonObj = JSON.parse(request.responseText);	
							
				for (var i = 0; i < 5; i++) {
					var str = jsonObj[i].split('@');

					console.log('DEBUG:');
					console.log(str[0]);
					console.log(str[1]);
					console.log(str[2]);
					console.log();

					//Marker di lavori
					var workLocation = new google.maps.LatLng(str[1], str[2]);
	
					var workMark = new google.maps.Marker({
							position: workLocation,
					});
					workMark.setMap(map);
					
					//Testo del marker
					var infoText = new google.maps.InfoWindow({
						content: str[0]
					});
					infoText.open(map, workMark);
					google.maps.event.addListener(workMark, 'click',
						function () {
							infoText.open(map, workMark);
						}
					);
				}
			}
		}
	}
}

function showMap() 
{
	//Autocompletamento google maps per inserire indirizzi nell ricerca in index
	var addrIndex = document.getElementById('optionMapStreet');
	var autocompleteIndex = new google.maps.places.Autocomplete(addrIndex, {types:['geocode']});

	//Autocompletamento google maps per inserire indirizzi in fase di registrazione
	var addrReg = document.getElementById('addressReg');
	var autocompleteReg = new google.maps.places.Autocomplete(addrReg, {types:['geocode']});

	//via dodecaneso 35 DIBRIS
	var hqLocation = new google.maps.LatLng(44.403425,8.972164);

	var mapProp = {
	    center: hqLocation,
		zoom: 12,
		mapTypeId: google.maps.TERRAIN
	};
	
	// Mappa
	var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
		
	retrieveLastFive(map);
 
	//Marker della posizione iniziale
	var headQuarter = new google.maps.Marker({
			position: hqLocation,
			icon: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png'
	});
	headQuarter.setMap(map);
		
	//Testo del marker
	var infoText = new google.maps.InfoWindow({
	  content: "La nostra sede"
	});
	infoText.open(map, headQuarter);
	google.maps.event.addListener(headQuarter, 'click',
			function () {
				infoText.open(map, headQuarter);
			}
	);

	//Recupera informazioni quando un utente sceglie un luogo con autocomplete
	google.maps.event.addListener(autocompleteIndex, 'place_changed', listenerAutocomplete(autocompleteIndex));
	google.maps.event.addListener(autocompleteReg, 'place_changed', listenerAutocomplete(autocompleteReg));

	//Disegno una cerchi di raggio x
	var circle = new google.maps.Circle({
		center: hqLocation,
	  	radius: 1000, //In metri
	  	strokeColor: "#0000FF",
		strokeOpacity:0.8,
		strokeWeight: 2,
  		fillColor: "#0000FF",
	  	fillOpacity: 0.4
	}); 
	circle.setMap(map);
}

function listenerAutocomplete(autocomplete) 
{
	return function() {
		var place = autocomplete.getPlace();
    	console.log(place.name);
	    console.log('cityLat: ' + place.geometry.location.lat());
    	console.log('cityLng: ' + place.geometry.location.lng());
		latitude = place.geometry.location.lat();
		longitude = place.geometry.location.lng();
	}
}
