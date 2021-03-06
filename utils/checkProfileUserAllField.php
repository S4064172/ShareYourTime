<?php
	require_once('../utils/constant.php');
	require_once('../utils/utils.php');
	require_once('../db/updataFunctions.php');
	require_once('../db/insertFunctions.php');
	require_once('../db/connection.php');

	$result = array();

	//Contolli sull'username
	if( !check_POST_IsSetAndNotEmpty('user') 
		|| notValidString($_POST['user'], alphaNumRegex, UserNameMinLength, UserNameMaxLength) 
		|| checkIfExistInDb('user', $_POST['user']) )
		if( $_POST['registration'] === '0' )
			$result['errUsername'] = "L'username inserito non &egrave; valido";
		else
			if($_POST['user'] !== $_POST['checkUser'])
				$result['errUserModified'] = "L'username inserito non &egrave; valido";

	//Controlli sull'email
	if( !check_POST_IsSetAndNotEmpty('email') 
		|| notValidString($_POST['email'], emailRegex, EmailMinLength, EmailMaxLength)
		|| checkIfExistInDb('email', $_POST['email']) )
		if( $_POST['registration'] === '0' )
			$result['errEmail'] = "L'email inserita non &egrave; valida";
		else
			if( $_POST['email'] !== $_POST['checkEmail'] )
				$result['errEmailModified'] = "L'email inserita non &egrave; valida";


	//Controlli sulla password
	if ( !check_POST_IsSetAndNotEmpty('psw') || !checkMinLength($_POST['psw'], PasswordMinLength) ) 
		if( $_POST['registration'] === '0' )
			$result['errPsw'] = "La password inserita non &egrave; valida";
		
	foreach(passwordRegex as $regex) {
		if ( !checkMatchRegex($_POST['psw'], $regex) ) {
			if( $_POST['registration'] === '0' )
				$result['errPsw'] = "La password inserita non &egrave; valida";
			else
				if( !empty($_POST['psw']) )
					$result['errPswModified'] = "La password inserita non &egrave; valida";
			break;
		}
	}

	//Controlli sulla password di conferma
	//vengono effettuati solo se i controlli
	//sulla password sono passati con successo
	if( !isset($result['err']) && (!check_POST_IsSetAndNotEmpty('pswConf') ||  $_POST['psw']!==$_POST['pswConf']) ) {
		if( $_POST['registration'] === '0' )
			$result['errPswConf'] = "Le password non corrispondono";
	}

	//Controlli sul nome
	if( !check_POST_IsSetAndNotEmpty('name') || notValidString($_POST['name'], alphaRegex, NameMinLength, NameMaxLength) ) {
		if( $_POST['registration'] === '0' )
			$result['errName'] = "Il nome inserito non &egrave; valido";
		else
			$result['errNameModified'] = "Il nome inserito non &egrave; valido";
	}

	//Controlli sul cognome
	if( !check_POST_IsSetAndNotEmpty('surname') || notValidString($_POST['surname'], surnameRegex, SurnameMinLength, SurnameMaxLength) ) {
		if( $_POST['registration'] === '0' )
			$result['errSurname'] = "Il cognome inserito non &egrave; valido1";
		else
			$result['errSurnameModified'] = "Il cognome inserito non &egrave; valido2";
	}
	
	//Controlli sull'indirizzo
	if( !check_POST_IsSetAndNotEmpty('address') || notValidString($_POST['address'], addressRegex, StreetMinLength, StreetMaxLength) ) {
		if( $_POST['registration'] === '0' )
			$result['errAddress'] = "L'indirizzo inserito non &egrave; valido";
		else
			$result['errAddressModified'] = "L'indirizzo inserito non &egrave; valido";
	}

	//Controlli sul telefono
	if( !check_POST_IsSetAndNotEmpty('phone') 
		|| notValidString($_POST['phone'], numRegex, PhoneLength, PhoneLength)
		|| checkIfExistInDb('phone', $_POST['phone']) ) {
		if( $_POST['registration'] === '0' )
			$result['errTelephone'] = "Il telefono inserito non &egrave; valido";
		else
			if( $_POST['phone'] !== $_POST['checkPhone'] )
				$result['errPhoneModified'] = "Il telefono inserito non &egrave; valido";
	}


	if( empty($_FILES) ) {
		if($_POST['registration'] === '0')
			$result['errPhoto'] = "File non valido";
	} else {
		//Controlli sulla foto 
		$path = '../../profile_imgs/' . $_POST['user']. '.jpg';
		
		$imageFileType = exif_imagetype($_FILES['photo']['tmp_name']);

		if ( $_FILES['photo']['size'] > 1000000 )
			if($_POST['registration'] === '0') 
				$result['errPhoto'] = "File troppo grosso";
			else
				$result['errPhotoModified'] = "File troppo grosso";
		else 
			if ( $imageFileType !== IMAGETYPE_PNG && $imageFileType !== IMAGETYPE_JPEG ) 
				if($_POST['registration'] === '0')
					$result['errPhoto'] = 'Formato della foto non valido';
				else
					$result['errPhotoModified'] = 'Formato della foto non valido';
			else
				if ( !move_uploaded_file($_FILES['photo']['tmp_name'], $path) ) 
					if( $_POST['registration'] === '0' )
						$result['errPhoto'] = basename( $_FILES['photo']['name']). ' non &egrave; stato caricato';
					else
						$result['errPhotoModified'] = basename( $_FILES['photo']['name']). ' non &egrave; stato caricato';
	}
	

	//Fine dei controlli --> inserimento nel database
	if( count($result) === 0 ) {
		if( $_POST['registration'] === '0' ) { 
			session_start();
			$_SESSION['user'] = $_POST['user'];
				insertInto_ShareYourUserTime(	$_POST['user'], $_POST['psw'],
												$_POST['name'], $_POST['surname'],
												$_POST['phone'], $_POST['email'],
												$_POST['address'], $path);
			$result = $_POST['registration'];
			} else {
				if( !check_POST_IsSetAndNotEmpty('psw') )
					$_POST['psw'] = NULL;
					
				updataInto_ShareYourUserTime(	$_POST['user'], $_POST['psw'],
												$_POST['name'], $_POST['surname'],
												$_POST['phone'], $_POST['email'],
												$_POST['address'], $_POST['checkUser'], $_FILES);
				$result = $_POST['registration'];
				session_start();
				session_unset();
				session_destroy();
				session_start();
				$_SESSION['user'] = $_POST['user'];
			}
	}

	echo json_encode($result);

