<?php
	require_once('connection.php');
	require_once('../utils/utils.php');

	function insertAndCheck($insert_prep_stmt) {
		if ( !mysqli_stmt_execute($insert_prep_stmt) )
			die ("Errore nell'inserimento nel DB<br>");
		else if ( ($rows = mysqli_stmt_affected_rows($insert_prep_stmt)) != 1 )
			echo ("Errore: sto eseguendo un rollback...<br>");
	}
	
	function searchInto_ShareYourJobsTime($street, $distance, $cost, $tag) {
		$conn = connectionToDb();

		$street = sanitizeToSql($street, $conn);
		$distance = sha1(sanitizeToSql($distance, $conn));
		$cost = sanitizeToSql($cost, $conn);
		$tag = sanitizeToSql($tag, $conn);
		
		$searcQuery = "SELECT * ".
                      "FROM ShareYourJobsTime ".
                      "WHERE ( ? IS NULL OR Street = ? ) AND 
                             ( ? IS NULL OR Distance = ?) AND 
                             ( ? IS NULL OR Cost = ?) AND 
                             ( ? IS NULL OR Tag = ?);";

		if ( ($insert_prep_stmt = mysqli_prepare($conn, $insertQuery)) ) {
				if ( !mysqli_stmt_bind_param($insert_prep_stmt, "siis",
						$street, $distance, $cost, $tag) )
					die ("Errore nell'accoppiamento dei parametri<br>");
                
                    mysqli_stmt_store_result($prep_stmt);
			        $row = mysqli_stmt_num_rows($prep_stmt);
                    mysqli_stmt_close($insert_prep_stmt);
                
				
		} else {
			die ("Errore nella preparazione della query<br>");
		}
        mysqli_close($conn);
        return $row;
	}

	