<?php

    require_once('connection.php');
    


    function deleteAccount($user)
    {
        $conn = connectionToDb();
        $user = sanitizeToSql($user, $conn);
		


        $deleteUserQuery = "DELETE FROM ShareYourUsersTime where user=?";
        
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

    function deleteJob($job)
    {
        $conn = connectionToDb();

        $job = sanitizeToSql($job, $conn);
        $deleteJobQuery = "DELETE FROM ShareYourJobsTime where IdJob=?";
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
    

    

        
            
            