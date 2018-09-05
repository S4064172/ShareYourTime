"use strict";

/*
    Questo file contiene tutti i controlli 
    necessari per validare i campi della 
    registrazione o della modifica del profilo
    sia in locale che in remoto
*/

/*****************Controlli Remoti Solo Psw*******************/


/** @description    
 *  Questa funzione ci permette
 *  di controllare la password in
 *  operazioni sensibili
 */

function confirmOperation(idPsw, idErrPsw, id) 
{  
    return function(){
        var request = getRequest();
        request.open("POST", "../utils/checkConfirmOperation.php", true);	
        request.onreadystatechange = validateconfirmOperation(request, idErrPsw, id);
        var psw = document.getElementById(idPsw).value;
        var formData = new FormData();
        formData.append('checkPsw', psw);
        if( id!= null )
            formData.append('idJob', id);
        request.send(formData);
    }
}

function validateconfirmOperation(request, idErrPsw, idJob)
{
    return function() {
        if ( request.readyState === 4 && request.status === 200 ) {
            if ( request.responseText != null ) {
                
                var jsonObj = JSON.parse(request.responseText);
                if ( jsonObj === '1' ){
                    showAlertSuccess("Lavoro rimosso con successo");
                    closeModal();
                    hideItem(idJob);
                    return;
                }
                if(jsonObj === '-1'){
                    showAlertError("Errore rimozione lavoro");
                    closeModal();
                    return;
                }
                if ( jsonObj === '0' ) {
                    window.location.href = '../utils/deleteAccount.php';
                    return;
                } 

                var tagHtml = document.getElementById(idErrPsw);
                tagHtml.style.fontSize = '0.9em';
                tagHtml.style.color = 'darkred';
                tagHtml.innerHTML = jsonObj;
            
            }
        }
    }
}

/*****************Controlli Remoti Completi*******************/

/** @description
*	Questa funzione ci permette di creare 
*	una richiesta in post per controllare
*	i campi che l'utente ha inserito
*   durante la modifica del profilo.  
*	Viene utilizzata una chiamata ajax
*	per rimanere nella stessa pagina
*   in caso di errore.
*/

function checkModifiedAllField(idWait, userCheck, mailCheck, phoneCheck)
{
    var geocoder = new google.maps.Geocoder();
    var addr = document.getElementById('addressModified');
    geocoder.geocode(  
        {'address': addr.value }, 
        function(results, status) {

            if (status === google.maps.GeocoderStatus.OK && results.length > 0) {
                var tempStr = addr.value.split(",");
                   
                if( !results[0].formatted_address.toLowerCase().includes(tempStr[0].trim().toLowerCase())  || 
                    !results[0].formatted_address.toLowerCase().includes(tempStr[tempStr.length-1].trim().toLowerCase()) ){
                    var notify = document.getElementById('errAddressModified');
                    notify.style.fontSize = '1.4em';
                    notify.style.color = 'red';
                    notify.innerHTML = "Scegli un indirizzo piu preciso, forse cercavi " +results[0].formatted_address;
                    return;
                }
                addr.value = results[0].formatted_address;
                showItem(idWait); 
                var request = getRequest();
                request.open("POST", "../utils/checkProfileUserAllField.php", true);	
                request.onreadystatechange = validateCheckGenericAllField(idWait, request);
                
                var formData = new FormData();
                var htmlTagUser = document.getElementById('userModified');
                var htmlTagEmail = document.getElementById('emailModified');
                var htmlTagPsw = document.getElementById('pswModified');
                var htmlTagConfPsw = document.getElementById('pswConfModified');
                var htmlTagName = document.getElementById('nameModified');
                var htmlTagSurname = document.getElementById('surnameModified');
                var htmlTagAddress = document.getElementById('addressModified');
                var htmlTagPhone = document.getElementById('phoneModified');
                var htmlTagPhoto = document.getElementById('photoModified');
                
                formData.append(htmlTagPhoto.name, htmlTagPhoto.files[0]);
                formData.append(htmlTagUser.name, htmlTagUser.value);
                formData.append(htmlTagEmail.name, htmlTagEmail.value);
                formData.append(htmlTagPsw.name, htmlTagPsw.value);
                formData.append(htmlTagConfPsw.name, htmlTagConfPsw.value);
                formData.append(htmlTagName.name, htmlTagName.value);
                formData.append(htmlTagSurname.name, htmlTagSurname.value);
                formData.append(htmlTagAddress.name, htmlTagAddress.value);
                formData.append(htmlTagPhone.name, htmlTagPhone.value);
                formData.append('checkUser', userCheck);
                formData.append('checkEmail', mailCheck);
                formData.append('checkPhone', phoneCheck);
                
                formData.append("registration", 1);

                request.send(formData);
            
            }else{
                var notify = document.getElementById('errAddressModified');
                notify.style.fontSize = '0.9em';
                notify.style.color = 'darkred';
                notify.innerHTML = "Indirizzo non valido";
            }
        }
    );
}


