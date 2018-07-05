<?php
    require_once("connection.php");
    $conn = selectionDB();
    
    $queryCreateTable[0] = "CREATE TABLE ShareYourUsersTime (
                    User char(25) PRIMARY KEY,
                    Password char(45) NOT NULL,
                    Name char(30) NOT NULL,
                    Surname char(30) NOT NULL,
                    Phone char(15) NOT NULL UNIQUE,
                    Email char(125) NOT NULL UNIQUE,
                    Street char(125) NOT NULL,
                    Photo char(50) NOT NULL
                );";

	//manca descrizione del lavoro o comunque un titolo
    $queryCreateTable[1] = "CREATE TABLE ShareYourJobsTime (
                    IdJob int PRIMARY KEY auto_increment,
                    Cost int NOT NULL,
                    TimeStart time NOT NULL,
                    TimeEnd time NOT NULL,
                    JobDate date NOT NULL,
                    Distance int NOT NULL,
                    Evaluation int default 0,
                    Street char(125) NOT NULL,
                    Latitude float NOT NULL,
                    Longitude float NOT NULL,
                    Receiver char(25),
                    FOREIGN KEY (receiver) REFERENCES ShareYourUsersTime (User)
                );";

    $queryCreateTable[2] = "CREATE TABLE ShareYourTagsTime (
                    Tag char(10) PRIMARY KEY
                );";

    $queryCreateTable[3] = "CREATE TABLE ShareYourTagsJobsTime (
                    Tag char(10),
                    IdJob int,
                    PRIMARY KEY (Tag,IdJob),
                    FOREIGN KEY (Tag) REFERENCES ShareYourTagsTime (Tag),
                    FOREIGN KEY (IdJob) REFERENCES ShareYourJobsTime (IdJob)
                );";
    
    foreach($queryCreateTable as $query ){     

        if ( !($prepared_stmt = mysqli_prepare($conn, $query)) )
            die ("<br>Errore creazione tabella !");
        
        if ( !mysqli_stmt_execute($prepared_stmt) ) 
            die ("Impossibile eseguire l'operazione richiesta !<br>");
                        
        echo("<br>Tabella creata con successo !");
        mysqli_stmt_close($prepared_stmt);    
    }       
        

    mysqli_close($conn);        

