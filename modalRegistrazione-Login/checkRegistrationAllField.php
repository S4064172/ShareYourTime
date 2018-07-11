<?php
	require_once('../utils/regexConstant.php');
	require_once('../utils/checkFields.php');
	require_once('../utils/dataBaseConstant.php');
	require_once('../db/insertFunctions.php');
	require_once('../db/connection.php');

	$result = array();
	
	//Contolli sull'username
	if( !check_POST_IsSetAndNotEmpty('usernameReg') || notValidString($_POST['usernameReg'], alphaNumRegex, UserNameMinLength, UserNameMaxLength) )
		$result['errUsername']="L'username insetito non è valido !";
	

	//Controlli sull'email
	if( !check_POST_IsSetAndNotEmpty('emailReg') || notValidString($_POST['emailReg'], emailRegex, EmailMinLength, EmailMaxLength) )
		$result['errEmail']="L'email inserita non è valida !";

	//Controlli sulla password
	if ( !check_POST_IsSetAndNotEmpty('pswReg') || !checkMinLength($_POST['pswReg'], PasswordMinLength) ) {
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
	if( !isset($result['errPsw']) && ( !check_POST_IsSetAndNotEmpty('pswRegConf') ||  $_POST['pswReg']!==$_POST['pswRegConf'] ) ){
		$result['errPswConf']="Le password non corrispondono !";
	}

	//Controlli sul nome
	if(!check_POST_IsSetAndNotEmpty('nameReg') || notValidString($_POST['nameReg'], alphaRegex, NameMinLength, NameMaxLength) ){
		$result['errName']="Il nome inserito non è valido !";
	}

	//Controlli sul cognome
	if( !check_POST_IsSetAndNotEmpty('surnameReg') || notValidString($_POST['surnameReg'], surnameRegex, SurnameMinLength, SurnameMaxLength) ){
		$result['errSurname']="Il cognome inserito non è valido !";
	}
	
	//Controlli sull'indirizzo
	if(!check_POST_IsSetAndNotEmpty('addressReg') || notValidString($_POST['addressReg'], addressRegex, StreetMinLength, StreetMaxLength) ){
		$result['errAddress']="L'indirizzo inserito non è valido !";
	}

	//Controlli sul telefono
	if(!check_POST_IsSetAndNotEmpty('telephoneReg') || notValidString($_POST['telephoneReg'], numRegex, PhoneLength, PhoneLength) ){
		$result['errTelephone']="Il telefono inserito non è valido !";
	}

	//Controlli sulla foto 
	$path = '../../profile_imgs/' . /*$_POST['usernameReg']*/'aaaa' . '.jpg';
	
	$imageFileType = strtolower(pathinfo($_FILES['photoReg']['name'], PATHINFO_EXTENSION));

	if ( $_FILES['photoReg']['size'] > 1000000 ) 
    	$result['errPhoto'] = "File troppo grosso";
	else 
		if ( $imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg' ) 
			$result['errPhoto'] = 'Formato della foto non valido';
		else
			if ( !move_uploaded_file($_FILES['photoReg']['tmp_name'], $path) ) 
				$result['errPhoto'] = basename( $_FILES['photoReg']['name']). ' non e\' stato caricato.';

	//Fine dei controlli --> inserimento nel database
	if( count($result) == 0 ){
		session_start();
		$_SESSION['user'] = $_POST['usernameReg'];
		insertInto_ShareYourUserTime(	$_POST['usernameReg'], $_POST['pswReg'],
										$_POST['nameReg'], $_POST['surnameReg'],
										$_POST['telephoneReg'], $_POST['emailReg'],
										$_POST['addressReg'], "../profile_img/dddd.jpg");
	}

	echo json_encode($result);

