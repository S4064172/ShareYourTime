<?php
	require_once('../utils/utils.php');
	
	if ( session_status() == PHP_SESSION_NONE ) {
        session_start();
	}

	//Controlli sulle date
	if ( check_POST_IsSetAndNotEmpty('dateS') && 
		 check_POST_IsSetAndNotEmpty('dateE') ) {
		 if ( check_POST_IsSetAndNotEmpty('sameJob') ) {
		 	if ( checkDatesAndTime($_POST['dateS'], $_POST['dateE'], $_POST['sameJob']) ) {
				echo json_encode(array('code' => 0));
				return;
			}
			
			echo json_encode(array('code' => -1, 'msg' => 'Hai gia\' un impegno in questa data'));
			return;
		 }

		 if ( checkDatesAndTime($_POST['dateS'], $_POST['dateE'], null) ) {
			echo json_encode(array('code' => 0));
			return;
		 } 
		
		echo json_encode(array('code' => -1, 'msg' => 'Hai gia\' un impegno in questa data'));
		return;
	}
		

	//Controlli sui tag
	if ( check_POST_IsSetAndNotEmpty('tag') ) {
		if ( checkIfTagExistInDb($_POST['tag']) ) {
			echo json_encode(array('code' => 0));	
			return;
		}
		
		echo json_encode(array('code' => -1, 'msg' => 'Tag sconosciuto'));
		return;
	}

	
	
	//Controlli sull'username
	if( check_POST_IsSetAndNotEmpty('userName') ) { 
		if ( !checkIfExistInDb('user', $_POST['userName']) ) {
			echo json_encode(array('code' => -1, 'msg' => 'Username inesistente'));
			return;
		}

		if ($_POST['userName'] == $_SESSION['user']){
			echo json_encode(array('code' => -1, 'msg' => 'Username non valido'));
			return;
		}
		echo json_encode(array('code' => 0));
		return;
	}

	echo json_encode(array('code' => -2));
