<?php
    require_once("../utils/utils.php");
    function showCard($row)  {

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
?>
        <div class="card" id="<?php echo sanitizeToHtml($row['IdJob'])?>">
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <h5 class="card-title"><li class="list-group-item p-0 m-0 h3em" id="cardDescription_<?php echo sanitizeToHtml($row['IdJob'])?>" value="<?php echo sanitizeToHtml($row['Description'])?>" ><?php echo sanitizeToHtml($row['Description'])?></li></h5>
                    <li class="list-group-item" id="cardCost_<?php echo sanitizeToHtml($row['IdJob'])?>" value="<?php echo sanitizeToHtml( $row['Cost']) ?>"><?php echo sanitizeToHtml( "Costo : ".$row['Cost']) ?></li>
                    <li class="list-group-item" id="cardTimeStart_<?php echo sanitizeToHtml( $row['IdJob']) ?>" value="<?php echo sanitizeToHtml( $row['TimeStart']) ?>"><?php echo sanitizeToHtml( "Inizio : ".$row['TimeStart']) ?></li>
                    <li class="list-group-item" id="cardTimeEnd_<?php echo sanitizeToHtml( $row['IdJob']) ?>" value="<?php echo sanitizeToHtml( $row['TimeEnd']) ?>"><?php echo sanitizeToHtml( "Fine : ".$row['TimeEnd']) ?></li>
					<li class="list-group-item" id="cardDistance_<?php echo sanitizeToHtml( $row['IdJob']) ?>" value="<?php echo sanitizeToHtml( $row['Distance']) ?>"><?php echo sanitizeToHtml( "Distanza : ".$row['Distance']) ?></li>
					<li class="list-group-item" id="cardTag_<?php echo sanitizeToHtml( $row['IdJob']) ?>" value="<?php echo sanitizeToHtml( $row['Tag']) ?>"><?php echo sanitizeToHtml( "Tag : ".$row['Tag']) ?></li>
                    <?php  if ( $_SESSION['page'] == "index" || $row['TimeStart'] < date('Y-m-d H:i:s') ) {?>
                        <li class="list-group-item h3em" id="cardValuation_<?php echo sanitizeToHtml( $row['IdJob']) ?>" value="<?php echo sanitizeToHtml( $row['Evaluation']) ?>">
                            <?php 
                                //se il lavoro non ha valutazioni si da 
                                //la possibilità di valutare
                                //altrimenti si stampano le stelline 
                                //corrisponenti
                                if( $row['Evaluation'] == 0 ){
                                    if(  $_SESSION['page'] == "index" || $_SESSION['page'] == "viewjobs" )
                                        if ($_SESSION['page'] == "index" || $row['Receiver'] == null )
                                            echo  "Nessuna valutazione";
                                        else
                                            echo "In attesa di valutazione";
                                    else   
                                        if ( $row['TimeEnd'] > date('Y-m-d H:i:s') ) 
                                            echo "Aggiungi una valutazione";
                                        else
                                            echo "<a>Aggiungi una valutazione</a>";
                                }else
                                    for($i=0 ; $i< $row['Evaluation']; $i++)
                                        echo "<i class='far fa-star'></i>";
                            ?>
                        </li>
                    <?php } ?>
                    <li class="list-group-item" id="cardStreet_<?php echo sanitizeToHtml( $row['IdJob']) ?>" value="<?php echo sanitizeToHtml( $row['Street']) ?>"><?php echo sanitizeToHtml( $row['Street']) ?></li>
                    <?php if ( $_SESSION['page'] == "index" || $_SESSION['page'] == "viewjobsrequired" || $_SESSION['page'] == "homepage" || $_SESSION['page'] == "searchjobs" ) {?>
                        <li class="list-group-item" id="cardProposer_<?php echo sanitizeToHtml( $row['IdJob']) ?>" value="<?php echo sanitizeToHtml( $row['Proposer']) ?>">Proposto da: <?php echo sanitizeToHtml( $row['Proposer']) ?></li>
                    <?php } ?>
                    <?php if ( ( $_SESSION['page'] == "viewjobs" || $_SESSION['page'] == "homepage" ) ) {?>
                        <?php if ( $row['Receiver'] != null  ) {?>
                            <li class="list-group-item h2em" id="cardReciver_<?php echo sanitizeToHtml( $row['IdJob']) ?>" value="<?php echo sanitizeToHtml( $row['Receiver']) ?>">Richiesto da: <?php echo sanitizeToHtml( $row['Receiver']) ?></li>
                        <?php } else{?>
                            <li class="list-group-item h2em" id="cardReciver_<?php echo sanitizeToHtml( $row['IdJob']) ?>" >Richiesto da: nessuno</li>
                        <?php } ?>
                    <?php } ?>
                </ul>
            </div>
            
                <div class="card-footer mh4em">
                    <?php if ( $_SESSION['page'] == "viewjobs" && $row['Receiver'] == null ) {?>
                        <button type="button" onClick="fillModalFieldJobs('modalModify_<?php echo sanitizeToHtml( $row['IdJob']) ?>')" id="modalModify_<?php echo sanitizeToHtml( $row['IdJob']) ?>" class="btn btn-warning mr-5" data-toggle="modal" data-target="#jobsModal">Modifica</button>
                        <a href="#" id="modalDelete_<?php echo sanitizeToHtml( $row['IdJob']) ?>" class="btn btn-danger ">Cancella</a>
                    <?php } ?>
                    <?php if ( $_SESSION['page'] == "searchjobs") {?>
                        <button type="button" onClick="bookJobs('<?php echo sanitizeToHtml( $row['IdJob']) ?>')" id="addJob_<?php echo sanitizeToHtml( $row['IdJob']) ?>" class="btn btn-success mr-5">Prenota</button>
                    <?php } ?>       
                </div>
        </div>
<?php } ?>


