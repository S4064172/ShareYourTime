<?php
	require('connection.php');
	
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
					echo("Errore nell'accoppiamento dei parametri<br>");
				if ( !mysqli_stmt_execute($insert_prep_stmt) )
					echo("Errore nell'inserimento nel DB<br>");
				if ( ($rows = mysqli_stmt_affected_rows($insert_prep_stmt)) != 1 )
						echo("Errore: sto eseguendo un rollback...<br>");

				mysqli_stmt_close($insert_prep_stmt);
		}

		mysqli_close($conn);
		echo("La tupla e' stata inserita correttamente<br>");
	}

