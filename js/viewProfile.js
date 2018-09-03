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
    document.getElementById("userModified").disabled = false;
    document.getElementById("emailModified").disabled = false;
    document.getElementById("pswModified").disabled = false;
    document.getElementById("pswConfModified").disabled = false;
    document.getElementById("nameModified").disabled = false;
    document.getElementById("surnameModified").disabled = false;
    document.getElementById("addressModified").disabled = false;
    document.getElementById("phoneModified").disabled = false;
 }

 /** @description
 *  Questa funzione permette
 *  di mettere il tag
 *  readonly dai campi
 *  in gestione profilo
 */

function addReadOnly() 
{
    document.getElementById("userModified").disabled = true;
    document.getElementById("emailModified").disabled = true;
    document.getElementById("pswModified").disabled = true;
    document.getElementById("pswConfModified").disabled = true;
    document.getElementById("nameModified").disabled = true;
    document.getElementById("surnameModified").disabled = true;
    document.getElementById("addressModified").disabled = true;
    document.getElementById("phoneModified").disabled = true;
}

/** @description
 *  questa funzione permette
 *  di abilitare la modifica
 *  del profilo sbloccando 
 *  tutti i campi necessarri
 */

function enableChanges()
{
    hideItem('bntDelete');
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
    showItem('bntDelete');
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
				latitude = place.geometry.location.lat();
                longitude = place.geometry.location.lng();
                checkAddress('addressModified','errAddressModified');
    });
    
}

function addEvent()
{
    $("#btnConfirm").unbind('click').click(confirmOperation('modalPswDelete','errModalPswDelete'));
}
