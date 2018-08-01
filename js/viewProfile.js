"use strict";

/*
    questo file contiene tutte 
    le funzioni js utilizzate per
    gestire viewProfile
*/


/** @description
 *  Questa funzione permette
 *  di togliere il tag
 *  readonly dai campi
 *  in gestione profilo
 */

 function removeReadOnly() 
 {
    document.getElementById("userModified").readOnly = false;
    document.getElementById("emailModified").readOnly = false;
    document.getElementById("pswModified").readOnly = false;
    document.getElementById("pswConfModified").readOnly = false;
    document.getElementById("nameModified").readOnly = false;
    document.getElementById("surnameModified").readOnly = false;
    document.getElementById("addressModified").readOnly = false;
    document.getElementById("phoneModified").readOnly = false;
 }

 /** @description
 *  Questa funzione permette
 *  di mettere il tag
 *  readonly dai campi
 *  in gestione profilo
 */

function addReadOnly() 
{
    document.getElementById("userModified").readOnly = true;
    document.getElementById("emailModified").readOnly = true;
    document.getElementById("pswModified").readOnly = true;
    document.getElementById("pswConfModified").readOnly = true;
    document.getElementById("nameModified").readOnly = true;
    document.getElementById("surnameModified").readOnly = true;
    document.getElementById("addressModified").readOnly = true;
    document.getElementById("phoneModified").readOnly = true;
}

/** @description
 *  questa funzione permette
 *  di abilitare la modifica
 *  del profilo sbloccando 
 *  tutti i campi necessarri
 */

function enableChanges()
{
    hideItem('bntModify');
    showItem('pswLabel');
    showItem('pswModified');
    showItem('pswConfLabel');
    showItem('pswConfModified');
    showItem('imgModified');
    removeReadOnly();
    showItem('bntSave');
}

/** @description
 *  questa funzione permette
 *  di disabilitare la modifica
 *  del profilo bloccando 
 *  tutti i campi necessarri
 */
function disableChanges()
{
    document.getElementById('imgName').innerHTML=   document.getElementById('nameModified').value+" "+
    document.getElementById('surnameModified').value;
    hideItem('bntSave');
    hideItem('pswLabel');
    hideItem('pswModified');
    hideItem('imgModified');
    addReadOnly();
    showItem('bntModify');
}

function refreshImg(path)
{
    document.getElementById('imgCard').src=path;
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
	var addrJob = document.getElementById('addressModified');
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

function addEvent()
{
    $("#btnConfirm").unbind('click').click(confirmOperation('modalPswDelete','errModalPswDelete'));
}