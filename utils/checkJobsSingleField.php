<?php
	require_once('../utils/utils.php');
	
	//Controlli sulle date
	if ( check_POST_IsSetAndNotEmpty('dateS') && 
		 check_POST_IsSetAndNotEmpty('dateE') ) {
		 if ( check_POST_IsSetAndNotEmpty('sameJob') ) {
		 	if ( checkDatesAndTime($_POST['dateS'], $_POST['dateE'], $_POST['sameJob']) ) {
				echo json_encode(array('code' => 0));
				return;
			}
			
			echo json_encode(array('code' => -1, 'msg' => 'Hai gia\' un impegno in questa data.'));
			return;
		 }

		 if ( checkDatesAndTime($_POST['dateS'], $_POST['dateE'], null) ) {
			echo json_encode(array('code' => 0));
			return;
		 } 
		
		echo json_encode(array('code' => -1, 'msg' => 'Hai gia\' un impegno in questa data.'));
		return;
	}
		

	//Controlli sui tag
	if ( check_POST_IsSetAndNotEmpty('optionModalTag') ) {
		if ( checkIfTagExistInDb($_POST['optionModalTag']) ) {
			echo json_encode(array('code' => 0));	
			return;
		}
		
		echo json_encode(array('code' => -1, 'msg' => 'Tag sconosciuto'));
		return;
	}

	echo json_encode(array('code' => -2, 'post' => $_POST['optionModalTag']));
