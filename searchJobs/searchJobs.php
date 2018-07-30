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
       
    </head>
	
	<body>
        
        <?php require_once ('../navBar/navBar.php'); ?>

        <section class="optionSearch">
            <?php require_once("../menu/menu.php"); ?>
            <div class="myContainer text-center titleSessionTesto">
                <h1><b>Cerca un lavoro</b></h1>
            </div>
        </section>

        <section class="optionSearch" onClick="hideItem('menu');">
            
        <div class="myContainer" id="resetOption">
            <div class="row" id="resetOption">
                <div class="col-md-3"> 
                    <input id="optionStreet" onchange="cleanErr('errOptionStreet');checkStreet('optionStreet','errOptionStreet');" class="mySelection" placeholder="Inserisci la via" name="street" minlength=<?php echo StreetMinLength?> maxlength=<?php echo StreetMaxLength?>>
                    <p id="errOptionStreet"></p>
                </div>

                <div class="col-md-3"> 
                    <select class="custom-select mySelection"  onchange="cleanErr('errOptionDistance');checkDistance('optionDistance','errOptionDistance');" id="optionDistance" name="distance">
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
                    <select class="custom-select mySelection" id="optionTag" name="tag" onchange="cleanErr('errOptionTag');checkTagField('optionTag','errOptionTag');">
                        <option selected disabled>Scegli il tag</option>
                        <?php
                            require_once('../db/connection.php');

                            $getJobsQuery = "SELECT Tag FROM ShareYourTagsTime ORDER BY Tag ASC;";
                            $conn = connectionToDb();

                            if ( !($res = mysqli_query($conn, $getJobsQuery)) ) 
                                die('Errore nella selezione dei lavori');

                            while( $row = mysqli_fetch_array($res) ) 
                                echo '<option>'.$row['Tag'].'</option>';

                            mysqli_free_result($res);
                            mysqli_close($conn);
                        ?>	
                    </select>
                    <p id="errOptionTag"></p>
                </div>
            </div>
        </div>

        <div class ="row">
            <div class="offset-4 col-md-2"> 
                <button type="button" class="btn btn-secondary mb-2 myButtonSearchMap" onClick="cleanErr('errOptionTag');cleanErr('errOptionCost');cleanErr('errOptionDistance');cleanErr('errOptionStreet');checkAllSearchJob()">
                <i class="fas fa-search"></i>
                Cerca
                </button>
            </div>

            <div class="col-md-2"> 
                <button type="button" class="btn btn-secondary mb-2 myButtonSearchMap" onClick="cleanErr('errOptionTag');cleanErr('errOptionCost');cleanErr('errOptionDistance');cleanErr('errOptionStreet');resetSearch();">
                <i class="fas fa-eraser"></i>
                    Azzera ricerca
                </button>
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
        <script type="text/javascript" src="../js/navBar.js"></script>
        <script type="text/javascript" src="../js/checkJobsField.js"></script>
        <script type="text/javascript" src="../js/searchJobs.js"></script>

        <?php require_once('googleAPIkey.html'); ?>
		
	</body>
</html>
