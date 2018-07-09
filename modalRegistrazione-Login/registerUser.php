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
	foreach ($_POST as $key => $value)
		if ( !check_POST_NotIsSetOrEmpty($key) ) {
			$result[$key]="campo vuoto !---";
			return;
		}

	//username
	if( notValidString($_POST['usernameReg'], alphaNumRegex, UserNameMinLength, UserNameMaxLength) ){
		//$result['code'] = -1;
		$result['errUsername']="username non valido !---";
	}

	//email
	if( notValidString($_POST['emailReg'], emailRegex, EmailMinLength, EmailMaxLength) ){
		//$result['code'] = -1;
		$result['errEmail']="email non valida !---";
	}

	//password
	if ( !checkMinLength($_POST['pswReg'], PasswordMinLength) ) {
		$result['errPsw']="password non valida !---";
	}

	foreach(passwordRegex as $regex) {
		if ( !checkMatchRegex($_POST['pswReg'], $regex) ) {
			$result['errPsw']="password non valida !---";
			break;
		}
	}

	//password Conf
	if( !isset($result['errPsw']) && $_POST['pswReg']!==$_POST['pswRegConf'] ){
		$result['errPswConf']="password non valida !---";
	}

	//nome
	if( notValidString($_POST['nameReg'], alphaRegex, NameMinLength, NameMaxLength) ){
		$result['errName']="nome non valida !---";
	}

	//cognome
	if( notValidString($_POST['surnameReg'], surnameRegex, SurnameMinLength, SurnameMaxLength) ){
		$result['errSurname']="cognome non valida !---";
	}

	//indirizzo
	if( notValidString($_POST['addressReg'], alphaNumRegex, StreetMinLength, StreetMaxLength) ){
		$result['errAddress']="indirizzo non valida !---";
	}

	//telefono
	if( notValidString($_POST['telephoneReg'], numRegex, PhoneLength, PhoneLength) ){
		$result['errTelephone']="telefono non valida !---";
	}
	

	echo json_encode($result);



	$conn = selectionDB();
	//user
	$_POST['usernameReg']=sanitizeToSql($_POST['usernameReg'], $conn);
	//mail
	$_POST['emailReg']=sanitizeToSql($_POST['emailReg'], $conn);
	//pws
	$_POST['pswReg']=sanitizeToSql($_POST['pswReg'], $conn);
	//nome
	$_POST['nameReg']=sanitizeToSql($_POST['nameReg'], $conn);
	//cognome
	$_POST['surnameReg']=sanitizeToSql($_POST['surnameReg'], $conn);
	//indirizzo
	$_POST['addressReg']=sanitizeToSql($_POST['addressReg'], $conn);
	//telefono
	$_POST['telephoneReg']=sanitizeToSql($_POST['telephoneReg'], $conn);
	//foto
	//$_POST['photoReg']=sanitizeToSql($_POST['photoReg'], $conn);


