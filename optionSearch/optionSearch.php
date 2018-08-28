<?php if( $_SESSION['page'] != 'index' ) { ?>
<section class="optionSearch" onClick="hideItem('menu');">
<?php } else{?>
    <section class="optionSearch">
	<?php }?>      
        <div class="myContainer text-center pt-5" id="resetOption">
			<h1><b class="colorTitle">Ricerca</b></h1>	 
            <div class="row">
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
                                echo '<option value='.'"'.($i*5).'">&lt; '.($i*5).' Euro</option>';
                            for($i = 1; $i < 10; $i++)
                                echo '<option value='.'"'.($i*50).'">&lt; '.($i*50).' Euro</option>';
                            for($i = 1; $i < 10; $i++)
                                echo '<option value='.'"'.($i*500).'">&lt; '.($i*500).' Euro</option>';
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
                                die('Errore nella selezione dei tags');

                            while( $row = mysqli_fetch_array($res) ) 
                                echo '<option>'.sanitizeToHtml($row['Tag']).'</option>';

                            mysqli_free_result($res);
                            mysqli_close($conn);
                        ?>	
                    </select>
                    <p id="errOptionTag"></p>
                </div>
            </div>
<?php if( $_SESSION['page'] == 'searchjobs' ) { ?>
            <div class ="row">
                <div class="offset-md-3 col-md-6"> 
                    <select class="custom-select mySelection"  id="optionUser" name="userName" onchange="cleanErr('errOptionUser');checkUserName('optionUser','errOptionUser');">
                        <option selected disabled>Seleziona l'utente</option>
                        <?php
                            require_once('../db/connection.php');

                            $getUserQuery = "SELECT User FROM ShareYourUsersTime ORDER BY User ASC;";
                            $conn = connectionToDb();

                            if ( !($res = mysqli_query($conn, $getUserQuery)) ) 
                                die('Errore nella selezione degli utenti');

                            while( $row = mysqli_fetch_array($res) ){
                                $getValuationQuery = "SELECT AVG(Evaluation) FROM ShareYourJobsTime WHERE Proposer ='".$row['User']."' AND Evaluation <> 0;";

                                if ( !($res1 = mysqli_query($conn, $getValuationQuery)) ) 
                                    die('Errore nella selezione della media di un utente');
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
<?php } ?>

        </div>

        <div class="myContainer">
              
        </div>

        <div class="myContainer">
            <div class ="row">
                <div class="offset-md-3 col-md-3"> 
<?php if( $_SESSION['page'] == 'searchjobs' ) { ?>                    
                    <button type="button" class="btn btn-secondary mb-2 myButtonSearchMap" onClick="cleanErr('errOptionTag');cleanErr('errOptionUser');cleanErr('errOptionCost');cleanErr('errOptionDistance');cleanErr('errOptionStreet');checkAllSearchJob()">
<?php }else{ ?>
    <button type="button" class="btn btn-secondary mb-2 myButtonSearchMap" onClick="cleanErr('errOptionTag');cleanErr('errOptionCost');cleanErr('errOptionDistance');cleanErr('errOptionStreet');checkAllSearchJob()">
<?php }?>
                    <i class="fas fa-search"></i>
                    Cerca
                    </button>
                </div>

                <div class="col-md-3"> 
<?php if( $_SESSION['page'] == 'searchjobs' ) { ?>                    
    <button type="button" class="btn btn-secondary mb-2 myButtonSearchMap" onClick="resetUserOption();cleanErr('errOptionUser');resetSearch();">
<?php }else{ ?>
    <button type="button" class="btn btn-secondary mb-2 myButtonSearchMap" onClick="resetSearch();">
<?php }?>
                    <i class="fas fa-eraser"></i>
                        Azzera ricerca
                    </button>
                </div>
            </div>  
        </div>
