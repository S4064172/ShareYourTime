<?php
	require_once('../utils/regexConstant.php');
	require_once('../utils/checkFields.php');
	require_once('../utils/dataBaseConstant.php');
	require_once('../db/insertFunctions.php');

	/*
	 *	RIPETERE TUTTI I CONTROLLI DI LUNGHEZZA E DI REGEX, SE TUTTO A POSTO CHIAMARE INSERT_USER
	 *	FARE PARTIRE LA SESSIONE E REINDIRIZZARE VERSO LA HOMEPAGE
	 */	

	foreach ($_POST as $key => $value)
		if ( !check_POST_NotIsSetOrEmpty($key) ) {
				echo($key.' non e\' presente');
				return;
		}

	//Username
	if ( notValidString($_POST['usernameReg'], alphaNumRegex, UserNameMinLength, UserNameMaxLength) )
		echo('Username non valido');

	//Email
	if ( notValidString($_POST['emailReg'], emailRegex, EmailMinLength, EmailMaxLength) )
		echo('Email non valida');

	//Password
	if ( !notValidString($_POST['pswReg'], "/.*/", PasswordMinLength, PasswordMaxLength) ) {
		foreach(passwordRegex as $regex)
			if ( !checkMatchRegex($_POST['pswReg'], $regex) ) {
				echo('Passoword non valida');
				break;
			}
	} else {
		echo('Password non valida');
	}

	if ( $_POST['pswRegConf'] !== $_POST['pswReg'] )
			echo('Le password sono diverse');

	//Name
	if ( notValidString($_POST['surnameReg'], surnameRegex, SurnameMinLength, SurnameMaxLength) ) 
		echo('Nome non valido');

	//Surname
	if ( notValidString($_POST['surnameReg'], surnameRegex, SurnameMinLength, SurnameMaxLength) )
		echo('Cognome non valido');

	//Address
	if ( notValidString($_POST['addressReg'], alphaNumRegex, StreetMinLength, StreetMaxLength) )
		echo('Indirizzo non valido');

	//Phone
	if ( notValidString($_POST['telephoneReg'], numRegex, PhoneLength, PhoneLength) )
		echo('Telefono non valido');

	//Photo
	$path = '../../profile_imgs/' . $_POST['usernameReg'] . '.jpg';
	$imageFileType = strtolower(pathinfo($path, PATHINFO_EXTENSION));
	
	if ( $_FILES['photoReg']['size'] > 1000000 ) {
    	echo('File troppo grosso');
	} 
	
	if ( $imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg' ) {
    	echo('Formato della foto non valido');
	} 

	if ( !move_uploaded_file($_FILES['photoReg']['tmp_name'], $path) ) 
		echo(basename( $_FILES['photoReg']['name']). ' non e\' stato caricato.');

	echo 'file name = ' . $path . '<br>tmp name = '.  $_FILES['photoReg']['tmp_name'] . '<br>';

	echo $_POST['usernameReg'].'<br>'. $_POST['pswReg'].'<br>'. $_POST['nameReg'].'<br>'. $_POST['surnameReg'].'<br>'.$_POST['telephoneReg'].'<br>'. $_POST['emailReg'].'<br>'. $_POST['addressReg'].'<br>'.$path.'<br>';

	insertInto_ShareYourUserTime($_POST['usernameReg'], $_POST['pswReg'], $_POST['nameReg'], $_POST['surnameReg'],
						 		 $_POST['telephoneReg'], $_POST['emailReg'], $_POST['addressReg'], $path);

