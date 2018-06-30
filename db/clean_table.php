<?php
    require("connection.php");

    function drop_table() {
        $conn = connectionToDb();
        
        $queryDeleteTable[0] =  "DROP TABLE ShareYourTagsJobsTime";        
		$queryDeleteTable[1] =  "DROP TABLE ShareYourTagsTime";
        $queryDeleteTable[2] =  "DROP TABLE ShareYourJobsTime";
        $queryDeleteTable[3] =  "DROP TABLE ShareYourUsersTime";
       
        foreach($queryDeleteTable as $query )      
            if ( ($prepared_stmt = mysqli_prepare($conn, $query)) ) {
                
                if ( !mysqli_stmt_execute($prepared_stmt) )
                    throw new Exception("Non sono riuscito ad eliminare la tabella !");
                
                echo("<br>Tabella rimossa con successo !");

                mysqli_stmt_close($prepared_stmt);
            }else
                echo("Tabella non rimossa !");
                    
        mysqli_close($conn);        
    }

    drop_table();
