<?php
     if (session_status() == PHP_SESSION_NONE) {
        session_start();
	}
	
	if ( !isset($_SESSION['user']) || empty($_SESSION['user']) ) {
       header("Location: ../index/index.php");
	}

    $_SESSION['page']="viewjobs";

    require_once('../utils/dataBaseConstant.php');
    require_once('../utils/checkFields.php');
    require_once('../db/connection.php');

    $conn = connectionToDb();
    $getInfoUserQuery = "SELECT User,Name,Surname,Phone,Email,Street,Photo FROM ShareYourUsersTime where user='".$_SESSION['user']."'";
    if ( !($res = mysqli_query($conn, $getInfoUserQuery)) ) 
                die('Errore nella selezione dei lavori');
    $row = mysqli_fetch_array($res);
    mysqli_free_result($res);
    mysqli_close($conn);
    
?>


<html>
 	<head>
    	<?php require ('../header/header.html'); ?>
	    <link rel="stylesheet" type="text/css" href="../navBar/navBar.css"/> 
		<link rel="stylesheet" type="text/css" href="../footer/footer.css"/>
        <link rel="stylesheet" type="text/css" href="../menu/menu.css"/>
        <link rel="stylesheet" type="text/css" href="viewJobs.css"/>
        <link rel="stylesheet" type="text/css" href="../table/table.css"/>

	</head>
	
	<body>
        <?php require_once("../cardjobs/showAllCard.php");?>
        <?php require_once ('../navBar/navBar.php'); ?>

        <section class="viewJobs" onClick="hideItem('menu');">

            <?php require_once("../menu/menu.php"); ?>
            
            <div class="myContainer text-center titleSessionTesto">
				<h1><b>I tuoi impegni</b></h1>
				<br>	
                <?php 
                    //tutti i lavori inseriti da user che sono stati accettati da altri utenti ancora validi
                    showJobs("SELECT * FROM ShareYourJobsTime where Proposer = '".$_SESSION['user']."' and Receiver is not NULL and TimeStart > NOW() ORDER BY TimeStart", 0); 
                ?>
            </div>
            
            
        </section>

        <section class="viewJobs" onClick="hideItem('menu');">


        <div class="myContainer text-center titleSessionTesto">
            <h1><b>Le tue disponibilit&agrave;</b></h1>
            <br>	
            <?php 
                //tutti i lavori inseriti da user che non sono stati accettati da altri utenti ancora validi
                showJobs("SELECT * FROM ShareYourJobsTime where Proposer = '".$_SESSION['user']."' and Receiver is NULL and TimeStart > NOW() ORDER BY TimeStart", 0);
            ?>
        </div>


        </section>

        <section class="viewJobs" onClick="hideItem('menu');">
            <div class="myContainer text-center titleSessionTesto">
                <h1><b>Lavori passati</b></h1>
                <br>	
                <?php 
                    //tutti i lavori inseriti da user che non sono validi
                    showJobs("SELECT * FROM ShareYourJobsTime where Proposer = '".$_SESSION['user']."' and TimeStart < NOW() ORDER BY TimeStart", 0); 
                ?>
            </div>
        </section>


        <?php require ('../footer/footer.php'); ?>

        <!-- BOOTSTRAP -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    
        
        
        <script type="text/javascript" src="../js/utils.js"></script>
	    <script type="text/javascript" src="../js/navBar.js"></script>
	    <script type="text/javascript" src="../js/viewProfile.js"></script>
	    <script type="text/javascript" src="../js/ajaxCheckModifiedAllField.js"></script>
           
	</body>
</html>