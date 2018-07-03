<?php
    require_once("connection.php");
    include("mysql_credentials.php");
    
    $conn = connectionToDb();
       
    $sql = "CREATE DATABASE IF NOT EXISTS $mysql_db";

    if ( mysqli_query($conn, $sql) )
        echo "<br>Database creato con successo !";
    else
        echo "<br>Errore nella creazione del database";
    
	mysqli_select_db($conn, $mysql_db);

    mysqli_close($conn);
