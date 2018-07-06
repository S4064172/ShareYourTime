<?php
	require_once('connection.php');

	function insertAndCheck($insert_prep_stmt) {
		if ( !mysqli_stmt_execute($insert_prep_stmt) )
			die ("Errore nell'inserimento nel DB<br>");
		else if ( ($rows = mysqli_stmt_affected_rows($insert_prep_stmt)) != 1 )
			echo ("Errore: sto eseguendo un rollback...<br>");
	}
	
	function insertInto_ShareYourUserTime($usr, $psw, $name, $surname, $phone, $email, $street, $path) {
		$conn = selectionDB();

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
		}

		mysqli_close($conn);
		echo("La tupla e' stata inserita correttamente<br>");
	}

	function insertInto_ShareYourJobsTime($descr, $cost, $timeS, $timeE, $date, $dist, $valut, $street, $lat, $long, $recvUser) {
		$conn = selectionDB();

		$descr = sanitizeToSql($descr, $conn);
		$cost = sanitizeToSql($cost, $conn);
		$timeS = sanitizeToSql($timeS, $conn);
		$timeE = sanitizeToSql($timeE, $conn);
		$date = sanitizeToSql($date, $conn);
		$dist = sanitizeToSql($dist, $conn);
		$valut = sanitizeToSql($valut, $conn);
		$street = sanitizeToSql($street, $conn);
		$lat = sanitizeToSql($lat, $conn);
		$long = sanitizeToSql($long, $conn);
		$recvUser = sanitizeToSql($recvUser, $conn);
		
		$insertQuery = "INSERT INTO ShareYourJobsTime VALUES(DEFAULT,?,?,?,?,?,?,?,?,?,?,?);";

		if ( ($insert_prep_stmt = mysqli_prepare($conn, $insertQuery)) ) {
				if ( !mysqli_stmt_bind_param($insert_prep_stmt, "sisssiisdds",
						$descr, $cost, $timeS, $timeE, $date, $dist, $valut, $street, $lat, $long, $recvUser) )
					die ("Errore nell'accoppiamento dei parametri<br>");
				insertAndCheck($insert_prep_stmt);

				mysqli_stmt_close($insert_prep_stmt);
		}

		mysqli_close($conn);
		echo("La tupla e' stata inserita correttamente<br>");
	}

	function insertInto_ShareYourTagsTime ($tag) {
		$conn = selectionDB();	

		$tag = sanitizeToSql($tag, $conn);
		
		$insertQuery = "INSERT INTO ShareYourTagsTime VALUES(?);";

		if ( ($insert_prep_stmt = mysqli_prepare($conn, $insertQuery)) ) {
				if ( !mysqli_stmt_bind_param($insert_prep_stmt, "s", $tag) )
					die ("Errore nell'accoppiamento del parametro<br>");
				insertAndCheck($insert_prep_stmt);

				mysqli_stmt_close($insert_prep_stmt);
		}

		mysqli_close($conn);
		echo("La tupla e' stata inserita correttamente<br>");
	}

	function insertInto_ShareYourTagsJobsTime ($tag, $idjob) {
		$conn = selectionDB();	

		$tag = sanitizeToSql($tag, $conn);
		$idjob = sanitizeToSql($idjob, $conn);
		
		$insertQuery = "INSERT INTO ShareYourTagsJobsTime VALUES(?,?);";

		if ( ($insert_prep_stmt = mysqli_prepare($conn, $insertQuery)) ) {
				if ( !mysqli_stmt_bind_param($insert_prep_stmt, "si", $tag, $idjob) )
					echo("Errore nell'accoppiamento dei parametri<br>");
				insertAndCheck($insert_prep_stmt);

				mysqli_stmt_close($insert_prep_stmt);
		}

		mysqli_close($conn);
		echo("La tupla e' stata inserita correttamente<br>");
	}

