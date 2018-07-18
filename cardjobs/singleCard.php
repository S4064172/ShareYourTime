<?php
    // 0 -> visualizzazione miei lavori

    function showCart($row, $selector)  {
?>
        <div class="card">
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <h5 class="card-title"><li class="list-group-item p-0 m-0" id="cardDescription" style="height:3em" value="<?php echo $row['Description']?>" ><?php echo $row['Description']?></li></h5>
                    <li class="list-group-item" id="cardCost" value="<?php echo $row['Cost']?>"><?php echo "Costo : ".$row['Cost']?></li>
                    <li class="list-group-item" id="cardTimeStart" value="<?php echo $row['TimeStart']?>"><?php echo "Inizio : ".$row['TimeStart']?></li>
                    <li class="list-group-item" id="cardTmeEnd" value="<?php echo $row['TimeEnd'].','.$row['TimeEnd']?>"><?php echo "Fine : ".$row['TimeEnd']?></li>
                    <li class="list-group-item" id="cardDistance" value="<?php echo $row['Distance']?>"><?php echo "Distanza : ".$row['Distance']?></li>
                    <?php if ($row['TimeEnd'] < date('Y-m-d H:i:s') ) {?>
                        <li class="list-group-item" id="cardValuation" value="<?php echo $row['Evaluation']?>"><?php echo "Valutazione : ".$row['Evaluation']?></li>
                    <?php } ?>
                    <li class="list-group-item" id="cardStreet" value="<?php echo $row['Street']?>"><?php echo $row['Street']?></li>
                    <?php if ($selector !== 0) {?>
                        <li class="list-group-item" id="cardProposer" value="<?php echo $row['Proposer']?>"><?php echo $row['Proposer']?></li>
                    <?php } ?>
                    <li class="list-group-item" style="height:2em" id="cardReciver" value="<?php echo $row['Receiver']?>"><?php echo $row['Receiver']?></li>
                </ul>
            </div>
            
            <?php if ($row['Receiver'] == null ) {?>
                <div class="card-footer">
                    <button type="button" onClick="fillModalFieldJobs()" class="btn btn-warning mr-5" data-toggle="modal" data-target="#exampleModal">Modifica</button>
                    <a href="#" class="btn btn-danger ">Cancella</a>
                </div>
            <?php } ?>
        </div>
<?php } ?>