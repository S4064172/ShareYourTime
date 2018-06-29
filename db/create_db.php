<?php
    include("mysql_credentials.php");
    
    $conn = mysqli_connect($mysql_server, $mysql_user, $mysql_pass);
    
    if (!$conn) 
        die("Connection failed: " . mysqli_connect_error());
        
    $sql = "CREATE DATABASE IF NOT EXISTS $mysql_db";

    if (mysqli_query($conn, $sql))
        echo "<br>Database creato con successo !";
    else
        echo "<br>Errore nella creazione del database: " . mysqli_error($conn) . "!";
    
	mysqli_select_db($conn, $mysql_db);

    mysqli_close($conn);
