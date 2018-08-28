<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
	}
	
	if ( !isset($_SESSION['user']) || empty($_SESSION['user']) ) {
       header("Location: ../index/index.php");
	}

    $_SESSION['page']="searchjobs";

    require_once('../utils/constant.php');   
?>
<!DOCTYPE html>
<html lang="it">
 	<head>
    	<?php require ('../header/header.html'); ?>
	    <link rel="stylesheet" type="text/css" href="../navBar/navBar.css"/> 
		<link rel="stylesheet" type="text/css" href="../footer/footer.css"/>
        <link rel="stylesheet" type="text/css" href="../menu/menu.css"/>
        <link rel="stylesheet" type="text/css" href="searchJobs.css"/>
        <link rel="stylesheet" type="text/css" href="../optionSearch/optionSearch.css"/>
        <link rel="stylesheet" type="text/css" href="../cardjobs/card.css"/>
        <link rel="stylesheet" type="text/css" href="../alert/alert.css"/>
    </head>
	
	<body onclick="myCollapseHide();">
        <?php require_once ('../navBar/navBar.php'); ?>
        <?php require_once('../noscript/noscript.html'); ?>
        
        <section class="optionSearch" onClick="hideItem('menu');">
            <?php require_once("../menu/menu.php"); ?>
            <?php require_once ('../alert/alert.php'); ?>
            <div class="text-center titleSessionTesto viewSearch">
				<h1><b class="colorTitle">Cerca un lavoro</b></h1>
				<div class="myContainer text-center">
					<div class="jumbotron myJumbo">
						<p><i>"Immagina di avere un conto in banca sul quale ogni mattina vengono accreditati 86400&euro;. Ogni sera la banca cancella da quello stesso conto qualsiasi cifra tu non sia 
							riuscito a spendere durante il giorno. Cosa faresti con quei 86400&euro; giornalieri ? Non li spenderesti forse fino all'ultimo centesimo ? In realt&agrave; tu gi&agrave;
							disponi di un conto 'bancario' simile: si chiama TEMPO. Ogni giorno ti vengo accreditati 86400 secondi. A mezzanotte in punto puoi considerare perso qualsiasi ammontare
							tu non abbia investito saggiamente durante la giornata. Non puoi andare in rosso e non puoi accumulare pi&ugrave; tempo. Non puoi chiedere anticipi o dilazioni di 
							pagamento. Devi vivere nel presente. Investi quegli 86400 secondi in salute, felicit&agrave; e successo. L'orologio non si ferma, va sempre avanti. <br>
							Non sprecare il tuo tempo."</i><br><br>Lo staff di <b><i>ShareYourTime</i></b></p>
					</div>
				</div>
			</div>

        </section>

        

        <?php require_once('../optionSearch/optionSearch.php')?>

        <div class="myContainer text-center titleSessionTesto" id="resetResault">
            <div class="card-columns" id="printCard">

            </div>
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
        <script src="../js/checkJobsField.js"></script>
        <script src="../js/bookJobs.js"></script>
        <script src="../js/optionSearch.js"></script>
        
        <?php require_once('googleAPIkey.html'); ?>
		
	</body>
</html>
