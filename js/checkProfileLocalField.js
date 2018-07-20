"use strict";


function checkUsername(idUser, idErr){

    var user = document.getElementById(idUser).value;
    var err = document.getElementById(idErr);
   
    if ( !checkMinLength(user, UserNameMinLength) || !checkMaxLength(user, UserNameMaxLength) ) {
        err.style.fontSize = '0.9em';
        err.style.color = 'darkred';
        err.innerHTML = 'L\'username deve essere compreso tra i 5 e i 25 caratteri !';
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

function checkUsernameUpdate(idUser, idErr, oldValue){
    
    var user = document.getElementById(idUser).value;
   
    if( user !== oldValue)
        checkUsername(idUser, idErr);
}



function checkEmail(idEmail, idErr){

    var email = document.getElementById(idEmail).value;
    var err = document.getElementById(idErr)

    if ( notValidString(email, emailRegex, EmailMinLength, EmailMaxLength) ) {
        err.style.fontSize = '0.9em';
        err.style.color = 'darkred';
        err.innerHTML = 'email non valida';
        return;
    }

    checkGenericSingleField(idEmail, idErr);
}

function checkEmailUpdate(idEmail, idErr, oldValue){
    
    var email = document.getElementById(idEmail).value;

    if(  email !== oldValue)
        checkEmail(idEmail, idErr);
}

function checkPsw(idPws, idErr){

    var psw = document.getElementById(idPws).value;
    var err = document.getElementById(idErr);

    if ( !checkMinLength(psw, PasswordMinLength) ) {
        err.style.fontSize = '0.9em';
        err.style.color = 'darkred';
        err.innerHTML = 'Password deve essere almeno di 8';
        return;
    }
       
    
/*
    foreach(passwordRegex as $regex) {
        if ( !checkMatchRegex($_POST['psw'], $regex) ) {
            echo json_encode(array('code' => -1, 'msg' => 'La password deve contenere almeno una lettera minuscola, una maiuscola, un numero e un carattere speciale.'));
            return;
        }
    }
*/
}

function checkConfPws(idPwsConf , idErr, idPws ){

    var psw = document.getElementById(idPws).value;
    var pswConf = document.getElementById(idPwsConf).value;
    var err = document.getElementById(idErr);

    if ( pswConf !== psw ) {
        err.style.fontSize = '0.9em';
        err.style.color = 'darkred';
        err.innerHTML = 'Le password non coincidono';
        return;
    }
}

function checkName(idName , idErr){

    var name = document.getElementById(idName).value;
    var err = document.getElementById(idErr);

    if ( notValidString(name, alphaRegex, NameMinLength, NameMaxLength) ) {
        err.style.fontSize = '0.9em';
        err.style.color = 'darkred';
        err.innerHTML = 'Il nome inserito non &egrave; valido';
        return;
    }
}

function checkSurname(idSurname , idErr){

    var surname = document.getElementById(idSurname).value;
    var err = document.getElementById(idErr);

    if ( notValidString(surname, surnameRegex, SurnameMinLength, SurnameMaxLength) ) {
        err.style.fontSize = '0.9em';
        err.style.color = 'darkred';
        err.innerHTML = 'Il congnome inserito non &egrave; valido';
        return;
    }
}

function checkAddress(idAddress , idErr){

    var address = document.getElementById(idAddress).value;
    var err = document.getElementById(idErr);

    if ( notValidString(address, addressRegex, StreetMinLength, StreetMaxLength) ) {
        err.style.fontSize = '0.9em';
        err.style.color = 'darkred';
        err.innerHTML = 'L\'indirizzo non &egrave; valido';
        return;
    }
}


function checkPhone(idPhone, idErr){

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

function checkPhoneUpdate(idPhone, idErr,oldValue){

    var phone = document.getElementById(idPhone).value;
   

    if(  phone !== oldValue)
        checkPhone(idPhone, idErr);

}


function checkPhoto(idPhoto,idErr,oldValue){

    var photo = document.getElementById(idPhoto).files[0];
    var err = document.getElementById(idErr);

    //var imageFileType = pathinfo(photo['name'], PATHINFO_EXTENSION).toLowerCase();

    var path = '../profile_imgs/' +oldValue+'_temp.jpg';

    if ( photo['size'] > 1000000 ){
        err.style.fontSize = '0.9em';
        err.style.color = 'darkred';
        err.innerHTML = 'File troppo grosso';
        return;
    }
        
    /*if ( imageFileType != 'jpg' && imageFileType != 'png' && imageFileType != 'jpeg' ) {
        err.style.fontSize = '0.9em';
        err.style.color = 'darkred';
        err.innerHTML = 'Formato della foto non valido';
        return;
    }*/

   /* if ( !move_uploaded_file(photo['tmp_name'], '../'.path) ){
        err.style.fontSize = '0.9em';
        err.style.color = 'darkred';
        err.innerHTML = basename( photo['name']) + ' non e\' stato caricato.';
        return;	
    }*/
    //refreshImg("../"+path+'?'+new Date().getTime());
    return;
}