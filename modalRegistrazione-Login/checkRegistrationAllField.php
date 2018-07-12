<?php
	require_once('../utils/regexConstant.php');
	require_once('../utils/checkFields.php');
	require_once('../utils/dataBaseConstant.php');
	require_once('../db/insertFunctions.php');
	require_once('../db/connection.php');

	$result = array();
	
	//Contolli sull'username
	if( !check_POST_IsSetAndNotEmpty('user') || notValidString($_POST['user'], alphaNumRegex, UserNameMinLength, UserNameMaxLength) )
		$result['errUsername']="L'username insetito non è valido !";
	

	//Controlli sull'email
	if( !check_POST_IsSetAndNotEmpty('email') || notValidString($_POST['email'], emailRegex, EmailMinLength, EmailMaxLength) )
		$result['errEmail']="L'email inserita non è valida !";

	//Controlli sulla password
	if ( !check_POST_IsSetAndNotEmpty('psw') || !checkMinLength($_POST['psw'], PasswordMinLength) ) {
		$result['errPsw']="La password inserita non è valida !";
	}

	foreach(passwordRegex as $regex) {
		if ( !checkMatchRegex($_POST['psw'], $regex) ) {
			$result['errPsw']="La password inserita non è valida !";
			break;
		}
	}

	//Controlli sulla password di conferma
	//vengono effettuati solo si i controlli
	//sulla password sono passati con successo
	if( !isset($result['err']) && ( !check_POST_IsSetAndNotEmpty('pswConf') ||  $_POST['psw']!==$_POST['pswConf'] ) ){
		$result['errPswConf']="Le password non corrispondono !";
	}

	//Controlli sul nome
	if(!check_POST_IsSetAndNotEmpty('name') || notValidString($_POST['name'], alphaRegex, NameMinLength, NameMaxLength) ){
		$result['errName']="Il nome inserito non è valido !";
	}

	//Controlli sul cognome
	if( !check_POST_IsSetAndNotEmpty('surname') || notValidString($_POST['surname'], surnameRegex, SurnameMinLength, SurnameMaxLength) ){
		$result['errSurname']="Il cognome inserito non è valido !";
	}
	
	//Controlli sull'indirizzo
	if(!check_POST_IsSetAndNotEmpty('address') || notValidString($_POST['address'], addressRegex, StreetMinLength, StreetMaxLength) ){
		$result['errAddress']="L'indirizzo inserito non è valido !";
	}

	//Controlli sul telefono
	if(!check_POST_IsSetAndNotEmpty('telephone') || notValidString($_POST['telephone'], numRegex, PhoneLength, PhoneLength) ){
		$result['errTelephone']="Il telefono inserito non è valido !";
	}

	if(!check_POST_IsSetAndNotEmpty($_POST['photo'])){
		$result['errPhoto'] = "File non valido";
	}else{
		//Controlli sulla foto 
		$path = '../../profile_imgs/' . $_POST['user'] . '.jpg';
		
		$imageFileType = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));

		if ( $_FILES['photo']['size'] > 1000000 ) 
			$result['errPhoto'] = "File troppo grosso";
		else 
			if ( $imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg' ) 
				$result['errPhoto'] = 'Formato della foto non valido';
			else
				if ( !move_uploaded_file($_FILES['photo']['tmp_name'], $path) ) 
					$result['errPhoto'] = basename( $_FILES['photo']['name']). ' non e\' stato caricato.';

	}
	

	//Fine dei controlli --> inserimento nel database
	if( count($result) == 0 ){
		session_start();
		$_SESSION['user'] = $_POST['user'];
		insertInto_ShareYourUserTime(	$_POST['user'], $_POST['psw'],
										$_POST['name'], $_POST['surname'],
										$_POST['telephone'], $_POST['email'],
										$_POST['address'], $path);
	}

	echo json_encode($result);

