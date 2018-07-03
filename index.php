<!DOCTYPE html>
<html>
 	<head>
    	<?php
	      require ('header/header.html');
	    ?>
    	<link rel="stylesheet" type="text/css" href="index.css"/>
	    <link rel="stylesheet" type="text/css" href="navBar/navBar.css"/> 
		<link rel="stylesheet" type="text/css" href="footer/footer.css"/>
		<link rel="stylesheet" type="text/css" href="modalRegistrazione-Login/login-registrazione.css"/>
		<link rel="stylesheet" type="text/css" href="last5.css"/>
	  </head>
	
	<body>

    <?php
        require ('navBar/navBar.php');
	?>

	
	<section id="homeView">
		
		<div class="myContainer">
			<div cass="row">
				<div class="col-3 col-md-6 offset-4  offset-sm-6 ">
					<div style="height:100vh;">
						<h1 class="text-center myTitle" style="padding-top:30vh">Share Your<br>Time</h1>
					</div>
				</div>
			</div>
		</div>
		<!--
			-> Login a scomparsa
		-->	
	  	<?php
	      require ('modalRegistrazione-Login/login.php');
	    ?>

		<!--
				-> Sign-up a scomparsa
		-->	
	  	<?php
	      require ('modalRegistrazione-Login/registrazione.php');
	    ?>
    
	</section>
	<div id="TagDettagliSito"></div>
	<section id="DettagliSito">
		<div class="myContainer">
			<div class="text-center" id="DettagliSitoTesto">
				<h1><b>Share Your Time</b></h1>
				<br>
					<div class="row">
						<div class="col-sm-4 border-right"> <br>descrizione del nostro sito </div>
						<div class="col-sm-4"> 
							<p>
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
		<div class=" myContainer text-center">
			<h1><b>I Nuovi Lavori</b></h1>
			
			<?php
       			require ('last5.html');
			?>		

		</div>
	</section>
	<div id="TagRicerca"></div>
	<section id="RicercaMappa">
		<div class="text-center" id="DettagliSitoTesto">
				<h1><b>Cerca un lavoro</b></h1>
		</div>
		<div class="myContainer">
			<div class="row">
				<div class="col-sm-4"> 
					<label for=""><b>Inserisci la via</b></label>
					<input type="text" placeholder="Inserisci la via" name="" required>
				</div>
				<div class="col-sm-4"> 
					<label for=""><b>Inserisci la via</b></label>
					<input type="text" placeholder="Inserisci la via" name="" required>
				</div>
				<div class="col-sm-4"> 
					<label for=""><b>Inserisci la via</b></label>
					<input type="text" placeholder="Inserisci la via" name="" required>
				</div>
				
				
			</div>

		</div>
	</section>

    <?php
       require('footer/footer.php');
    ?>

    <!--script type="text/javascript" src="index.js"></script-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
  </body>
</html>
