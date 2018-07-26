"use strict";

function showMap() {
	//Autocompletamento google maps per inserire indirizzi nell ricerca in index
	var addrIndex = document.getElementById('optionMapStreet');
	var autocompleteIndex = new google.maps.places.Autocomplete(addrIndex, {types:['geocode']});

	//Autocompletamento google maps per inserire indirizzi in fase di registrazione
	var addrReg = document.getElementById('addressReg');
	var autocompleteReg = new google.maps.places.Autocomplete(addrReg, {types:['geocode']});

	//via dodecaneso 35 DIBRIS
	var myLocation = new google.maps.LatLng(44.403425,8.972164);

	var mapProp = {
	    center: myLocation,
		zoom: 15,
		mapTypeId: google.maps.TERRAIN
	};
	
	// Mappa
	var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
 
	//Marker della posizione iniziale
	var whereAreYou = new google.maps.Marker({position: myLocation});
	whereAreYou.setMap(map);
		
	//Testo del marker
	var infoText = new google.maps.InfoWindow({
	  content: "Tu ti trovi qui!"
	});
	infoText.open(map, whereAreYou);
	google.maps.event.addListener(whereAreYou, 'click',
			function () {
				infoText.open(map, whereAreYou);
			}
	);

//------------------------------------------------------------------------------------------------
		//Recupera informazioni quando un utente sceglie un luogo con autocomplete
		google.maps.event.addListener(autocompleteIndex, 'place_changed', function () {
                var place = autocompleteIndex.getPlace();
                console.log(place.name);
                console.log('cityLat: ' + place.geometry.location.lat());
                console.log('cityLng: ' + place.geometry.location.lng());
        });
		google.maps.event.addListener(autocompleteReg, 'place_changed', function () {
                var place = autocompleteReg.getPlace();
                console.log(place.name);
                console.log('cityLat: ' + place.geometry.location.lat());
                console.log('cityLng: ' + place.geometry.location.lng());
        });
	

//------------------------------------------------------------------------------------------------

	//Disegno una cerchi di raggio x
	var circle = new google.maps.Circle({
		center: myLocation,
	  	radius: 1000, //In metri
	  	strokeColor:"#0000FF",
		strokeOpacity:0.8,
		strokeWeight:2,
  		fillColor:"#0000FF",
	  	fillOpacity:0.4
	}); 
	circle.setMap(map);
}

