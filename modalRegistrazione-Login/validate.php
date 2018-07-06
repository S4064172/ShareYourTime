<?php
	require_once("../utils/checkFields.php");	
	require_once("../utils/regexConstant.php");
	header("Content-Type: application/json");
	
	if(check_POST_NotIsSetOrEmpty('usernameReg') ){
		if ( !checkMatchRegex($_POST['usernameReg'], alphaNumRegex) ) {
				echo json_encode(array('code' => -1 , 'msg' => 'Username: alphaNumRegex' ));
				
				return;
		}
		echo json_encode(array('code' => 0));
		return;
	}

	if(check_POST_NotIsSetOrEmpty('emailReg') ){
		if ( !checkMatchRegex($_POST['emailReg'],emailRegex) ) {
				echo json_encode(array('code' => -1 ,'msg' => 'Email: emailRegex' ));
				return;
		}
		echo json_encode(array('code' => 0));
		return;
	}

	if(check_POST_NotIsSetOrEmpty('pswReg') ){
		if ( !checkMatchRegex($_POST['emailReg'],alphaNumRegex) ) {
				echo json_encode(array('code' => -1 ,'msg' => 'Password: manca regex' ));
				return;
		}
		echo json_encode(array('code' => 0));
		return;
	}

	if(check_POST_NotIsSetOrEmpty('pswRegConf') ){
		if ( !check_POST_NotIsSetOrEmpty('pswRegc') || $_POST['pswRegConf']!==$_POST['pswRegc'] ) {
				echo json_encode(array('code' => -1 ,'msg' => 'Password diverse' ));
				return;
		}
		echo json_encode(array('code' => 0));
		return;
	}

	if(check_POST_NotIsSetOrEmpty('nameReg') ){
		if ( !checkMatchRegex($_POST['nameReg'],alphaRegex) ) {
			echo json_encode(array('code' => -1 ,'msg' => 'Nome: nameReg' ));
			return;
		}
		echo json_encode(array('code' => 0));
		return;
	}

	if(check_POST_NotIsSetOrEmpty('surnameReg') ){
		if ( !checkMatchRegex($_POST['surnameReg'],surnameRegex) ) {
			echo json_encode(array('code' => -1 ,'msg' => 'Cognome:surnameRegex' ));
			return;
		}
		echo json_encode(array('code' => 0));
		return;
	}

	if(check_POST_NotIsSetOrEmpty('addressReg') ){
		if ( !checkMatchRegex($_POST['addressReg'],alphaNumRegex) ) {
			echo json_encode(array('code' => -1 ,'msg' => 'Indirizzo:alphaNumRegex ' ));
			return;
		}
		echo json_encode(array('code' => 0));
		return;
	}

	if(check_POST_NotIsSetOrEmpty('telephoneReg') ){
		if ( !checkMatchRegex($_POST['telephoneReg'],numRegex) ) {
			echo json_encode(array('code' => -1 ,'msg' => 'Telefono: numRegex' ));
			return;
		}
		echo json_encode(array('code' => 0));
		return;
	}

	echo json_encode(array('code' => -2));