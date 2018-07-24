<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
	}
	
	if ( !isset($_SESSION['user']) || empty($_SESSION['user']) ) {
        header("Location: ../index/index.php");
	}

	$_SESSION['page']="homepage";
?>
<!DOCTYPE html>
<html>
 	<head>
		<?php require ('../header/header.html'); ?>
	    <link rel="stylesheet" type="text/css" href="../navBar/navBar.css"/> 
		<link rel="stylesheet" type="text/css" href="../footer/footer.css"/>
		<link rel="stylesheet" type="text/css" href="homepage.css"/>
		<link rel="stylesheet" type="text/css" href="../contactUs/contactUs.css"/>
		<link rel="stylesheet" type="text/css" href="../menu/menu.css"/>
		<link rel="stylesheet" type="text/css" href="../table/table.css"/>
	</head>
	
	<body>

		<?php require ('../navBar/navBar.php'); ?>


		<section id="home" onClick="hideItem('menu');">
			<?php require_once("../menu/menu.php"); ?>

			<div class="myContainer">
				<div cass="row">
					<div class="col-3 col-md-6">
						<div id="myTitleContaitner">
							<h1 class="text-center myTitle">Bentornato<br><?php echo $_SESSION['user'] ?><br>
								<a href="#job" class="btn btn-scroll titleBtn">Vai ai tuoi lavori !</a>
							</h1>
						</div>
					</div>
				</div>
			</div>

		</section>

		<?php require_once ('../table/showJobsInTable.php'); ?>
		<section id="job" class="jobs" onClick="hideItem('menu');">
			<div class="myContainer text-center titleSessionTesto">
				<h1><b>I tuoi impegni</b></h1>
				<br>	
				<?php showTableJobs("SELECT * FROM ShareYourJobsTime where Proposer = '".$_SESSION['user']."' and Receiver is not null and TimeStart > NOW() ORDER BY TimeStart LIMIT 5",1); ?>
				<a class="btn mt-2" href="../viewJobs/viewJobs.php">Scopri di più</a>
			</div>
		</section>

		<section class="jobs" onClick="hideItem('menu');">
			<div class="myContainer text-center">
				<h1><b>Lavori che hai richiesto</b></h1>
				<br>	
				<?php showTableJobs("SELECT * FROM ShareYourJobsTime where Receiver = '".$_SESSION['user']."' and TimeStart > NOW() ORDER BY TimeStart LIMIT 5",0); ?>	
				<a class="btn mt-2" href="../viewJobs/viewJobsRequired.php">Scopri di più</a>
			</div>
		</section>

		<?php require ('../contactUs/contactUs.php'); ?>

		
		<?php require ('../footer/footer.php'); ?>
		

		

		<!-- BOOTSTRAP -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
	
		<script type="text/javascript" src="../js/utils.js"></script>
		<script type="text/javascript" src="../js/navBar.js"></script>
	
	
    </body>
</html>