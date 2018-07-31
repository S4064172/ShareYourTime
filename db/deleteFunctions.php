<?php

    require_once('connection.php');
    
//prepare stmt

    function deleteAccount($user)
    {
        $conn = connectionToDb();
        $getInfoUserQuery = "DELETE FROM ShareYourUsersTime where user='".$user."'";
        if ( !($res = mysqli_query($conn, $getInfoUserQuery)) ) 
            die('Errore nella selezione dei lavori');
        
        //mysqli_free_result($res);
        mysqli_close($conn);
    }

    function deleteJob($id)
    {
        $conn = connectionToDb();
        $getInfoUserQuery = "DELETE FROM ShareYourJobsTime where IdJob=$id";
        if ( !($res = mysqli_query($conn, $getInfoUserQuery)) ) 
            die('Errore nella selezione dei lavori');
        
        //mysqli_free_result($res);
        mysqli_close($conn);
    }
    