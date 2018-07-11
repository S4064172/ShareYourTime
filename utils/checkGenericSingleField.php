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

	/*
	* 	Questa funzione ci permette
	*	di controllare nel database
	*	se un certo elemento è presente 
	*	nella tabella ShareYourUsersTime
	*/
	function checkIfExistInDb($fieldTable, $fieldSearch)
	{
		$conn = connectionToDb();

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
	
	//Controlli sull'username
	if( check_POST_IsSetAndNotEmpty('user') ) { 
		if ( !checkMinLength($_POST['user'], UserNameMinLength) || !checkMaxLength($_POST['user'], UserNameMaxLength) ) {
			echo json_encode(array('code' => -1, 'msg' => 'L\'username deve essere compreso tra i 5 e i 25 caratteri !'));
			return;
		}

		if ( !checkMatchRegex($_POST['user'], alphaNumRegex) ) {
			echo json_encode(array('code' => -1, 'msg' => 'Username non valido !'));
			return;
		}

		if ( checkIfExistInDb('user', $_POST['user']) ) {
			echo json_encode(array('code' => -1, 'msg' => 'Username gi&agrave; presente !'));
			return;
		}

		echo json_encode(array('code' => 0));
		return;
	}

	//Controlli sull'email
	if( check_POST_IsSetAndNotEmpty('email') ) {
		if ( notValidString($_POST['email'], emailRegex, EmailMinLength, EmailMaxLength) ) {
				echo json_encode(array('code' => -1, 'msg' => 'Email non valida !'));
				return;
		}

		if ( checkIfExistInDb('email', $_POST['email']) ) {
			echo json_encode(array('code' => -1, 'msg' => 'Email gi&agrave; presente !'));
			return;
		} 

		echo json_encode(array('code' => 0));
		return;
	}

	//Controlli sulla password
	if( check_POST_IsSetAndNotEmpty('psw') ) {
		if ( !checkMinLength($_POST['psw'], PasswordMinLength) ) {
				echo json_encode(array('code' => -1, 'msg' => 'Password deve essere almeno di 8 !'));
				return;
		}

		foreach(passwordRegex as $regex) {
			if ( !checkMatchRegex($_POST['psw'], $regex) ) {
				echo json_encode(array('code' => -1, 'msg' => 'La password deve contenere almeno una lettera minuscola, una maiuscola, un numero e un carattere speciale.'));
				return;
			}
		}

		echo json_encode(array('code' => 0));
		return;
	}

	//Controlli sulla passoword di conferma
	if( check_POST_IsSetAndNotEmpty('pswConf') ) {
		if ( !check_POST_IsSetAndNotEmpty ('_psw') || $_POST['pswConf'] !== $_POST['_psw'] ) {
				echo json_encode(array('code' => -1, 'msg' => 'Le password non coincidono !'));
				return;
		}

		echo json_encode(array('code' => 0));
		return;
	}

	//Controlli sul nome
	if( check_POST_IsSetAndNotEmpty('name') ) {
		if ( notValidString($_POST['name'], alphaRegex, NameMinLength, NameMaxLength) ) {
			echo json_encode(array('code' => -1, 'msg' => 'Il nome inserito non &egrave; valido !'));
			return;
		}

		echo json_encode(array('code' => 0));
		return;
	}

	//Controlli sul cognome
	if( check_POST_IsSetAndNotEmpty('surname') ) {
		if ( notValidString($_POST['surname'], surnameRegex, SurnameMinLength, SurnameMaxLength) ) {
			echo json_encode(array('code' => -1, 'msg' => 'Il congnome inserito non &egrave; valido !'));
			return;
		}

		echo json_encode(array('code' => 0));
		return;
	}

    //Controlli sull'indirizzo
	if( check_POST_IsSetAndNotEmpty('address') ) {
		if ( notValidString($_POST['address'], addressRegex, StreetMinLength, StreetMaxLength) ) {
			echo json_encode(array('code' => -1, 'msg' => 'L\'indirizzo non &egrave; valido !'));
			return;
		}

		echo json_encode(array('code' => 0));
		return;
	}

	//Controlli sul telefono
	if( check_POST_IsSetAndNotEmpty('phone') ){
		if ( notValidString($_POST['phone'], numRegex, PhoneLength, PhoneLength) ) {
			echo json_encode(array('code' => -1, 'msg' => 'Il telefono non &egrave; valido !' ));
			return;
		}

		if ( checkIfExistInDb('phone', $_POST['phone']) ) {
			echo json_encode(array('code' => -1, 'msg' => 'Questo telefono gi&agrave; presente !' ));
			return;
		}

		echo json_encode(array('code' => 0));
		return;
	}

	echo json_encode(array('code' => -2));
