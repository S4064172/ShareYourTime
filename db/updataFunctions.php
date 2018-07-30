<?php
    require_once('connection.php');
    require_once('../utils/utils.php');
    
    function upDataAndCheck($insert_prep_stmt) {
		if ( !mysqli_stmt_execute($insert_prep_stmt) )
			die ("Errore nell'aggiornamento nel DB<br>");
		else if ( ($rows = mysqli_stmt_affected_rows($insert_prep_stmt)) > 1 )
            die ("Errore: sto eseguendo un rollback...");
	}


    function updataInto_ShareYourUserTime($usr, $psw, $name, $surname, $phone, $email, $street,  $fieldFilter, $file) {
		$conn = connectionToDb();

		$usr = sanitizeToSql($usr, $conn);
		$name = sanitizeToSql($name, $conn);
		$surname = sanitizeToSql($surname, $conn);
		$phone = sanitizeToSql($phone, $conn);
		$email = sanitizeToSql($email, $conn);
        $street = sanitizeToSql($street, $conn);
        $fieldFilter = sanitizeToSql($fieldFilter, $conn);

        //Recupero vecchio path della foto
        $getPathQuery= "SELECT Photo FROM ShareYourUsersTime WHERE user=?;";
        if ( ($prep_stmt = mysqli_prepare($conn, $getPathQuery)) ) {
            if ( !mysqli_stmt_bind_param($prep_stmt, "s", $fieldFilter) )
                echo ("Errore nell'accoppiamento dei parametri");
                
            if ( !mysqli_stmt_execute($prep_stmt) )
                echo ("Errore nell'aggiornamento nel DB");

            mysqli_stmt_store_result($prep_stmt);
            mysqli_stmt_bind_result($prep_stmt, $path_temp);
            mysqli_stmt_fetch($prep_stmt);
            $pathOld = $path_temp; 
            mysqli_stmt_close($prep_stmt);
        }
        
		
        if(!empty($file)){
            //se è settato costruisco il path con la nuova foto
            $imageFileType = strtolower(pathinfo($file['photo']['name'], PATHINFO_EXTENSION));
            $path = '../../profile_imgs/'.$usr.'.'.$imageFileType; 
        }else{
            //se non è settato costruisco il path cambiano solo il nome
            $path = '../../profile_imgs/'.$usr.substr($pathOld,strlen($pathOld)-4);     
        }
        
        

        if( $psw != null ){
            $psw = sha1(sanitizeToSql($psw, $conn));
            $updateQuery =  "UPDATE ShareYourUsersTime SET ". 
                            "user = ? , ".
                            "password = ? , ".
                            "name = ? , ".
                            "surname = ? , ".
                            "phone = ? , ".
                            "email = ? , ".
                            "street = ? , ".
                            "photo = ? ".
                            "WHERE user='$fieldFilter';";

            if ( !($update_prep_stmt = mysqli_prepare($conn, $updateQuery)) )
                die ("Errore nella preparazione della query<br>");
            if ( !mysqli_stmt_bind_param($update_prep_stmt, "ssssssss",
                $usr, $psw, $name, $surname, $phone, $email, $street, $path) )
                die ("Errore nell'accoppiamento dei parametri<br>");
        } else {
            $updateQuery =  "UPDATE ShareYourUsersTime SET ". 
                            "user = ? , ".
                            "name = ? , ".
                            "surname = ? , ".
                            "phone = ? , ".
                            "email = ? , ".
                            "street = ? ,".
                            "photo = ? ".
                            "WHERE user='$fieldFilter';";

                         
            if ( !($update_prep_stmt = mysqli_prepare($conn, $updateQuery)) )
                die ("Errore nella preparazione della query<br>");
            if ( !mysqli_stmt_bind_param($update_prep_stmt, "sssssss",
                $usr,  $name, $surname, $phone, $email, $street,$path) )
                die ("Errore nell'accoppiamento dei parametri<br>");
        }
        upDataAndCheck($update_prep_stmt);
        mysqli_stmt_close($update_prep_stmt);
        mysqli_close($conn);
        rename($pathOld,$path);

    }
    
    
    function updataInto_ShareYourJobsTime($fieldToUpdate, $fieldValue, $fieldToSearch) {
		$conn = connectionToDb();

		$fieldToUpdate = sanitizeToSql($fieldToUpdate, $conn);
        $fieldValue = sanitizeToSql($fieldValue, $conn);
        $fieldToSearch = sanitizeToSql($fieldToSearch, $conn);
		        
        
        $updateQuery =  "UPDATE ShareYourJobsTime SET ". 
                        "$fieldToUpdate = ?  ".
                        "WHERE IdJob = ? ;";
    
        if ( !($update_prep_stmt = mysqli_prepare($conn, $updateQuery)) )
            die ("Errore nella preparazione della query<br>");
        if ( !mysqli_stmt_bind_param($update_prep_stmt, "si", $fieldValue,$fieldToSearch) )
            die ("Errore nell'accoppiamento dei parametri<br>");
        
        upDataAndCheck($update_prep_stmt);
        mysqli_stmt_close($update_prep_stmt);
        mysqli_close($conn);        
    }


