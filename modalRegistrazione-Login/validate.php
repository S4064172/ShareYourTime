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

	echo json_encode(array('code' => -2));