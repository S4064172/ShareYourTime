<?php
	require_once('../db/connection.php');

	function check_POST_IsSetAndNotEmpty($field) 
	{
		return isset($_POST["$field"]) && !empty($_POST["$field"]);
	}

	function checkMatchRegex($inputSent, $regexToMatch) 
	{
		return preg_match($regexToMatch, $inputSent, $match);
	}
	
	function sanitizeToSql($data, $conn) 
	{
		return mysqli_real_escape_string($conn, trim($data));
	}

	function sanitizeToHtml($inputSent){
		return htmlspecialchars(stripslashes(trim($inputSent))); 
	}

	function checkMinLength($string, $min) {
		return strlen($string) >= $min;
	}
	
	function checkMaxLength($string, $max) {
		return strlen($string) <= $max;
	}

	function notValidString($string, $regex, $minLen, $maxLen) {
		return !checkMinLength($string, $minLen) ||
			   !checkMaxLength($string, $maxLen) ||
			   !checkMatchRegex($string, $regex);
	}

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
