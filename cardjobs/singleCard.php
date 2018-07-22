<?php
    // 0 -> visualizzazione miei lavori

    function showCart($row)  {
?>
        <div class="card">
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <h5 class="card-title"><li class="list-group-item p-0 m-0" id="cardDescription_<?php echo $row['IdJob']?>" style="height:3em" value="<?php echo $row['Description']?>" ><?php echo $row['Description']?></li></h5>
                    <li class="list-group-item" id="cardCost_<?php echo $row['IdJob']?>" value="<?php echo $row['Cost']?>"><?php echo "Costo : ".$row['Cost']?></li>
                    <li class="list-group-item" id="cardTimeStart_<?php echo $row['IdJob']?>" value="<?php echo $row['TimeStart']?>"><?php echo "Inizio : ".$row['TimeStart']?></li>
                    <li class="list-group-item" id="cardTimeEnd_<?php echo $row['IdJob']?>" value="<?php echo $row['TimeEnd']?>"><?php echo "Fine : ".$row['TimeEnd']?></li>
                    <li class="list-group-item" id="cardDistance_<?php echo $row['IdJob']?>" value="<?php echo $row['Distance']?>"><?php echo "Distanza : ".$row['Distance']?></li>
                    <?php if ($row['TimeEnd'] < date('Y-m-d H:i:s')) {?>
                        <li class="list-group-item" id="cardValuation_<?php echo $row['IdJob']?>" value="<?php echo $row['Evaluation']?>">
                            <?php 
                                //se il lavoro non ha valutazioni si da 
                                //la possibilità di valutare
                                //altrimenti si stampano le stelline 
                                //corrisponenti
                                if($row['Evaluation']==0)
                                    if($_SESSION['page'] == "viewjobs")
                                        echo "attesa valutazione";
                                    else    
                                        echo "aggiungi valutazione";
                                else
                                    for($i=0; $i<$row['Evaluation']; $i++)
                                    echo "<i class='far fa-star'></i>";
                            ?>
                        </li>
                    <?php } ?>
                    <li class="list-group-item" id="cardStreet_<?php echo $row['IdJob']?>" value="<?php echo $row['Street']?>"><?php echo $row['Street']?></li>
                    <?php if ($_SESSION['page'] == "viewjobsrequired") {?>
                        <li class="list-group-item" id="cardProposer_<?php echo $row['IdJob']?>" value="<?php echo $row['Proposer']?>"><?php echo $row['Proposer']?></li>
                    <?php } ?>
                    <?php if ( $_SESSION['page'] == "viewjobs") {?>
                    <li class="list-group-item" style="height:2em" id="cardReciver_<?php echo $row['IdJob']?>" value="<?php echo $row['Receiver']?>"><?php echo $row['Receiver']?></li>
                    <?php } ?>
                </ul>
            </div>
            
            <?php if ( $_SESSION['page'] == "viewjobs" && $row['Receiver'] == null ) {?>
                <div class="card-footer">
                    <button type="button" onClick="fillModalFieldJobs('modalModify__<?php echo $row['IdJob']?>')" id="modalModify__<?php echo $row['IdJob']?>" class="btn btn-warning mr-5" data-toggle="modal" data-target="#jobsModal">Modifica</button>
                    <a href="#" id="modalDelete__<?php echo $row['IdJob']?>" class="btn btn-danger ">Cancella</a>
                </div>
            <?php } ?>
        </div>
<?php } ?>


