<?php
	require_once("../utils/utils.php");
	 

    function showCard($row)  {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
?>
        
        <div class="card" id="<?php echo sanitizeToHtml($row['IdJob'])?>">
            <div class="card-body cardBack">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item p-0 m-0 h3em cardBack"><h5 class="card-title"><i id="cardDescription_<?php echo sanitizeToHtml($row['IdJob'])?>" class="aa" ><?php echo sanitizeToHtml($row['Description'])?></i></h5></li>
                    <li class="list-group-item cardBack"><?php echo "Costo  <i id='cardCost_".sanitizeToHtml($row['IdJob'])."'>".sanitizeToHtml($row['Cost'])."</i> &euro;" ?></li>
                    <li class="list-group-item cardBack"><?php echo "Inizio  <i id='cardTimeStart_".sanitizeToHtml( $row['IdJob'])."'>".sanitizeToHtml($row['TimeStart']) ?></i></li>
                    <li class="list-group-item cardBack"><?php echo  "Fine  <i id='cardTimeEnd_".sanitizeToHtml( $row['IdJob'])."'>".sanitizeToHtml($row['TimeEnd']) ?></i></li>
					<li class="list-group-item cardBack"><?php echo  "Nel raggio di <i id='cardDistance_".sanitizeToHtml( $row['IdJob'])."'>".sanitizeToHtml($row['Distance'])."</i> Km." ?></li>
					<li class="list-group-item cardBack"><?php echo "Categoria : <i id='cardTag_".sanitizeToHtml( $row['IdJob'])."'>".sanitizeToHtml($row['Tag']) ?></i></li>
                    <?php  if ($_SESSION['page'] != "index" && $row['TimeStart'] < date('Y-m-d H:i:s') ) {?>
                        <li class="list-group-item h3em cardBack paddingbutton" id="cardValuation_<?php echo sanitizeToHtml( $row['IdJob']) ?>">
                            <?php 
                                //se il lavoro non ha valutazioni si da 
                                //la possibilità di valutare
                                //altrimenti si stampano le stelline 
                                //corrisponenti
                                if( $row['Evaluation'] == 0 ){
                                    if( $_SESSION['page'] == "viewjobs" )
                                        if ( $row['Receiver'] == null )
                                            echo  "Nessuna valutazione";
                                        else
                                            echo "In attesa di valutazione";
                                    else   
                                        if ( $row['TimeEnd'] > date('Y-m-d H:i:s') ) 
                                            echo "Aggiungi una valutazione";
										else { 
											$_SESSION['id'.$row['IdJob']]="valuta";
                            ?>
											<button class="evalbtn" onclick="addEventToEvalModal(<?php echo $row['IdJob'] ?>)" data-toggle="modal" data-target="#evalModal" > 
												<i class="fas fa-medal"></i>
												<span>Valuta questo lavoro !</span>
											</button>
                            <?php       } 
								} else
										for($i = 0; $i < 5; $i++)
											if ( $i < $row['Evaluation'] )
												echo "<i class='fa fa-star checked' style='color: rgb(196,160,0);'></i>";
											else
												echo "<i class='fa fa-star'></i>";
                            ?>
                        </li>
                    <?php } ?>
                    <li class="list-group-item cardBack h5em"><i id="cardStreet_<?php echo sanitizeToHtml( $row['IdJob']) ?>"><?php echo sanitizeToHtml( $row['Street']) ?></i></li>
                    <?php if ( $_SESSION['page'] == "index" || $_SESSION['page'] == "viewjobsrequired" || $_SESSION['page'] == "homepage" || $_SESSION['page'] == "searchjobs" ) {?>
                        <li class="list-group-item cardBack" id="cardProposer_<?php echo sanitizeToHtml( $row['IdJob']) ?>">Proposto da <?php echo sanitizeToHtml( $row['Proposer']) ?></li>
                    <?php } ?>
                    <?php if ( ( $_SESSION['page'] == "viewjobs" || $_SESSION['page'] == "homepage" ) ) {?>
                        <?php if ( $row['Receiver'] != null  ) {?>
                            <li class="list-group-item h2em cardBack" id="cardReciver_<?php echo sanitizeToHtml( $row['IdJob']) ?>">Richiesto da <?php echo sanitizeToHtml( $row['Receiver']) ?></li>
                        <?php } else {?>
                            <li class="list-group-item h2em cardBack" id="cardReciver_<?php echo sanitizeToHtml( $row['IdJob']) ?>" >Disponibile al momento</li>
                        <?php } ?>
                    <?php } ?>
                </ul>
            </div>

            <?php if ( $_SESSION['page'] != "homepage" && $_SESSION['page'] != "index" ) { ?>	
                <div class="card-footer mh4em">
                    <?php if ( $_SESSION['page'] == "viewjobs" && $row['Receiver'] == null ) {
                        
                            $_SESSION['id'.$row['IdJob']]="modOrDel";
					?>
                        <button type="button" onClick="emptyErrorModalJobs(); fillModalFieldJobs('modalModify_<?php echo sanitizeToHtml( $row['IdJob']) ?>');" id="modalModify_<?php echo sanitizeToHtml( $row['IdJob']) ?>" class="btn btn-warning mr-5" data-toggle="modal" data-target="#jobsModal">Modifica</button>
                        <button id="modalDelete_<?php echo sanitizeToHtml( $row['IdJob']) ?>" class="btn btn-danger" onClick="addEvent(<?php echo sanitizeToHtml( $row['IdJob']) ?>);" data-toggle="modal" data-target="#confirmDelete">Elimina</button>
                    <?php } ?>
                    <?php if ( $_SESSION['page'] == "searchjobs" ) {
                            $_SESSION['id'.$row['IdJob']]="prenota";  ?>
                        <button type="button" onClick="bookJobs('<?php echo sanitizeToHtml( $row['IdJob']) ?>')" id="addJob_<?php echo sanitizeToHtml( $row['IdJob']) ?>" class="btn btn-success">Prenota</button>
                        <?php } ?>       
                </div>
            <?php } ?>
        </div>
<?php } ?>
