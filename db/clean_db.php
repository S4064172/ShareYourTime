<?php
   	
    require("connection.php");
    include("mysql_credentials.php");

    $conn = connectionToDb();
        
    $sql = "DROP DATABASE IF EXISTS $mysql_db";
    
    if (mysqli_query($conn, $sql)) 
        echo "<br>Database rimosso con successo !";
    else 
        echo "<br>Errore rimozione database";
    
    mysqli_close($conn);
