<?php
    
    function showCard($row)  {

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
?>
        <div class="card">
            <div class="card-body cardBack">
                <ul class="list-group list-group-flush">
                    <i><h5 class="card-title" style="padding-top:1em;"><li class="list-group-item p-0 m-0 h3em cardBack" id="cardDescription_<?php echo $row['IdJob']?>" value="<?php echo $row['Description']?>" ><?php echo $row['Description']?></li></h5></i>
                    <li class="list-group-item cardBack" id="cardCost_<?php echo $row['IdJob']?>" value="<?php echo $row['Cost']?>"><?php echo "Costo   ".$row['Cost']." &euro;"?></li>
                    <li class="list-group-item cardBack" id="cardTimeStart_<?php echo $row['IdJob']?>" value="<?php echo $row['TimeStart']?>"><?php echo "Inizio   ".$row['TimeStart']?></li>
                    <li class="list-group-item cardBack" id="cardTimeEnd_<?php echo $row['IdJob']?>" value="<?php echo $row['TimeEnd']?>"><?php echo "Fine   ".$row['TimeEnd']?></li>
					<li class="list-group-item cardBack" id="cardDistance_<?php echo $row['IdJob']?>" value="<?php echo $row['Distance']?>"><?php echo "Nel raggio di ".$row['Distance']." km"?></li>
					<li class="list-group-item cardBack" id="cardTag_<?php echo $row['IdJob']?>" value="<?php echo $row['Tag']?>"><?php echo "Categoria   ".$row['Tag']?></li>
                    <?php if ( $_SESSION['page'] == "index" || $row['TimeEnd'] < date('Y-m-d H:i:s') ) {?>
                        <li class="list-group-item h3em cardBack" id="cardValuation_<?php echo $row['IdJob']?>" value="<?php echo $row['Evaluation']?>">
                            <?php 
                                //se il lavoro non ha valutazioni si da 
                                //la possibilità di valutare
                                //altrimenti si stampano le stelline 
                                //corrisponenti
                                if( $row['Evaluation'] == 0 ){
                                    if(  $_SESSION['page'] == "index" || $_SESSION['page'] == "viewjobs" )
                                        if ($_SESSION['page'] == "index" || $row['Receiver'] == null )
                                            echo "Nessuna valutazione";
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
                    <li class="list-group-item cardBack" id="cardStreet_<?php echo $row['IdJob']?>" value="<?php echo $row['Street']?>"><?php echo $row['Street']?></li>
                    <?php if ( $_SESSION['page'] == "index" || $_SESSION['page'] == "viewjobsrequired" || $_SESSION['page'] == "homepage" ) {?>
                        <li class="list-group-item cardBack" id="cardProposer_<?php echo $row['IdJob']?>" value="<?php echo $row['Proposer']?>">Proposto da <?php echo $row['Proposer']?></li>
                    <?php } ?>
                    <?php if ( ( $_SESSION['page'] == "viewjobs" || $_SESSION['page'] == "homepage" ) ) {?>
                        <?php if ( $row['Receiver'] != null  ) {?>
                            <li class="list-group-item h2em cardBack" id="cardReciver_<?php echo $row['IdJob']?>" value="<?php echo $row['Receiver']?>">Richiesto da <?php echo $row['Receiver']?></li>
                        <?php } else{?>
                            <li class="list-group-item h2em cardBack" id="cardReciver_<?php echo $row['IdJob']?>">Disponibile al momento</li>
                        <?php } ?>
                    <?php } ?>
                </ul>
            </div>

					<?php if ( $_SESSION['page'] != "homepage" && $_SESSION['page'] != "index" ) { ?>	
                <div class="card-footer mh4em">
            <?php if ( $_SESSION['page'] == "viewjobs" && $row['Receiver'] == null ) {?>
                    <button type="button" onClick="emptyErrorModalJobs(); fillModalFieldJobs('modalModify_<?php echo $row['IdJob']?>')" id="modalModify_<?php echo $row['IdJob']?>" class="btn btn-warning mr-5" data-toggle="modal" data-target="#jobsModal">Modifica</button>
                    <a href="#" id="modalDelete_<?php echo $row['IdJob']?>" class="btn btn-danger ">Cancella</a>
			<?php } ?>
				</div>
			<?php } ?>
        </div>
<?php } ?>