/** @description
*	Questa funzione ci permette di creare 
*	una richiesta in post per controllare
*	i campi che l'utente ha inserito 
*   durante la fase di registrazione.  
*	Viene utilizzata una chiamata ajax
*	per rimanere nella stessa pagina 
*   in caso di errore.
*/
function checkRegistrationAllField(idWait)
{

    var geocoder = new google.maps.Geocoder();
    var addr = document.getElementById('addressReg');
    geocoder.geocode(  
        {'address': addr.value }, 
        function(results, status) {

            if (status === google.maps.GeocoderStatus.OK && results.length > 0) {
                var tempStr = addr.value.split(",");
                   
                    if( !results[0].formatted_address.toLowerCase().includes(tempStr[0].trim().toLowerCase())  || 
                        !results[0].formatted_address.toLowerCase().includes(tempStr[tempStr.length-1].trim().toLowerCase()) ){
                        var notify = document.getElementById('errAddress');
                        notify.style.fontSize = '1.4em';
                        notify.style.color = 'red';
                        notify.innerHTML = "Scegli un indirizzo piu preciso, forse cercavi " +results[0].formatted_address;
                        return;
                    }
                   

                addr.value = results[0].formatted_address;
                showItem(idWait)
                var request = getRequest();
                request.open("POST", "../utils/checkProfileUserAllField.php", true);	
                request.onreadystatechange = validateCheckGenericAllField(idWait, request);

                var formData = new FormData();

                var htmlTagUser = document.getElementById('usernameReg');
                var htmlTagEmail = document.getElementById('emailReg');
                var htmlTagPsw = document.getElementById('pswReg');
                var htmlTagPswConf = document.getElementById('pswRegConf');
                var htmlTagName = document.getElementById('nameReg');
                var htmlTagSurname = document.getElementById('surnameReg');
                var htmlTagAddress = document.getElementById('addressReg');
                var htmlTagPhone = document.getElementById('telephoneReg');
                var htmlTagPhoto = document.getElementById('photoReg');

                formData.append(htmlTagPhoto.name, htmlTagPhoto.files[0]);
                formData.append(htmlTagUser.name, htmlTagUser.value);
                formData.append(htmlTagEmail.name, htmlTagEmail.value);
                formData.append(htmlTagPsw.name, htmlTagPsw.value);
                formData.append(htmlTagPswConf.name, htmlTagPswConf.value);
                formData.append(htmlTagName.name, htmlTagName.value);
                formData.append(htmlTagSurname.name, htmlTagSurname.value);
                formData.append(htmlTagAddress.name, htmlTagAddress.value);
                formData.append(htmlTagPhone.name, htmlTagPhone.value);

                formData.append("registration", 0);
                request.send(formData);
            }else{
                var notify = document.getElementById('errAddress');
                notify.style.fontSize = '0.9em';
                notify.style.color = 'darkred';
                notify.innerHTML = "Indirizzo non valido";
            }
        }
    );
}


/** @description
*	questa callback stampa a video
*   gli errori generati dal controllo
*   remoto dei campi.
*/
function validateCheckGenericAllField(idWait, request)
{
    return function() {
        hideItem(idWait)
        if ( request.readyState === 4 && request.status === 200 ) {
            if ( request.responseText != null ) {
				
                var jsonObj = JSON.parse(request.responseText);
                
                // mi sono registrato con successo
                // mi sposto nella home page
                if( jsonObj == 0 ) {
                    window.location.href = '../homepage/homepage.php';
                    return;
                }

                // ho modificato i campi del profilo con
                // successo torno sulla modifica del profilo
                if( jsonObj == 1 ) {
                    disableChanges();
                    window.location.href = '../viewProfile/viewProfile.php';
                    return;
                }
        
                //stampa degli errori rilevati
                for(var key in jsonObj) {
                    
                    var notify = document.getElementById(key);
                    notify.style.fontSize = '0.9em';
                    notify.style.color = 'darkred';
                    notify.innerHTML = jsonObj[key];		
                }
            }
        }
    }
}


