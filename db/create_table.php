<?php
    require_once("connection.php");
    require_once("../utils/dataBaseConstant.php");
    $conn = selectionDB();
    
    $queryCreateTable[0] = "CREATE TABLE ShareYourUsersTime (
                    User char(".UserNameMaxLength.") PRIMARY KEY,
                    Password char(".PasswordMaxLength.") NOT NULL,
                    Name char(".NameMaxLength.") NOT NULL,
                    Surname char(".SurnameMaxLength.") NOT NULL,
                    Phone char(".PhoneLength.") NOT NULL UNIQUE,
                    Email char(".EmailMaxLength.") NOT NULL UNIQUE,
                    Street char(".StreetMaxLength.") NOT NULL,
                    Photo char(".PhotoMaxLength.") NOT NULL
                );";

    $queryCreateTable[1] = "CREATE TABLE ShareYourJobsTime (
                    IdJob int PRIMARY KEY auto_increment,
                    Description char(".DescriptionMaxLength.") NOT NULL,
                    Cost int NOT NULL,
                    TimeStart timestamp NOT NULL,
                    TimeEnd timestamp NOT NULL,
                    JobDate date NOT NULL,
                    Distance int NOT NULL,
                    Evaluation int default 0,
                    Street char(".StreetMaxLength.") NOT NULL,
                    Latitude float NOT NULL,
                    Longitude float NOT NULL,
                    Receiver char(".UserNameMaxLength."),
                    FOREIGN KEY (receiver) REFERENCES ShareYourUsersTime (User)
                );";

    $queryCreateTable[2] = "CREATE TABLE ShareYourTagsTime (
                    Tag char(".TagMaxLength.") PRIMARY KEY
                );";

    $queryCreateTable[3] = "CREATE TABLE ShareYourTagsJobsTime (
                    Tag char(".TagMaxLength."),
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

