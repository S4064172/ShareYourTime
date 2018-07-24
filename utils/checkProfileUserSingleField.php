<?php

/*
	questa php controlla l'esistenza 
	del campo passato nel db. Tramite
	json comunica l'esito del controllo.

	code:
		-2 -> nessun controllo fatto;
		-1 -> presenza nel db;
		 0 -> assenza nel db;
*/
	require_once("../utils/utils.php");	
	require_once("../utils/constant.php");
	require_once("../db/connection.php");
	

	//Controlli sull'username
	if( check_POST_IsSetAndNotEmpty('user') ) { 
		
		if ( checkIfExistInDb('user', $_POST['user']) ) {
			echo json_encode(array('code' => -1, 'msg' => 'Username gi&agrave; presente'));
			return;
		}

		echo json_encode(array('code' => 0));
		return;
	}

	//Controlli sull'email
	if( check_POST_IsSetAndNotEmpty('email') ) {
		if ( checkIfExistInDb('email', $_POST['email']) ) {
			echo json_encode(array('code' => -1, 'msg' => 'Email gi&agrave; presente'));
			return;
		} 

		echo json_encode(array('code' => 0));
		return;
	}

	//Controlli sul telefono
	if( check_POST_IsSetAndNotEmpty('phone') ){
		
		if ( checkIfExistInDb('phone', $_POST['phone']) ) {
			echo json_encode(array('code' => -1, 'msg' => 'Questo telefono &egrave; gi&agrave; presente' ));
			return;
		}

		echo json_encode(array('code' => 0));
		return;
	}

	echo json_encode(array('code' => -2));
