"use strict";



/** @description
*	Questa funzione ci permette di creare 
*	una richiesta in post per controllare
*	i campi che l'utente ha inserito.  
*	Viene utilizzata una chiamata ajax
*	per rimanere nella stessa pagina.
*/
function checkRegistrationAllField(idWait)
{
	showItem(idWait)
	var request = getRequest();
	request.open("POST", "utils/checkGenericAllField.php", true);	
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
}


