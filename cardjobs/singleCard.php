<?php
    // 0 -> visualizzazione miei lavori

    function showCart($row, $selector)  {
?>
        <div class="card">
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <h5 class="card-title"><li class="list-group-item p-0 m-0" style="height:3em"><?php echo $row['Description']?></li></h5>
                    <li class="list-group-item"><?php echo "Costo : ".$row['Cost']?></li>
                    <li class="list-group-item"><?php echo "Inizio : ".$row['TimeStart']?></li>
                    <li class="list-group-item"><?php echo "Fine : ".$row['TimeEnd']?></li>
                    <li class="list-group-item"><?php echo "Distanza : ".$row['Distance']?></li>
                    <?php if ($row['TimeEnd'] < date('Y-m-d H:i:s') ) {?>
                        <li class="list-group-item"><?php echo "Valutazione : ".$row['Evaluation']?></li>
                    <?php } ?>
                    <li class="list-group-item"><?php echo $row['Street']?></li>
                    <?php if ($selector !== 0) {?>
                        <li class="list-group-item"><?php echo $row['Proposer']?></li>
                    <?php } ?>
                    <li class="list-group-item" style="height:2em"><?php echo $row['Receiver']?></li>
                </ul>
            </div>
            
            <?php if ($row['Receiver'] == null ) {?>
                <div class="card-footer">
                    <a href="#" class="mt-auto btn">Modifica</a>
                </div>
            <?php } ?>
            
        </div>
   
<?php } ?>