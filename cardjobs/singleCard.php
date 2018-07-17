<?php
    function showCart($row, $selector)  {
?>
        <div class="card">
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <h5 class="card-title"><li class="list-group-item p-0 m-0" style="height:3em"><?php echo $row['Description']?></li></h5>
                    <li class="list-group-item"><?php echo $row['Cost']?></li>
                    <li class="list-group-item"><?php echo $row['TimeStart']?></li>
                    <li class="list-group-item"><?php echo $row['TimeEnd']?></li>
                    <li class="list-group-item"><?php echo $row['Distance']?></li>
                    <li class="list-group-item"><?php echo $row['Evaluation']?></li>
                    <li class="list-group-item"><?php echo $row['Street']?></li>
                    <li class="list-group-item"><?php echo $row['Proposer']?></li>
                    <li class="list-group-item" style="height:2em"><?php echo $row['Receiver']?></li>
                </ul>
            </div>
            <div class="card-footer">
                <a href="#" class="mt-auto btn">Modifica</a>
            </div>
        </div>
   
<?php } ?>