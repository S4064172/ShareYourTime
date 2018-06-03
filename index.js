"use strict";

//When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
	var loginModal = document.getElementById('loginModal');
	var signupModal = document.getElementById('signupModal');
    
	if (event.target === loginModal) {
		document.getElementById('signupB').disabled = false;
    	loginModal.style.display = "none";
    }

    if (event.target === signupModal) {
		document.getElementById('loginB').disabled = false;
	    signupModal.style.display = "none";
    }
}

//Disable a button
function disableButtonById(id) {
	document.getElementById(id).disabled = true;
}

//Enable a button
function enableButtonById(id) {
	document.getElementById(id).disabled = false;
}

//Hide definitely the element
function noneById(id) {
	document.getElementById(id).style.display = 'none';
}

//Show the element
function showById(id) {
	document.getElementById(id).style.display = 'block';
}
