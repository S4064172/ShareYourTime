<?php
   include("mysql_credentials.php");
    
    $conn = mysqli_connect($mysql_server, $mysql_user, $mysql_pass);
    
    if (!$conn) 
        die("Connection failed: " . mysqli_connect_error());
        
    $sql = "DROP DATABASE $mysql_db";
    
    if (mysqli_query($conn, $sql)) 
        echo "<br>Database rimosso con successo !";
    else 
        echo "Error creating database: " . mysqli_error($conn);
    
    mysqli_close($conn);
