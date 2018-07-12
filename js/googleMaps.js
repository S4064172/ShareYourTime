"use strict";

function showMap() {
	//Autocompletamento google maps per inserire indirizzi in fase di registrazione
	var addr = document.getElementById('searchAddr');
	var autocomplete = new google.maps.places.Autocomplete(addr,{types:['geocode']});

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

