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
	</head>
	
	<body>

    <?php require ('navBar/navBar.php'); ?>
	
	<section id="homeView">
		<div class="myContainer">
			<div cass="row">
				<div class="col-3 col-md-6 offset-4 offset-sm-6">
					<div style="height: 100vh;">
						<h1 class="text-center myTitle" style="padding-top:31.5vh">Share Your<br>Time<br>
							<a id="xxx" href="#DettagliSito" class="btn btn-scroll titleBtn">Scopri di pi&#249; !</a>
						</h1>
					</div>
				</div>
			</div>
		</div>


		<!-- Login a scomparsa -->	
	  	<?php require ('modalRegistrazione-Login/login.php'); ?>

		<!-- Sign-up a scomparsa -->	
	  	<?php require ('modalRegistrazione-Login/registrazione.php'); ?>
    
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
						<a  href="#RicercaMappa" class="btn btn-scroll titleBtn mt-3 p-2" style="font-size: 18px;">Trova un lavoro per te !</a>
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
			<form>
				<div class="row">
					<div class="col-md-4"> 
						<input type="textMap" placeholder="Inserisci la via" name="" required>
					</div>
					<div class="col-md-2"> 
						<select class="mySelection" id="" requred>
							<option selected disabled>Scegli la distanza in km</option>
							<option value="10">10 Km</option>
							<option value="20">20 Km</option>
							<option value="30">30 Km</option>
						</select>
					</div>
					<div class="col-md-2"> 
						<select class="mySelection" id="" requred>
							<option selected disabled>Scegli il costo massimo</option>
							<option value="10">10 Euro</option>
							<option value="20">20 Euro</option>
							<option value="30">30 Euro</option>
						</select>
					</div>
					<div class="col-md-2"> 
						<select class="mySelection" id="" requred>
							<option selected disabled>Scegli il tag</option>
							<option value="10">Informatica</option>
							<option value="20">Idraulico</option>
							<option value="30">Becchino</option>
						</select>
					</div>
					<div class=" col-md-2"> 
						<button type="submit" class="btn btn-secondary" id="myButtonSearchMap">
							<i class="fas fa-search"></i>
							Cerca
						</button>
					</div>
				</div>
			</form>
			<div id="googleMap" style="width:100%;height:65vh;"></div>
		</div>
			
	</section>

	<?php require('footer/footer.php'); ?>
	 
	<!-- BOOTSTRAP -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
  

	<script type="text/javascript" src="js/navBar.js"></script>
	<script type="text/javascript" src="js/googleMaps.js"></script>
	<script type="text/javascript" src="js/ajaxRegistration.js"></script>

	<?php require('googleAPIkey.html') ?>

	</body>
</html>
