<?php
	require_once('../utils/utils.php');
	
	//Controlli sulle date


	//Controlli sui tag
	if ( check_POST_IsSetAndNotEmpty('tag') ) {
		if ( checkIfTagExistInDb($_POST['tag']) ) {
			echo json_encode(array('code' => 0));	
			return;
		}
		
		echo json_encode(array('code' => -1, 'msg' => 'Tag sconosciuto'));
		return;
	}

	echo json_encode(array('code' => -2));
