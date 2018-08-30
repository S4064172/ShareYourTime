<?php
	require_once('../db/connection.php');

	/*
	 *	Funzioni che controllano campi
	 */

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

	function sanitizeToHtml($inputSent)
	{
		return htmlspecialchars(stripslashes(trim($inputSent))); 
	}

	function checkMinLength($string, $min) 
	{
		return strlen($string) >= $min;
	}
	
	function checkMaxLength($string, $max) 
	{
		return strlen($string) <= $max;
	}

	function notValidString($string, $regex, $minLen, $maxLen) 
	{
		return !checkMinLength($string, $minLen) ||
			   !checkMaxLength($string, $maxLen) ||
			   !checkMatchRegex($string, $regex);
	}
	
	function usrInArr($user, $arr)
	{
		foreach ($arr as $us)
			if ($us === $user)
				return true;
		return false;
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
        $fieldSearchPsw = sha1($fieldSearchPsw);
		$querySelectUser = 	"SELECT User ".
							"FROM ShareYourUsersTime ".
							"WHERE BINARY User=? AND Password=?";

		if ( ($prep_stmt = mysqli_prepare($conn, $querySelectUser)) ) {
			if ( !mysqli_stmt_bind_param($prep_stmt, "ss", $fieldSearchUser, $fieldSearchPsw) )
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
	 	if ( session_status() == PHP_SESSION_NONE ) {
        	session_start();
		}
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

	function checkIfReceiverIsNull($idJob)
	{
		$conn = connectionToDb();

        $idJob = sanitizeToSql($idJob, $conn);
        
		$querySelectReceiver = 	"SELECT Receiver ".
								"FROM ShareYourJobsTime ".
								"WHERE IdJob=?";

		if ( ($prep_stmt = mysqli_prepare($conn, $querySelectReceiver)) ) {
			if ( !mysqli_stmt_bind_param($prep_stmt, "i", $idJob ) )
				die ("Errore nell'accoppiamento dei parametri<br>");
			
			if ( !mysqli_stmt_execute($prep_stmt) )
				die ("Errore nell'esecuzione della query<br>");

			mysqli_stmt_store_result($prep_stmt);
			$row = mysqli_stmt_num_rows($prep_stmt);

			mysqli_stmt_bind_result($prep_stmt, $Receiver);
			mysqli_stmt_fetch($prep_stmt);

			mysqli_stmt_close($prep_stmt);
			mysqli_close($conn);

			return ( ($row == 1) && ($Receiver == null ));

		}
		die ("Errore nella preparazione della query<br>");
	}

	/*
	 *	Questa funzione ci restituisce la conversazione
	 *	avvenuta tra due utenti
	 */

	function getChat($user1, $user2) 
	{	
		$conn = connectionToDb();

		$getChatQuery = 'SELECT * FROM ShareYourPvtMsgTime 
					 	 WHERE ( Sender=? AND Receiver=? )
						 OR ( Receiver=? AND Sender=? )';
		
		if ( ($prep_stmt = mysqli_prepare($conn, $getChatQuery)) ) {
			if ( !mysqli_stmt_bind_param($prep_stmt, "ssss", $user1, $user2, $user1, $user2 ) )
				die ("Errore nell'accoppiamento dei parametri<br>");
			
			if ( !mysqli_stmt_execute($prep_stmt) )
				die ("Errore nell'esecuzione della query<br>");
			
			$res = mysqli_stmt_get_result($prep_stmt);
			
			$chat = array();
			$i = 0;

			while ( $row = mysqli_fetch_array($res, MYSQLI_ASSOC) ) {
				$row['Text'] = sanitizeToHtml($row['Text']);
				$row['Obj'] = sanitizeToHtml($row['Obj']);
				$row['Date'] = sanitizeToHtml($row['Date']);

				$chat[$i++] = $row;
			}

			mysqli_stmt_close($prep_stmt);
			mysqli_close($conn);

			return $chat;
		}
		die ('Errore nella preparazione della query<br>');
	}

	function checkNewMsg($user)
	{
		$conn = connectionToDb();

		$getNewMsgQuery = 'SELECT DISTINCT Sender FROM ShareYourPvtMsgTime WHERE Receiver=? AND NOT ReadYet';

		if ( ($prep_stmt = mysqli_prepare($conn, $getNewMsgQuery)) ) {
			if ( !mysqli_stmt_bind_param($prep_stmt, "s", $user ) )
				die ("Errore nell'accoppiamento dei parametri<br>");
			
			if ( !mysqli_stmt_execute($prep_stmt) )
				die ("Errore nell'esecuzione della query<br>");

			$newMsg = array();
			$i = 0;

			mysqli_stmt_bind_result($prep_stmt, $sender);
			while ( mysqli_stmt_fetch($prep_stmt) )
				$newMsg[$i++] = $sender;
		
			mysqli_stmt_close($prep_stmt);
			mysqli_close($conn);

			return $newMsg;
		}
		die ('Errore nella preparazione della query<br>');
	}

