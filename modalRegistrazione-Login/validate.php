<?php
	require_once("../utils/checkFields.php");	
	require_once("../utils/regexConstant.php");
	require_once("../db/connection.php");
	header("Content-Type: application/json");

	function checkIfExistInDb($fieldTable, $fieldSearch)
	{
		$conn = selectionDB();

		$fieldSearch = sanitizeToSql($fieldSearch, $conn);

		$querySelectUser = 	"SELECT ". $fieldTable." ".
							"FROM ShareYourUsersTime ".
							"WHERE ".$fieldTable."=?";

		if ( ($prep_stmt = mysqli_prepare($conn, $querySelectUser)) ) {
			if ( !mysqli_stmt_bind_param($prep_stmt, "s", $fieldSearch) )
				die ("Errore nell'accoppiamento dei parametri<br>");
			
			if ( !mysqli_stmt_execute($prep_stmt) )
				die ("Errore nell'esecuzione della query<br>");

			mysqli_stmt_store_result($prep_stmt);
			$row = mysqli_stmt_num_rows($prep_stmt);
			
			mysqli_stmt_close($prep_stmt);
			mysqli_close($conn);
			
			return ($row == 1);
		}
		die ("Errore nella preparazione della query<br>");
	}
	
//Check username
	if( check_POST_NotIsSetOrEmpty('usernameReg') ) { 
		if ( !checkMatchRegex($_POST['usernameReg'], alphaNumRegex) ) {
				echo json_encode(array('code' => -1, 'msg' => 'Username non valido !'));
				return;
		}

		if ( checkIfExistInDb('user', $_POST['usernameReg']) ) {
			echo json_encode(array('code' => -1, 'msg' => 'Username gi&agrave; presente !'));
			return;
		}

		echo json_encode(array('code' => 0));
		return;
	}

//Check email
	if( check_POST_NotIsSetOrEmpty('emailReg') ) {
		if ( !checkMatchRegex($_POST['emailReg'], emailRegex) ) {
				echo json_encode(array('code' => -1, 'msg' => 'Email non valida !'));
				return;
		}

		if ( checkIfExistInDb('email', $_POST['emailReg']) ) {
			echo json_encode(array('code' => -1, 'msg' => 'Email gi&agrave; presente !'));
			return;
		} 

		echo json_encode(array('code' => 0));
		return;
	}

//Check password
	if( check_POST_NotIsSetOrEmpty('pswReg') ) {
		foreach(passwordRegex as $regex) {
			if ( !checkMatchRegex($_POST['pswReg'], $regex) ) {
				echo json_encode(array('code' => -1, 'msg' => 'La password deve contenere almeno 8 caratteri di cui una lettera minuscola, una maiuscola, un numero e un carattere speciale.'));
				return;
			}
		}

		echo json_encode(array('code' => 0));
		return;
	}

	if( check_POST_NotIsSetOrEmpty('pswRegConf') ) {
		if ( !check_POST_NotIsSetOrEmpty('pswRegc') || $_POST['pswRegConf'] !== $_POST['pswRegc'] ) {
				echo json_encode(array('code' => -1, 'msg' => 'Le password non coincidono !'));
				return;
		}

		echo json_encode(array('code' => 0));
		return;
	}

//Check name
	if( check_POST_NotIsSetOrEmpty('nameReg') ) {
		if ( !checkMatchRegex($_POST['nameReg'], alphaRegex) ) {
			echo json_encode(array('code' => -1, 'msg' => 'Il nome inserito non &egrave; valido !'));
			return;
		}

		echo json_encode(array('code' => 0));
		return;
	}

//Check surname
	if( check_POST_NotIsSetOrEmpty('surnameReg') ) {
		if ( !checkMatchRegex($_POST['surnameReg'], surnameRegex) ) {
			echo json_encode(array('code' => -1, 'msg' => 'Il congnome inserito non &egrave; valido !'));
			return;
		}

		echo json_encode(array('code' => 0));
		return;
	}

//Check address
	if( check_POST_NotIsSetOrEmpty('addressReg') ){
		if ( !checkMatchRegex($_POST['addressReg'], alphaNumRegex) ) {
			echo json_encode(array('code' => -1, 'msg' => 'L\'indirizzo non &egrave; valido !'));
			return;
		}

		echo json_encode(array('code' => 0));
		return;
	}

//Check phone
	if( check_POST_NotIsSetOrEmpty('telephoneReg') ){
		if ( !checkMatchRegex($_POST['telephoneReg'], numRegex) ) {
			echo json_encode(array('code' => -1, 'msg' => 'Il telefono non &egrave; valido !' ));
			return;
		}

		if ( checkIfExistInDb('phone', $_POST['telephoneReg']) ) {
			echo json_encode(array('code' => -1, 'msg' => 'Questo telefono già presente !' ));
			return;
		}

		echo json_encode(array('code' => 0));
		return;
	}

//Check img
	/* TODO: DA IMPLEMENTARE */

	echo json_encode(array('code' => -2));
