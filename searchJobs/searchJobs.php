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

<html>
 	<head>
    	<?php require ('../header/header.html'); ?>
	    <link rel="stylesheet" type="text/css" href="../navBar/navBar.css"/> 
		<link rel="stylesheet" type="text/css" href="../footer/footer.css"/>
        <link rel="stylesheet" type="text/css" href="../menu/menu.css"/>
        <link rel="stylesheet" type="text/css" href="searchJobs.css"/>
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
				<h1><b>Cerca un lavoro</b></h1>
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

        <section class="optionSearch" onClick="hideItem('menu');">
            
        <div class="myContainer" id="resetOption">
            <div class="row" id="resetOption">
                <div class="col-md-3"> 
                    <input id="optionStreet" onchange="cleanErr('errOptionStreet');checkStreetSearch('optionStreet','errOptionStreet');" class="mySelection" placeholder="Inserisci la via" name="street" minlength=<?php echo StreetMinLength?> maxlength=<?php echo StreetMaxLength?>>
                    <p id="errOptionStreet"></p>
                </div>

                <div class="col-md-3"> 
                    <select class="custom-select mySelection"  onchange="cleanErr('errOptionDistance');checkDistanceSearch('optionStreet','optionDistance','errOptionDistance');" id="optionDistance" name="distance">
                    <option selected disabled>Seleziona la distanza</option>
                    <?php
                        for($i = 1; $i < 10; $i++)
                            echo '<option value='.'"'.($i).'">'.($i).' Km</option>';
                        for($i = 1; $i < 6; $i++)
                            echo '<option value='.'"'.($i*10).'">'.($i*10).' Km</option>';
                    ?>
                    </select>
                <p id="errOptionDistance"></p>
                </div>

                <div class="col-md-3"> 
                    <select class="custom-select mySelection"  id="optionCost" name="cost" onchange="cleanErr('errOptionCost'); checkCost('optionCost','errOptionCost')">
                        <option selected disabled>Seleziona il costo</option>
                        <?php
                            for($i = 1; $i < 10; $i++)
                                echo '<option value='.'"'.($i*5).'">'.($i*5).' Euro</option>';
                            for($i = 1; $i < 10; $i++)
                                echo '<option value='.'"'.($i*50).'">'.($i*50).' Euro</option>';
                            for($i = 1; $i < 10; $i++)
                                echo '<option value='.'"'.($i*500).'">'.($i*500).' Euro</option>';
                        ?>
                    </select>
                    <p id="errOptionCost"></p>
                </div>

                <div class="col-md-3"> 
                    <select class="custom-select mySelection" id="optionTag" name="tag" onchange="cleanErr('errOptionTag');checkTag('optionTag','errOptionTag');">
                        <option selected disabled>Scegli il tag</option>
                        <?php
                            require_once('../db/connection.php');

                            $getTagsQuery = "SELECT Tag FROM ShareYourTagsTime ORDER BY Tag ASC;";
                            $conn = connectionToDb();

                            if ( !($res = mysqli_query($conn, $getTagsQuery)) ) 
                                die('Errore nella selezione dei lavori');

                            while( $row = mysqli_fetch_array($res) ) 
                                echo '<option>'.sanitizeToHtml($row['Tag']).'</option>';

                            mysqli_free_result($res);
                            mysqli_close($conn);
                        ?>	
                    </select>
                    <p id="errOptionTag"></p>
                </div>
            </div>

            <div class ="row">
                <div class="offset-md-3 col-md-3"> 
                    <select class="custom-select mySelection"  id="optionUser" name="userName" onchange="cleanErr('errOptionUser');checkUserName('optionUser','errOptionUser');">
                        <option selected disabled>Seleziona l'utente</option>
                        <?php
                            require_once('../db/connection.php');

                            $getUserQuery = "SELECT User FROM ShareYourUsersTime ORDER BY User ASC;";
                            $conn = connectionToDb();

                            if ( !($res = mysqli_query($conn, $getUserQuery)) ) 
                                die('Errore nella selezione dei lavori');

                            while( $row = mysqli_fetch_array($res) ){
                                $getValuationQuery = "SELECT AVG(Evaluation) FROM ShareYourJobsTime WHERE Proposer ='".$row['User']."' AND Evaluation <> 0;";

                                if ( !($res1 = mysqli_query($conn, $getValuationQuery)) ) 
                                    die('Errore nella selezione dei lavori');
                                $row1 = mysqli_fetch_array($res1);
                                if ($row['User'] != $_SESSION['user']){
                                    echo '<option>'.sanitizeToHtml($row['User']);
        /*                            for ($i=0 ; $i < (int)$row1[0]; $i++)
                                        echo "1 <i class='fa fa-star' style='color: rgb(196,160,0);'></i>";
        */                          echo '</option>';
                                    mysqli_free_result($res1);
                                }
                            }
                                
                            mysqli_free_result($res);
                            mysqli_close($conn);                                
                        ?>
                    </select>
                    <p id="errOptionUser"></p>
                </div>

            </div>

        </div>

        <div class="myContainer">
              
        </div>

        <div class="myContainer">
            <div class ="row">
                <div class="offset-md-3 col-md-3"> 
                    <button type="button" class="btn btn-secondary mb-2 myButtonSearchMap" onClick="cleanErr('errOptionTag');cleanErr('errOptionUser');cleanErr('errOptionCost');cleanErr('errOptionDistance');cleanErr('errOptionStreet');checkAllSearchJob()">
                    <i class="fas fa-search"></i>
                    Cerca
                    </button>
                </div>

                <div class="col-md-3"> 
                    <button type="button" class="btn btn-secondary mb-2 myButtonSearchMap" onClick="resetSearch();">
                    <i class="fas fa-eraser"></i>
                        Azzera ricerca
                    </button>
                </div>
            </div>  
        </div>

        <div class="myContainer text-center titleSessionTesto" id="resetResault">
            <div class="card-columns" id="printCard">

            </div>
        </div>

        </section>

        <?php require ('../footer/footer.php'); ?>

        <!-- BOOTSTRAP -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    
        <script type="text/javascript" src="../js/constant.js"></script>
        <script type="text/javascript" src="../js/utils.js"></script>
        <script type="text/javascript" src="../js/alert.js"></script>
        <script type="text/javascript" src="../js/navBar.js"></script>
        <script type="text/javascript" src="../js/checkJobsField.js"></script>
        <script type="text/javascript" src="../js/bookJobs.js"></script>
        <script type="text/javascript" src="../js/searchJobs.js"></script>
        
        <?php require_once('googleAPIkey.html'); ?>
		
	</body>
</html>
