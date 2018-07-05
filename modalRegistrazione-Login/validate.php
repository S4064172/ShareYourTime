<?php
	require_once("../utils/checkFields.php");	

	header("Content-Type: application/json");

	
		
	if ( !check_StringLength($_POST['usernameReg'], 15, 25) ) {
			echo json_encode(array('code' => -1));
			return;
	}

	echo json_encode(array('code' => 0));
