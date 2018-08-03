<?php
    if ( session_status() == PHP_SESSION_NONE ) {
        session_start();
	}
	
	if ( !isset($_SESSION['user']) || empty($_SESSION['user']) ) {
       header("Location: ../index/index.php");
	}

    $_SESSION['page'] = "viewjobsrequired";

    require_once('../utils/constant.php');
?>

<html>
 	<head>
    	<?php require ('../header/header.html'); ?>
	    <link rel="stylesheet" type="text/css" href="../navBar/navBar.css"/> 
		<link rel="stylesheet" type="text/css" href="../footer/footer.css"/>
        <link rel="stylesheet" type="text/css" href="../menu/menu.css"/>
        <link rel="stylesheet" type="text/css" href="viewJobs.css"/>
        <link rel="stylesheet" type="text/css" href="../modalView/modalView.css"/>
        <link rel="stylesheet" type="text/css" href="../cardjobs/card.css"/>

		<link rel="stylesheet" type="text/css" href="../modalView/evalMod.css"/>
		
    </head>

    <body onclick="myCollapseHide();">
        <?php require_once ('../navBar/navBar.php'); ?>
		<?php require_once('../noscript/noscript.html'); ?>
        <?php require_once("../cardjobs/showAllCard.php");?>
        <?php require_once('../modalView/evalModal.php'); ?>

        <section class="viewJobs" onClick="hideItem('menu');">
            <?php require_once("../menu/menu.php"); ?>
            <?php require_once("../modalView/jobsView.php");?>
			<?php if ( isset($_SESSION['errorEval']) && !empty($_SESSION['errorEval']) ) { ?>
					<div id="alertDelete" class="alert alert-danger" style="z-index:50; margin-top: 4em; position: fixed; width: 100%; font-size: 18px;" role="alert">
						<?php echo $_SESSION['errorEval']; ?>
						<button type="button" onclick="hideItem('alertDelete')" class="close myClose" style="padding-top: 0.35em;" aria-label="Close">
		        	    	<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php
   					unset($_SESSION['errorEval']);	
				} ?>
            <div class="myContainer text-center titleSessionTesto">
				<h1><b class="colorTitle">Lavori richiesti</b></h1>
				<br>	
                <?php 
                    //tutti i lavori richiesti da user ancora validi
                    showJobs("SELECT * FROM ShareYourJobsTime where Receiver = '".$_SESSION['user']."' and TimeStart > NOW() ORDER BY TimeStart"); 
                ?>
            </div>
        </section>

        <section class="viewJobs" onClick="hideItem('menu');">

        <?php require_once("../menu/menu.php"); ?>
        <?php require_once("../modalView/jobsView.php");?>
            <div class="myContainer text-center titleSessionTesto">
                <h1><b class="colorTitle">Lavori che ti sono stati fatti</b></h1>
                <br>	
                <?php 
                   //tutti i lavori richiesti da user non validi
                    showJobs("SELECT * FROM ShareYourJobsTime where Receiver = '".$_SESSION['user']."' and TimeStart < NOW() ORDER BY TimeStart DESC"); 
                ?>
            </div>  
        </section>

        <?php require ('../footer/footer.php'); ?>

        <!-- BOOTSTRAP -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>


        <script type="text/javascript" src="../js/constant.js"></script>
        <script type="text/javascript" src="../js/utils.js"></script>
        <script type="text/javascript" src="../js/navBar.js"></script>
        <script type="text/javascript" src="../js/viewJobs.js"></script>
		<script type="text/javascript" src="../js/checkJobsField.js"></script>
		<script type="text/javascript" src="../js/viewJobsRequired.js"></script>

    </body>
</html>
