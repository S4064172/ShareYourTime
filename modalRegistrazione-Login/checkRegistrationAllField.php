<?php
	require_once('../utils/regexConstant.php');
	require_once('../utils/checkFields.php');
	require_once('../utils/dataBaseConstant.php');
	require_once('../db/insertFunctions.php');
	require_once('../db/connection.php');


	/*
	 *	Controlli da fare :
	 *		-Manca contollo foto
	 *		-manca inserimento
	 */	

	$result = array();
	
	//Contolli sull'username
	if( !check_POST_IsSetAndNotEmpty('usernameReg') || notValidString($_POST['usernameReg'], alphaNumRegex, UserNameMinLength, UserNameMaxLength) )
		$result['errUsername']="L'username insetito non è valido !";
	

	//Controlli sull'email
	if( !check_POST_IsSetAndNotEmpty('usernameReg') || notValidString($_POST['emailReg'], emailRegex, EmailMinLength, EmailMaxLength) )
		$result['errEmail']="L'email inserita non è valida !";

	//Controlli sulla password
	if ( !check_POST_IsSetAndNotEmpty('usernameReg') || !checkMinLength($_POST['pswReg'], PasswordMinLength) ) {
		$result['errPsw']="La password inserita non è valida !";
	}

	foreach(passwordRegex as $regex) {
		if ( !checkMatchRegex($_POST['pswReg'], $regex) ) {
			$result['errPsw']="La password inserita non è valida !";
			break;
		}
	}

	//Controlli sulla password di conferma
	//vengono effettuati solo si i controlli
	//sulla password sono passati con successo
	if( !isset($result['errPsw']) && ( !check_POST_IsSetAndNotEmpty('usernameReg') ||  $_POST['pswReg']!==$_POST['pswRegConf'] ) ){
		$result['errPswConf']="Le password non corrispondono !";
	}

	//Controlli sul nome
	if(!check_POST_IsSetAndNotEmpty('usernameReg') || notValidString($_POST['nameReg'], alphaRegex, NameMinLength, NameMaxLength) ){
		$result['errName']="Il nome inserito non è valido !";
	}

	//Controlli sul cognome
	if( !check_POST_IsSetAndNotEmpty('usernameReg') || notValidString($_POST['surnameReg'], surnameRegex, SurnameMinLength, SurnameMaxLength) ){
		$result['errSurname']="Il cognome inserito non è valido !";
	}

	//Controlli sull'indirizzo
	if(!check_POST_IsSetAndNotEmpty('usernameReg') || notValidString($_POST['addressReg'], alphaNumRegex, StreetMinLength, StreetMaxLength) ){
		$result['errAddress']="L'indirizzo inserito non è valido !";
	}

	//Controlli sul telefono
	if(!check_POST_IsSetAndNotEmpty('usernameReg') || notValidString($_POST['telephoneReg'], numRegex, PhoneLength, PhoneLength) ){
		$result['errTelephone']="Il telefono inserito non è valido !";
	}
	

	echo json_encode($result);



	$conn = connectionToDb();
	
	//Sanitizzazione input
	$_POST['usernameReg']=sanitizeToSql($_POST['usernameReg'], $conn);
	$_POST['emailReg']=sanitizeToSql($_POST['emailReg'], $conn);
	$_POST['pswReg']=sanitizeToSql($_POST['pswReg'], $conn);
	$_POST['nameReg']=sanitizeToSql($_POST['nameReg'], $conn);
	$_POST['surnameReg']=sanitizeToSql($_POST['surnameReg'], $conn);
	$_POST['addressReg']=sanitizeToSql($_POST['addressReg'], $conn);
	$_POST['telephoneReg']=sanitizeToSql($_POST['telephoneReg'], $conn);
	//$_POST['photoReg']=sanitizeToSql($_POST['photoReg'], $conn);


