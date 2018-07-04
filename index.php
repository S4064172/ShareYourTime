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
						<div class="col-sm-4 border-right"> <br>descrizione del nostro sito </div>
						<div class="col-sm-4"> 
							<p class="myDescription">
								<br> Hai esperienza in un particolare settore ? 
								<br> Cerchi di mettere qualche soldo da parte ? 
								<br> Sei la persona giusta per noi !
							</p> 
						</div>
						<div class="col-sm-4 border-left"> <br>Ci devo pensare </div>
					</div>
			</div>
		<div>
	</section>


	<section id="TabellaLast5">
		<div class="myContainer text-center">
			<h1><b>Cosa proponiamo</b></h1>
			
			<?php require ('last5.html'); ?>		

		</div>
	</section>
	
	<section id="RicercaMappa">
		<div class="text-center" id="DettagliSitoTesto">
				<h1><b>Cerca un lavoro</b></h1>
		</div>
		<div class="myContainer">
			<div class="row">
				<div class="col-sm-5"> 
					<label class="d-block d-sm-inline"><b>Inserisci la via</b></label>
					<input type="textMap" placeholder="Inserisci la via" name="" required>
				</div>
				<div class="col-sm-3"> 
					<label class="d-block d-sm-inline"><b>Inserisci la via</b></label>
					<input type="textMap" placeholder="Inserisci la via" name="" required>
				</div>
				<div class="col-sm-3"> 
					<label class="d-block d-sm-inline"><b>Inserisci la via</b></label>
					<input type="textMap" placeholder="Inserisci la via" name="" required>
				</div>
				<div class="col-sm-1"> 
					<button type="button" class="btn btn-secondary">
						<i class="fas fa-search"></i>
						Cerca
					</button>
				</div>
				
				
			</div>

	 <?php require('footer/footer.php'); ?>
	 
	<script type="text/javascript" src="navBar/navBar.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>


	<!--script type="text/javascript" src="index.js"></script-->

  </body>
</html>
