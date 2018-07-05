<?php
	require_once("../utils/checkFields.php");	

	header("Content-Type: application/json");

	if(check_POST_NotIsSetOrEmpty('usernameReg') ){
		if ( !check_StringLength($_POST['usernameReg'], 15, 25) ) {
				echo json_encode(array('code' => -1 , 'msg' => 'Username non valido' ));
				
				return;
		}
		echo json_encode(array('code' => 0, msg => 'Username ok'));
		return;
	}

	if(check_POST_NotIsSetOrEmpty('emailReg') ){
		if ( !check_StringLength($_POST['emailReg'], 15, 25) ) {
				echo json_encode(array('code' => -1 ,'msg' => 'Email non valida' ));
				return;
		}
		echo json_encode(array('code' => 0, msg => 'Email ok'));
		return;
	}

	if(check_POST_NotIsSetOrEmpty('pswReg') ){
		if ( !check_StringLength($_POST['pswReg'], 15, 25) ) {
				echo json_encode(array('code' => -1 ,'msg' => 'Password non valida' ));
				return;
		}
		echo json_encode(array('code' => 0, 'msg' => 'Password ok'));
		return;
	}

	if(check_POST_NotIsSetOrEmpty('pswRegConf') ){
		if ( !check_POST_NotIsSetOrEmpty('pswRegc') || $_POST['pswRegConf']!==$_POST['pswRegc'] ) {
				echo json_encode(array('code' => -1 ,'msg' => 'PasswordComf non valida' ));
				return;
		}
		echo json_encode(array('code' => 0, 'msg' => 'PasswordConf ok'));
		return;
	}

	if(check_POST_NotIsSetOrEmpty('nameReg') ){
		if ( !check_StringLength($_POST['nameReg'], 15, 25) ) {
			echo json_encode(array('code' => -1 ,'msg' => 'Nome non valido' ));
			return;
		}
		echo json_encode(array('code' => 0, 'msg' => 'Nome ok'));
		return;
	}

	if(check_POST_NotIsSetOrEmpty('surnameReg') ){
		if ( !check_StringLength($_POST['surnameReg'], 15, 25) ) {
			echo json_encode(array('code' => -1 ,'msg' => 'Cognome non valido' ));
			return;
		}
		echo json_encode(array('code' => 0, 'msg' => 'Cognome ok'));
		return;
	}

	if(check_POST_NotIsSetOrEmpty('addressReg') ){
		if ( !check_StringLength($_POST['addressReg'], 15, 25) ) {
			echo json_encode(array('code' => -1 ,'msg' => 'Indirizzo non valido' ));
			return;
		}
		echo json_encode(array('code' => 0, 'msg' => 'Indirizzo ok'));
		return;
	}

	if(check_POST_NotIsSetOrEmpty('telephoneReg') ){
		if ( !check_StringLength($_POST['telephoneReg'], 15, 25) ) {
			echo json_encode(array('code' => -1 ,'msg' => 'Telefono non valido' ));
			return;
		}
		echo json_encode(array('code' => 0, 'msg' => 'Telefono ok'));
		return;
	}

	echo json_encode(array('code' => -2));