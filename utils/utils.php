<?php
	require_once('../db/connection.php');

	function check_POST_IsSetAndNotEmpty($field) 
	{
		return isset($_POST["$field"]) && !empty($_POST["$field"]);
	}

	function check_COOKIE_IsSetAndNotEmpty($field) 
	{
		return isset($_COOKIE["$field"]) && !empty($_COOKIE["$field"]);
	}

	function check_SESSION_IsSetAndNotEmpty($field) 
	{
		return isset($_SESSION["$field"]) && !empty($_SESSION["$field"]);
	}

	function checkMatchRegex($inputSent, $regexToMatch) 
	{
		return preg_match($regexToMatch, $inputSent);
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


	/*
	* 	Questa funzione ci permette
	*	di controllare nel database
	*	se un certo elemento è presente 
	*	nella tabella ShareYourTagTime
	*/
	function checkIfTagExistInDb($fieldSearch)
	{
		$conn = connectionToDb();

		$fieldSearch = sanitizeToSql($fieldSearch, $conn);

		$querySelectTag = "SELECT Tag FROM ShareYourTagsTime WHERE Tag=?";

		if ( ($prep_stmt = mysqli_prepare($conn, $querySelectTag)) ) {
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

	/* 
    *   Questa funzione ci permette di
    *   verificare se esite un utente
    *   nel db con una certa password
    */
    function checkIfUserWithPswExistInDb($fieldSearchUser,  $fieldSearchPsw )
	{
		$conn = connectionToDb();

        $fieldSearchUser = sanitizeToSql($fieldSearchUser, $conn);
        $fieldSearchPsw = sanitizeToSql($fieldSearchPsw, $conn);
        $fieldSearchPsw=sha1($fieldSearchPsw);
		$querySelectUser = 	"SELECT user ".
							"FROM ShareYourUsersTime ".
							"WHERE user=? and password=?";

		if ( ($prep_stmt = mysqli_prepare($conn, $querySelectUser)) ) {
			if ( !mysqli_stmt_bind_param($prep_stmt, "ss", $fieldSearchUser, $fieldSearchPsw))
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

	/* 
    *   Questa funzione ci permette di
    *   verificare se ci sono overlap
    *   di tempi tra i lavori nel db
    */

	function checkDatesAndTime($dateS, $dateE, $sameJob) 
	{
		$dateS = strtotime($dateS);
		$dateE = strtotime($dateE);

		$now = strtotime(date('Y-m-d H:i'));

		//controlliamo che le date siano in ordine sensato
		if ($dateS < $now || $dateE < $now || $dateE <= $dateS)
			return false;

		//controlliamo che non ci siano overlaps con altri lavori
		session_start();
		$selectJobsQuery = "SELECT * FROM ShareYourJobsTime WHERE Proposer='".$_SESSION['user']."' ";
		
		if ( $sameJob != null )
			$selectJobsQuery .= "AND IdJob <> $sameJob ;";
		
		$conn = connectionToDb();

		if ( !($res = mysqli_query($conn, $selectJobsQuery)) ) 
			die('Errore nella selezione dei lavori');

		while( $row = mysqli_fetch_array($res) ) {
			if(	($dateS >= strtotime($row['TimeStart']) && $dateE <= strtotime($row['TimeEnd'])) ||
				($dateE >= strtotime($row['TimeStart']) && $dateE <= strtotime($row['TimeEnd'])) ||
				($dateS >= strtotime($row['TimeStart']) && $dateS <= strtotime($row['TimeEnd'])) ||
				($dateS <= strtotime($row['TimeStart']) && $dateE >= strtotime($row['TimeEnd'])) )
				return false;
		}	

		mysqli_close($conn);
		return true;
	}

