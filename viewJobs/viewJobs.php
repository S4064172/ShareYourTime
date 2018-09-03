<?php
     if (session_status() == PHP_SESSION_NONE) {
        session_start();
	}
	
	if ( !isset($_SESSION['user']) || empty($_SESSION['user']) ) {
       header("Location: ../index/index.php");
	}

    $_SESSION['page']="viewjobs";

    require_once('../utils/constant.php');   
?>
<!DOCTYPE html>
<html lang="it">
 	<head>
    	<?php require ('../header/header.html'); ?>
	    <link rel="stylesheet" type="text/css" href="../navBar/navBar.css"/> 
		<link rel="stylesheet" type="text/css" href="../footer/footer.css"/>
        <link rel="stylesheet" type="text/css" href="../menu/menu.css"/>
        <link rel="stylesheet" type="text/css" href="viewJobs.css"/>
        <link rel="stylesheet" type="text/css" href="../cardjobs/card.css"/>
        <link rel="stylesheet" type="text/css" href="../alert/alert.css"/>
        <link rel="stylesheet" type="text/css" href="../modalView/modalView.css"/>
	</head>
	
	<body onclick="myCollapseHide();">
        <?php require_once ('../navBar/navBar.php'); ?>
		<?php require_once('../noscript/noscript.html'); ?>
        <?php require_once("../cardjobs/showAllCard.php");?>
       
        <section class="viewJobs" onClick="hideItem('menu');">
            <?php require_once("../menu/menu.php"); ?>
            <?php require_once("../modalView/jobsView.php");?>
            <?php require_once("../modalView/confirmOperation.php"); ?>
            <?php require_once ('../alert/alert.php'); ?>

            <div class="myContainer text-center titleSessionTesto" id="prova">
				<h1><b class="colorTitle">I tuoi impegni</b></h1>
				<br>	
                <?php 
                    //tutti i lavori inseriti da user che sono stati accettati da altri utenti ancora validi
                    showJobs("SELECT * FROM ShareYourJobsTime WHERE Proposer = '".$_SESSION['user']."' and Receiver is not NULL and TimeStart > NOW() ORDER BY TimeStart"); 
                ?>
            </div>
        </section>

        <section class="viewJobs" onClick="hideItem('menu');">
			<div class="myContainer text-center titleSessionTesto">
				<h1><b class="colorTitle">Le tue disponibilit&agrave;</b></h1>
				<br>	
				<?php 
					//tutti i lavori inseriti da user che non sono stati accettati da altri utenti ancora validi
					showJobs("SELECT * FROM ShareYourJobsTime where Proposer = '".$_SESSION['user']."' and Receiver is NULL and TimeStart > NOW() ORDER BY TimeStart");
				?>
			</div>
        </section>

        <section class="viewJobs" onClick="hideItem('menu');">
            <div class="myContainer text-center titleSessionTesto">
                <h1><b class="colorTitle">Lavori passati</b></h1>
                <br>	
                <?php 
                    //tutti i lavori inseriti da user che non sono validi
                    showJobs("SELECT * FROM ShareYourJobsTime where Proposer = '".$_SESSION['user']."' and TimeStart < NOW() ORDER BY TimeStart DESC"); 
                ?>
            </div>
        </section>


        <?php require ('../footer/footer.php'); ?>

        <!-- BOOTSTRAP -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    
        <script src="../js/constant.js"></script>
        <script src="../js/utils.js"></script>
        <script src="../js/alert.js"></script>
	    <script src="../js/navBar.js"></script>
        <script src="../js/viewJobs.js"></script>
        <script src="../js/checkJobsField.js"></script>
        <script src="../js/checkProfileUserField.js"></script>

		<?php require_once('googleAPIkey.html'); ?>
	</body>
</html>
