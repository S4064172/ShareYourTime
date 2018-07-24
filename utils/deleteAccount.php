<?php 
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    
    require_once('../db/connection.php');

    $conn = connectionToDb();
    $getInfoUserQuery = "DELETE FROM ShareYourUsersTime where user='".$_SESSION['user']."'";
    echo $getInfoUserQuery;
    if ( !($res = mysqli_query($conn, $getInfoUserQuery)) ) 
                die('Errore nella selezione dei lavori');
    
    mysqli_free_result($res);
    mysqli_close($conn);

    require_once("logout.php");