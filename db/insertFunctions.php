<?php
	require_once('connection.php');
	require_once('../utils/utils.php');

	function insertAndCheck($insert_prep_stmt) {
		if ( !mysqli_stmt_execute($insert_prep_stmt) )
			die ("Errore nell'inserimento nel DB<br>");
		else if ( ($rows = mysqli_stmt_affected_rows($insert_prep_stmt)) != 1 )
			echo ("Errore: sto eseguendo un rollback...<br>");
	}
	
	function insertInto_ShareYourUserTime($usr, $psw, $name, $surname, $phone, $email, $street, $path) {
		$conn = connectionToDb();

		$usr = sanitizeToSql($usr, $conn);
		$psw = sha1(sanitizeToSql($psw, $conn));
		$name = sanitizeToSql($name, $conn);
		$surname = sanitizeToSql($surname, $conn);
		$phone = sanitizeToSql($phone, $conn);
		$email = sanitizeToSql($email, $conn);
		$street = sanitizeToSql($street, $conn);
		$path = sanitizeToSql($path, $conn);
		
		$insertQuery = "INSERT INTO ShareYourUsersTime VALUES(?,?,?,?,?,?,?,?);";

		if ( ($insert_prep_stmt = mysqli_prepare($conn, $insertQuery)) ) {
				if ( !mysqli_stmt_bind_param($insert_prep_stmt, "ssssssss",
						$usr, $psw, $name, $surname, $phone, $email, $street, $path) )
					die ("Errore nell'accoppiamento dei parametri<br>");
				insertAndCheck($insert_prep_stmt);
				mysqli_stmt_close($insert_prep_stmt);
				/*echo("La tupla e' stata inserita correttamente<br>");*/
		} else {
			die ("Errore nella preparazione della query<br>");
		}
		mysqli_close($conn);
	}

	function insertInto_ShareYourJobsTime($descr, $cost, $timeS, $timeE, $dist, $valut, $street, $lat, $long, $propUser, $tag) {
		$conn = connectionToDb();

		$descr = sanitizeToSql($descr, $conn);
		$cost = sanitizeToSql($cost, $conn);
		$timeS = sanitizeToSql($timeS, $conn);
		$timeE = sanitizeToSql($timeE, $conn);
		$dist = sanitizeToSql($dist, $conn);
		$valut = sanitizeToSql($valut, $conn);
		$street = sanitizeToSql($street, $conn);
		$lat = sanitizeToSql($lat, $conn);
		$long = sanitizeToSql($long, $conn);
		$propUser = sanitizeToSql($propUser, $conn);
		$tag = sanitizeToSql($tag, $conn);
		
		$insertQuery = "INSERT INTO ShareYourJobsTime VALUES(DEFAULT,?,?,?,?,?,?,?,?,?,?,DEFAULT,?);";

		if ( ($insert_prep_stmt = mysqli_prepare($conn, $insertQuery)) ) {
				if ( !mysqli_stmt_bind_param($insert_prep_stmt, "sissiisddss",
						$descr, $cost, $timeS, $timeE, $dist, $valut, $street, $lat, $long, $propUser, $tag) )
					die ("Errore nell'accoppiamento dei parametri<br>");
				insertAndCheck($insert_prep_stmt);

				mysqli_stmt_close($insert_prep_stmt);
		} else {
			die ("Errore nella preparazione della query<br>");
		}
		 
		mysqli_close($conn);
	}

	function insertInto_ShareYourTagsTime ($tag) {
		$conn = connectionToDb();	

		$tag = sanitizeToSql($tag, $conn);
		
		$insertQuery = "INSERT INTO ShareYourTagsTime VALUES(?);";

		if ( ($insert_prep_stmt = mysqli_prepare($conn, $insertQuery)) ) {
				if ( !mysqli_stmt_bind_param($insert_prep_stmt, "s", $tag) )
					die ("Errore nell'accoppiamento del parametro<br>");
				insertAndCheck($insert_prep_stmt);

				mysqli_stmt_close($insert_prep_stmt);
		}

		mysqli_close($conn);
	}
	
	function insertInto_ShareYourPvtMsgTime($text, $obj, $sender, $receiver, $dateMsg) {
		$conn = connectionToDb();

		$text = sanitizeToSql($text, $conn);
		$obj = sanitizeToSql($obj, $conn);
		$sender = sanitizeToSql($sender, $conn);
		$receiver = sanitizeToSql($receiver, $conn);
		$dateMsg = sanitizeToSql($dateMsg, $conn);
		
		$insertQuery = "INSERT INTO ShareYourPvtMsgTime VALUES(DEFAULT,?,?,?,?,?,DEFAULT);";

		if ( ($insert_prep_stmt = mysqli_prepare($conn, $insertQuery)) ) {
				if ( !mysqli_stmt_bind_param($insert_prep_stmt, "sssss",
						$text, $obj, $sender, $receiver, $dateMsg) ) 
					die ("Errore nell'accoppiamento dei parametri<br>");
				insertAndCheck($insert_prep_stmt);

				mysqli_stmt_close($insert_prep_stmt);
		} else {
			die ("Errore nella preparazione della query<br>");
		}
		 
		mysqli_close($conn);
	}

