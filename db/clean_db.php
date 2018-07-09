<?php
   	
    require_once("connection.php");
    include("mysql_credentials.php");

    $conn = connection();
        
    $sql = "DROP DATABASE IF EXISTS $mysql_db";
    
    if (mysqli_query($conn, $sql)) 
        echo "<br>Database rimosso con successo !";
    else 
        echo "<br>Errore rimozione database";
    
    mysqli_close($conn);