/*****************Controlli Remoti Singoli*******************/

/** 								 
 *  @description
 * questa funzione ci permette
 * di effettuare una richiesta
 * post al server il quale 
 * controllo sul db la validità
 * dei campi passati
*/
function checkGenericSingleField(idField, idErrField)
{
    var request = getRequest();
    request.open("POST", "../utils/checkProfileUserSingleField.php", true);	
    request.onreadystatechange = validateCheckGenericSingleField(idErrField, request);	
    var formData = new FormData();
    var htmlTag = document.getElementById(idField);
    formData.append(htmlTag.name,htmlTag.value);
    request.send(formData);
}

/**	@description
 *  questa callback stampa a video
 *  gli errori generati dal controllo
 *  remoto dei campi 
*/

function validateCheckGenericSingleField(idErrField, request)
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

/*****************Controlli Locali*******************/
/**
 *  @description
 *  questa funzione controlla 
 *  l'username in fase di 
 *  registrazione
 */
function checkUsername(idUser, idErr)
{
    var user = document.getElementById(idUser).value;
    var err = document.getElementById(idErr);
   
    if ( !checkMinLength(user, UserNameMinLength) || !checkMaxLength(user, UserNameMaxLength) ) {
        err.style.fontSize = '0.9em';
        err.style.color = 'darkred';
        err.innerHTML = 'L\'username deve essere compreso tra i 5 e i 25 caratteri';
        return;
    }
 
    if ( !checkMatchRegex(user, alphaNumRegex) ) {
        err.style.fontSize = '0.9em';
        err.style.color = 'darkred';
        err.innerHTML = 'Username non valido';
        return;
    }

    checkGenericSingleField(idUser, idErr);
}


/**
 *  @description
 *  questa funzione controlla 
 *  l'username in fase di 
 *  modifica profilo.
 */
function checkUsernameUpdate(idUser, idErr, oldValue)
{    
    var user = document.getElementById(idUser).value;
   
    if( user !== oldValue)
        checkUsername(idUser, idErr);
}

/**
 *  @description
 *  questa funzione controlla 
 *  la mail in fase di 
 *  registrazione
 */
function checkEmail(idEmail, idErr)
{
    var email = document.getElementById(idEmail).value;
    var err = document.getElementById(idErr)

    if ( notValidString(email, emailRegex, EmailMinLength, EmailMaxLength) ) {
        err.style.fontSize = '0.9em';
        err.style.color = 'darkred';
        err.innerHTML = 'Email non valida';
        return;
    }

    checkGenericSingleField(idEmail, idErr);
}

/**
 *  @description
 *  questa funzione controlla 
 *  la mail in fase di 
 *  modifica profilo.
 */

function checkEmailUpdate(idEmail, idErr, oldValue)
{    
    var email = document.getElementById(idEmail).value;

    if( email !== oldValue )
        checkEmail(idEmail, idErr);
}

/**
 *  @description
 *  questa funzione controlla 
 *  la psw in fase di 
 *  registrazione
 */
function checkPsw(idPws, idErr)
{
    var psw = document.getElementById(idPws).value;
    var err = document.getElementById(idErr);

    if ( !checkMinLength(psw, PasswordMinLength) ) {
        err.style.fontSize = '0.9em';
        err.style.color = 'darkred';
        err.innerHTML = 'La password deve essere almeno di 8 caratteri';
        return;
    }
       
    for(var i = 0; i < passwordRegex.length; i++)
        if ( !checkMatchRegex(psw, passwordRegex[i]) ) {
            err.style.fontSize = '0.9em';
            err.style.color = 'darkred';
            err.innerHTML = 'La password deve contenere almeno una lettera minuscola, una maiuscola, un numero e un carattere speciale.';
            return;
        }
}

/**
 *  @description
 *  questa funzione controlla 
 *  la psw in fase di 
 *  modifica profilo
 */
function checkPswUpdate(idPws, idErr)
{
    var psw = document.getElementById(idPws).value;

    if( psw !== "" )
        checkPsw(idPws, idErr);
}

/**
 *  @description
 *  questa funzione confronta
 *  la psw con pswConf
 *  in fase di 
 *  registrazione
 */

function checkConfPsw(idPswConf, idErr, idPsw)
{
    var psw = document.getElementById(idPsw).value;
    var pswConf = document.getElementById(idPswConf).value;
    var err = document.getElementById(idErr);

    if ( pswConf !== psw ) {
        err.style.fontSize = '0.9em';
        err.style.color = 'darkred';
        err.innerHTML = 'Le password non coincidono';
        return;
    }
}

