<?php
    require_once('connection.php');
    require_once('../utils/checkFields.php');
    
    function upDataAndCheck($insert_prep_stmt) {
		if ( !mysqli_stmt_execute($insert_prep_stmt) )
			die ("Errore nell'aggiornamento nel DB<br>");
		else if ( ($rows = mysqli_stmt_affected_rows($insert_prep_stmt)) > 1 )
            die ("Errore: sto eseguendo un rollback...");
	}


    function updataInto_ShareYourUserTime($usr, $psw, $name, $surname, $phone, $email, $street,  $fieldFilter) {
		$conn = connectionToDb();

		$usr = sanitizeToSql($usr, $conn);
		
		$name = sanitizeToSql($name, $conn);
		$surname = sanitizeToSql($surname, $conn);
		$phone = sanitizeToSql($phone, $conn);
		$email = sanitizeToSql($email, $conn);
        $street = sanitizeToSql($street, $conn);
        if( $psw != null ){
            $psw = sha1(sanitizeToSql($psw, $conn));
            $updateQuery =  "UPDATE ShareYourUsersTime SET ". 
                            "user = ? , ".
                            "password = ? , ".
                            "name = ? , ".
                            "surname = ? , ".
                            "phone = ? , ".
                            "email = ? , ".
                            "street = ? ".
                            "WHERE user='$fieldFilter';";

            if ( !($update_prep_stmt = mysqli_prepare($conn, $updateQuery)) )
                die ("Errore nella preparazione della query<br>");
            if ( !mysqli_stmt_bind_param($update_prep_stmt, "sssssss",
                $usr, $psw, $name, $surname, $phone, $email, $street) )
                die ("Errore nell'accoppiamento dei parametri<br>");
        } else {
            $updateQuery =  "UPDATE ShareYourUsersTime SET ". 
                            "user = ? , ".
                            "name = ? , ".
                            "surname = ? , ".
                            "phone = ? , ".
                            "email = ? , ".
                            "street = ? ".
                            "WHERE user='$fieldFilter';";

                         
            if ( !($update_prep_stmt = mysqli_prepare($conn, $updateQuery)) )
                die ("Errore nella preparazione della query<br>");
            if ( !mysqli_stmt_bind_param($update_prep_stmt, "ssssss",
                $usr,  $name, $surname, $phone, $email, $street) )
                die ("Errore nell'accoppiamento dei parametri<br>");
        }
        upDataAndCheck($update_prep_stmt);
        mysqli_stmt_close($update_prep_stmt);
        mysqli_close($conn);
        /*echo("La tupla e' stata inserita correttamente<br>");*/
        return;
		
		
		
	}