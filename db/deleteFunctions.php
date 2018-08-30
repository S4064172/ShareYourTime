<?php

    require_once('connection.php');
    require_once('../utils/utils.php');

	/** @description
	 * Questa funzione elimina un account dal database
	 */

    function deleteAccount($user)
    {
        $conn = connectionToDb();
        $user = sanitizeToSql($user, $conn);

        $deleteUserQuery = "DELETE FROM ShareYourUsersTime WHERE BINARY User=?";
        
        if ( ($search_prep_stmt = mysqli_prepare($conn, $deleteUserQuery)) ) {
            if ( !mysqli_stmt_bind_param($search_prep_stmt, "s",$user ) )
                die ("Errore nell'accoppiamento dei parametri");
              
            if ( !mysqli_stmt_execute($search_prep_stmt) )
                die ("Errore nell'aggiornamento nel DB");
            
            mysqli_stmt_store_result($search_prep_stmt);
            $rows = mysqli_stmt_num_rows($search_prep_stmt);
            mysqli_stmt_close($search_prep_stmt);
        }else {
            echo ("Errore nella preparazione della query");
        }
        mysqli_close($conn);
        return $rows;
    }

	/** @description
	 * Questa funzione elimina un lavoro dal database
	 */
    function deleteJob($job)
    {
        $conn = connectionToDb();

        $job = sanitizeToSql($job, $conn);
        $deleteJobQuery = "DELETE FROM ShareYourJobsTime WHERE IdJob=?";
        if ( ($search_prep_stmt = mysqli_prepare($conn, $deleteJobQuery)) ) {
            if ( !mysqli_stmt_bind_param($search_prep_stmt, "i", $job ) )
                die ("Errore nell'accoppiamento dei parametri");
              
            if ( !mysqli_stmt_execute($search_prep_stmt) )
                die ("Errore nell'aggiornamento nel DB");
            
            mysqli_stmt_store_result($search_prep_stmt);
            $rows = mysqli_stmt_num_rows($search_prep_stmt);
            mysqli_stmt_close($search_prep_stmt);
        }else {
            echo ("Errore nella preparazione della query");
        }
        mysqli_close($conn);
        return $rows;
    }
