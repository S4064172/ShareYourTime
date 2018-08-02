<?php
	require_once('../utils/utils.php');	

	if ( !check_COOKIE_IsSetAndNotEmpty('sizeC') ) {
		$cookie_name = "sizeC";
		$cookie_value = "3";
		setcookie($cookie_name, $cookie_value, time() + (600*30), "/");
	}

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

	if ( isset($_SESSION['user']) && !empty($_SESSION['user']) ) {
		header("Location: ../homepage/homepage.php");
	}

	$_SESSION['page']="index";

?>

<!DOCTYPE html>
<html>
 	<head>
    	<?php require ('../header/header.html'); ?>
    	<link rel="stylesheet" type="text/css" href="index.css"/>
	    <link rel="stylesheet" type="text/css" href="../navBar/navBar.css"/> 
		<link rel="stylesheet" type="text/css" href="../footer/footer.css"/>
		<link rel="stylesheet" type="text/css" href="../modalView/modalView.css"/>
		
		<link rel="stylesheet" type="text/css" href="../optionMapSearch/optionMapSearch.css"/>
		<link rel="stylesheet" type="text/css" href="../cardjobs/cardCarousel.css"/>
	</head>
	
	<body onresize="resizingCarousel()" onload="resizingCarousel()">

	<?php require('../noscript/noscript.html'); ?>
	<?php require ('../navBar/navBar.php'); ?>
	
	<?php if (check_COOKIE_IsSetAndNotEmpty('deleted') && $_COOKIE['deleted'] === "del") { ?>
		<div id="alertDelete" class="alert alert-danger" style="z-index:50; margin-top: 4em; position: fixed; width: 100%; font-size: 24px;" role="alert">
			Il tuo profilo &egrave; stato cancellato con successo!
			<button type="button" onclick="hideItem('alertDelete')" class="close myClose" style="padding-top: 0.35em;" aria-label="Close">
        	    <span aria-hidden="true">&times;</span>
			</button>
		</div>
		<?php
			//distruggiamo il cookie
			$cookie_name = "deleted";
			$cookie_value = "";
			setcookie($cookie_name, $cookie_value, time() + (-1), "/"); // 86400 = 1 day
		} ?>

	<section id="homeView">
		<div class="myContainer">
			<div cass="row">
				<div class="col-3 col-md-6 offset-4 offset-sm-6">
					<div id="myTitleContaitner">
						<h1 class="text-center myTitle">Share Your<br>Time<br>
							<a href="#DettagliSito" class="btn btn-scroll titleBtn">Scopri di pi&#249; !</a>
						</h1>
					</div>
				</div>
			</div>
		</div>

		<!-- Login a scomparsa -->	
	  	<?php require ('../modalView/login.php'); ?>

		<!-- Sign-up a scomparsa -->	
	  	<?php require ('../modalView/registration.php'); ?>
    
	</section>
	
	<section id="DettagliSito">
		<div class="myContainer">
			<div class="text-center" id="DettagliSitoTesto">
				<h1><b>Share Your Time</b></h1>
				<br>
				<div class="row">
					<div class="col-md-4 border-right">
						<p class="myDescription">
							In <i>ShareYourTime</i> puoi mettere a disposizione
							<br>il tuo tempo per svolgere lavori utili agli altri.
							<br><b>Registrati</b> e potrai fin da subito accettare lavori
							<br>e proporli a tua volta !
						</p>
					</div>
					<div class="col-md-4"> 
						<p class="myDescription">
							Hai esperienza in un particolare settore ? 
							<br> Cerchi di mettere qualche soldo da parte ? 
							<br> Sei la persona che fa per noi !
						</p> 
					</div>
					<div class="col-md-4 border-left">
						 <p class="myDescription"> 
							La prima piattaforma italiana di <i>Time Sharing</i> 
						</p>
						<a  href="#RicercaMappa" class="btn btn-scroll mt-3 p-2" id ="mapBtn" >Trova un lavoro per te !</a>
				</div>
			<div>
	</section>


	<section id="TabellaLast5" >
		<div id="idCarousel">
			<div class="myContainer text-center pt-5"  >
				<h1><b>Cosa proponiamo</b></h1>
				<br>	
				<?php 
					require_once('../carousel/carousel.php');
					showJobsCarousel("SELECT * FROM ShareYourJobsTime ORDER BY TimeStart DESC LIMIT 9",$_COOKIE['sizeC']);
				?>		
			</div>
		</div>
	</section>
	
	<section id="RicercaMappa">
		<div class="text-center" id="DettagliSitoTesto">
			<h1><b>Cerca un lavoro</b></h1>
			<br>
		</div>
		<div class="myContainer">
			
			<?php require_once('../optionMapSearch/optionMapSearch.php')?>

			<div class="mb-2" id="googleMap"></div>
		</div>
			
	</section>

	<?php require('../footer/footer.php'); ?>
	 
	<!-- BOOTSTRAP -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
  
	
	<script type="text/javascript" src="../js/constant.js"></script>
	<script type="text/javascript" src="../js/utils.js"></script>

	<script type="text/javascript" src="../js/navBar.js"></script>
	<script type="text/javascript" src="../js/googleMaps.js"></script>
	
	<script type="text/javascript" src="../js/checkLoginUser.js"></script>
	<script type="text/javascript" src="../js/checkSearchOptionMap.js"></script>
	
	<script type="text/javascript" src="../js/checkProfileUserField.js"></script>
	

	<?php require('googleAPIkey.html') ?>

	</body>
</html>
