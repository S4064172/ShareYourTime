<?php
    // 0 Proposer
    // 1 Receiver

    function showTableJobs($getJobsQuery, $selector) { ?>
        <table class="myTable" onload="populateTable(myTable)">
            
            <?php
                require_once('../db/connection.php');
                
                $conn = connectionToDb();
                
                if ( !($res = mysqli_query($conn, $getJobsQuery)) ) 
                    die('Errore nella selezione dei lavori');

                    $rows=mysqli_num_rows($res);
                
                    if($rows > 0){
                ?>
                    <thead>
                        <tr>
                            <th>Lavoro</th>
                            <th>Data</th>
                            <th>Luogo</th>
                            <th>Utente</th>
                        </tr>
                    </thead>
                <?php } ?>

            <tbody>
                    <?php
                        while( $row = mysqli_fetch_array($res) ){
                            $builRow ='<tr><td>'.$row['Description'].'</td><td>'.$row['JobDate'].'</td><td>'.$row['Street'].'</td><td>';
                            if($selector == 0)
                                $builRow = $builRow.$row['Proposer'].'</td></tr>';
                            else
                                $builRow = $builRow.$row['Receiver'].'</td></tr>';
                            echo $builRow;
                        }                                
            
                        mysqli_free_result($res);
                        if($rows == 0){
                    ?>	
                    <h1>NON CI SONO LAVORI</h1>	
                    <?php } ?>			
            </tbody>
        </table>
<?php } ?>