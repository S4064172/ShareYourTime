<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

	if ( isset($_SESSION['user']) && !empty($_SESSION['user']) ) {
        header("Location: homepage.php");
	}
?>
<!DOCTYPE html>
<html>
 	<head>
    	<?php require ('header/header.html'); ?>
    	<link rel="stylesheet" type="text/css" href="index.css"/>
	    <link rel="stylesheet" type="text/css" href="navBar/navBar.css"/> 
		<link rel="stylesheet" type="text/css" href="footer/footer.css"/>
		<link rel="stylesheet" type="text/css" href="modalRegistrazione-Login/login-registrazione.css"/>
		<link rel="stylesheet" type="text/css" href="last5.css"/>
		<link rel="stylesheet" type="text/css" href="optionMapSearch/optionMapSearch.css"/>

	</head>
	
	<body>

    <?php require ('navBar/navBar.php'); ?>
	
	<section id="homeView">
		<div class="myContainer">
			<div cass="row">
				<div class="col-3 col-md-6 offset-4 offset-sm-6">
					<div id="myTitleCOntaitner">
						<h1 class="text-center myTitle">Share Your<br>Time<br>
							<a id="xxx" href="#DettagliSito" class="btn btn-scroll titleBtn">Scopri di pi&#249; !</a>
						</h1>
					</div>
				</div>
			</div>
		</div>

		<!-- Login a scomparsa -->	
	  	<?php require ('modalRegistrazione-Login/login.php'); ?>

		<!-- Sign-up a scomparsa -->	
	  	<?php require ('modalRegistrazione-Login/registration.php'); ?>
    
	</section>
	
	<section id="DettagliSito">
		<div class="myContainer">
			<div class="text-center" id="DettagliSitoTesto">
				<h1><b>Share Your Time</b></h1>
				<br>
				<div class="row">
					<div class="col-sm-4 border-right">
						<p class="myDescription">
							In <i>ShareYourTime</i> puoi mettere a disposizione
							<br>il tuo tempo per svolgere lavori utili agli altri.
							<br><b>Registrati</b> e potrai fin da subito accettare lavori
							<br>e proporli a tua volta !
						</p>
					</div>
					<div class="col-sm-4"> 
						<p class="myDescription">
							Hai esperienza in un particolare settore ? 
							<br> Cerchi di mettere qualche soldo da parte ? 
							<br> Sei la persona che fa per noi !
						</p> 
					</div>
					<div class="col-sm-4 border-left">
						 <p class="myDescription"> 
							La prima piattaforma italiana di <i>Time Sharing</i> 
						</p>
						<a  href="#RicercaMappa" class="btn btn-scroll mt-3 p-2" id ="mapBtn" >Trova un lavoro per te !</a>
				</div>
			<div>
	</section>


	<section id="TabellaLast5">
		<div class="myContainer text-center">
			<h1><b>Cosa proponiamo</b></h1>
			<br>	
			<?php require ('last5.php'); ?>		
		</div>
	</section>
	
	<section id="RicercaMappa">
		<div class="text-center" id="DettagliSitoTesto">
			<h1><b>Cerca un lavoro</b></h1>
			<br>
		</div>
		<div class="myContainer">
			
			<?php require_once('optionMapSearch/optionMapSearch.php')?>

			<div class="mb-2" id="googleMap" ></div>
		</div>
			
	</section>

	<?php require('footer/footer.php'); ?>
	 
	<!-- BOOTSTRAP -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
  
	
	
	<script type="text/javascript" src="js/navBar.js"></script>
	<script type="text/javascript" src="js/googleMaps.js"></script>
	<script type="text/javascript" src="js/utils.js"></script>
	<script type="text/javascript" src="js/ajaxCheckRegistrationAllField.js"></script>
	<script type="text/javascript" src="js/ajaxCheckRegistrationSingleField.js"></script>
	<script type="text/javascript" src="js/ajaxCheckLoginAllField.js"></script>
	<script type="text/javascript" src="js/ajaxCheckSearchOptionMap.js"></script>

	<?php require('googleAPIkey.html') ?>

	</body>
</html>
