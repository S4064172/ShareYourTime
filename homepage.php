<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
	}
	
	if ( !isset($_SESSION['user']) || empty($_SESSION['user']) ) {
        header("Location: index.php");
	}
?>
<!DOCTYPE html>
<html>
 	<head>
		<?php require ('header/header.html'); ?>
	    <link rel="stylesheet" type="text/css" href="navBar/navBar.css"/> 
		<link rel="stylesheet" type="text/css" href="footer/footer.css"/>
		<link rel="stylesheet" type="text/css" href="homepage.css"/>
		<link rel="stylesheet" type="text/css" href="menu/menu.css"/>
	</head>
	
	<body>

    <?php require ('navBar/navBar.php'); ?>


	<section id="mainPage" onClick="hideItem('menu');">
		
		<?php require_once("menu/menu.php"); ?>

		<section id="home" onClick="hideItem('menu');">
		
		</section>

		

		<section id="contactUs" onClick="hideItem('menu');">
			<div class="container text-center">
				<div class="titleSessionTesto" id="">
					<h1><b>Contattaci</b></h1>
					<br>
				</div>
				
					<textarea id="myTextArea" rows=15 >
						
					</textarea> 
        		
				
				<div class="row text-center">
					<div class="col-12">
						<button class="btn btn-primary" id="myBntContatUs">Invia</button>
					</div>
				</div>
			<div>
		</section>

	
    <?php require ('footer/footer.php'); ?>
    

	

    <!-- BOOTSTRAP -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
  
	<script type="text/javascript" src="js/utils.js"></script>
	<script type="text/javascript" src="js/navBar.js"></script>
	
	
    </body>
</html>