<?php

/*
 * In questo file vengono effuati i
 * controlli sui singoli campi che 
 * l'utente inserisce man mano
 * che compila il form di registrazione
 * che di modifica campi
*/
	require_once("../utils/checkFields.php");	
	require_once("../utils/regexConstant.php");
	require_once("../db/connection.php");
	require_once("../utils/dataBaseConstant.php");
	

	//Controlli sull'username
	if( check_POST_IsSetAndNotEmpty('user') ) { 
		
		if ( checkIfExistInDb('user', $_POST['user']) ) {
			echo json_encode(array('code' => -1, 'msg' => 'Username gi&agrave; presente !'));
			return;
		}

		echo json_encode(array('code' => 0));
		return;
	}

	//Controlli sull'email
	if( check_POST_IsSetAndNotEmpty('email') ) {
		if ( checkIfExistInDb('email', $_POST['email']) ) {
			echo json_encode(array('code' => -1, 'msg' => 'Email gi&agrave; presente !'));
			return;
		} 

		echo json_encode(array('code' => 0));
		return;
	}

	//Controlli sul telefono
	if( check_POST_IsSetAndNotEmpty('phone') ){
		
		if ( checkIfExistInDb('phone', $_POST['phone']) ) {
			echo json_encode(array('code' => -1, 'msg' => 'Questo telefono gi&agrave; presente !' ));
			return;
		}

		echo json_encode(array('code' => 0));
		return;
	}


	echo json_encode(array('code' => -2));
