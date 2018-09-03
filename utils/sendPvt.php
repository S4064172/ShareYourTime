<?php
    if ( session_status() == PHP_SESSION_NONE ) {
        session_start();
	}
	
	if ( !isset($_SESSION['user']) || empty($_SESSION['user']) ) {
       header("Location: ../index/index.php");
	}

	define('err', 'errMsg');

    require_once('utils.php');
	require_once('../db/insertFunctions.php');
	require_once('../db/updataFunctions.php');

	if ( !check_POST_IsSetAndNotEmpty('receiver') || !checkIfExistInDb('User', $_POST['receiver']) ) {
				echo json_encode(array('errMsg' => 'Il contatto non e\' corretto', 'errId' => err));
				return;		
	}

	if ( !check_POST_IsSetAndNotEmpty('op') || $_POST['op'] !== 'onlychat') {
			if ( !check_POST_IsSetAndNotEmpty('text') ) {
				echo json_encode(array('errMsg' => 'Il testo del messaggio non e\' stato inviato correttamente', 'errId' => err));
				return;		
			}
			
			if ( !check_POST_IsSetAndNotEmpty('obj') ) {
				echo json_encode(array('errMsg' => 'L\'oggetto del messaggio non e\' stato inviato correttamente', 'errId' => err));
				return;		
			}
		
			if ( !check_POST_IsSetAndNotEmpty('msgDate') ) {
				echo json_encode(array('errMsg' => 'La data del messaggio non e\' stata inviata correttamente', 'errId' => err));
				return;		
			}
			
			insertInto_ShareYourPvtMsgTime($_POST['text'], $_POST['obj'], 
										   $_SESSION['user'], $_POST['receiver'],
										   $_POST['msgDate']);
	}

	updateInto_ShareYourPvtMsgTime_ReadMsg($_POST['receiver'], $_SESSION['user']);

	echo json_encode(getChat($_SESSION['user'], $_POST['receiver']));