/**
 *  @description
 *  questa funzione confronta
 *  la psw con pswConf
 *  in fase di 
 *  modifica profilo
 */
function checkConfPswUpdate(idPswConf, idErr, idPsw) 
{
    var psw = document.getElementById(idPsw).value;

    if( psw !== "" )
        checkConfPsw(idPswConf , idErr, idPsw)
}

/**
 *  @description
 *  questa funzione controlla 
 *  il nome in fase di 
 *  registrazione o
 *  modifica profilo
 */
function checkName(idName, idErr) 
{
    var name = document.getElementById(idName).value;
    var err = document.getElementById(idErr);

    if ( notValidString(name, alphaRegex, NameMinLength, NameMaxLength) ) {
        err.style.fontSize = '0.9em';
        err.style.color = 'darkred';
        err.innerHTML = 'Il nome inserito non &egrave; valido';
        return;
    }
}

/**
 *  @description
 *  questa funzione controlla 
 *  il cognome in fase di 
 *  registrazione o
 *  modifica profilo
 */
function checkSurname(idSurname, idErr) 
{
    var surname = document.getElementById(idSurname).value;
    var err = document.getElementById(idErr);

    if ( notValidString(surname, surnameRegex, SurnameMinLength, SurnameMaxLength) ) {
        err.style.fontSize = '0.9em';
        err.style.color = 'darkred';
        err.innerHTML = 'Il cognome inserito non &egrave; valido';
        return;
    }
}

/**
 *  @description
 *  questa funzione controlla 
 *  l'indirizzo in fase di 
 *  registrazione o
 *  modifica profilo
 */
function checkAddress(idAddress, idErr)
{
    var address = document.getElementById(idAddress).value;
    var err = document.getElementById(idErr);

    if ( notValidString(address, addressRegex, StreetMinLength, StreetMaxLength) ) {
        err.style.fontSize = '0.9em';
        err.style.color = 'darkred';
        err.innerHTML = 'L\'indirizzo non &egrave; valido';
        return;
    }
}

/**
 *  @description
 *  questa funzione controlla 
 *  la telefono in fase di 
 *  registrazione 
 */
function checkPhone(idPhone, idErr) 
{
    var phone = document.getElementById(idPhone).value;
    var err = document.getElementById(idErr);

    if ( notValidString(phone, numRegex, PhoneLength, PhoneLength) ) {
        err.style.fontSize = '0.9em';
        err.style.color = 'darkred';
        err.innerHTML =  'Il telefono non &egrave; valido !';
        return;
    }

    checkGenericSingleField(idPhone, idErr);
}

/**
 *  @description
 *  questa funzione controlla 
 *  la telefono in fase di 
 *  modifica profilo
 */
function checkPhoneUpdate(idPhone, idErr, oldValue)
{
    var phone = document.getElementById(idPhone).value;
   
    if( phone !== oldValue )
        checkPhone(idPhone, idErr);
}

/**
 *  @description
 *  questa funzione controlla 
 *  la poto in fase di 
 *  modifica profilo
 */
function checkPhoto(idPhoto, idErr)
{
    var photo = document.getElementById(idPhoto).files[0];
    var err = document.getElementById(idErr);

    var imageFileType = photo['type'].split("/")[1].toLowerCase();
   
    if ( photo['size'] > 1000000 ) {
        err.style.fontSize = '1.5em';
        err.style.color = 'darkred';
        err.innerHTML = 'File troppo grosso';
        return false;
    }
        
    if ( imageFileType !== 'jpg' && imageFileType !== 'png' && imageFileType !== 'jpeg' ) {
        err.style.fontSize = '1.5em';
        err.style.color = 'darkred';
        err.innerHTML = 'Formato della foto non valido';
        return false;
    }

    return true;
}

function checkPhotoUpdate(idPhoto, idErr) 
{
    if ( !checkPhoto(idPhoto,idErr) )
        return;

    var photo = document.getElementById(idPhoto).files[0];
    var tmpPath = URL.createObjectURL(photo);
    //refreshImg(tmpPath + '?' + new Date().getTime());
	listenerPhoto();
}

function listenerPhoto() 
{
    var reader = new FileReader();
    
	reader.onload = function (event) {
        document.getElementById("imgCard").src = event.target.result;
	};
    
	reader.readAsDataURL(document.getElementById("photoModified").files[0]);
}
