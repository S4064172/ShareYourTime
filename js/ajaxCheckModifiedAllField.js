"use strict";

/** @description
*	Questa funzione ci permette di creare 
*	una richiesta in post per controllare
*	i campi che l'utente ha inserito.  
*	Viene utilizzata una chiamata ajax
*	per rimanere nella stessa pagina.
*/

function checkModifiedAllField(idWait,userCheck,mailCheck,phoneCheck)
{
    showItem(idWait); 
	var request = getRequest();
    request.open("POST", "utils/checkGenericAllField.php", true);	
	request.onreadystatechange = validateCheckGenericAllField(idWait, request);
	
    var formData = new FormData();
	var htmlTagUser = document.getElementById('userModified');
    var htmlTagEmail = document.getElementById('emailModified');
    var htmlTagPsw = document.getElementById('pswModified');
  	var htmlTagName = document.getElementById('nameModified');
    var htmlTagSurname = document.getElementById('surnameModified');
    var htmlTagAddress = document.getElementById('addressModified');
	var htmlTagPhone = document.getElementById('phoneModified');
	var htmlTagPhoto = document.getElementById('photoModified');
    
	formData.append(htmlTagPhoto.name, htmlTagPhoto.files[0]);
	formData.append(htmlTagUser.name, htmlTagUser.value);
    formData.append(htmlTagEmail.name, htmlTagEmail.value);
    formData.append(htmlTagPsw.name, htmlTagPsw.value);
    formData.append(htmlTagName.name, htmlTagName.value);
    formData.append(htmlTagSurname.name, htmlTagSurname.value);
    formData.append(htmlTagAddress.name, htmlTagAddress.value);
    formData.append(htmlTagPhone.name, htmlTagPhone.value);
    formData.append('checkUser', userCheck);
    formData.append('checkEmail', mailCheck);
    formData.append('checkPhone', phoneCheck);
    
    formData.append("registration", 1);

	request.send(formData);
}


