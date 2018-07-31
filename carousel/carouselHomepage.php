<?php
    require ('../cardjobs/singleCard.php');
    function showJobsCarousel($getJobsQuery1,$getJobsQuery2, $size) {
        require_once('../db/connection.php');
        $size=(int)$size;
        $conn = connectionToDb();
        
        if ( !($res1 = mysqli_query($conn, $getJobsQuery1)) ) 
            die('Errore nella selezione dei lavori');

        $rows1 = mysqli_num_rows($res1);

        if ( !($res2 = mysqli_query($conn, $getJobsQuery2)) ) 
            die('Errore nella selezione dei lavori');

        $rows2 = mysqli_num_rows($res2);

        mysqli_close($conn);
        
?>

    <div id="carouselIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li class='mb-2' data-target="#carouselIndicators" data-slide-to="0" class="active"></li>
        <?php 
           
            for( $i=$size ; $i< ( $rows1+$rows2 ); $i+= $size ){
                echo "<li class='mb-2' data-target='#carouselIndicators' data-slide-to='".$i."'></li>";
            }
       ?>
    </ol>
<div class="container">
    <div class="carousel-inner">
        <?php
            echo "<div class='carousel-item active'>";
                echo "<h1><b>I tuoi impegni</b></h1>";
                    echo "<div class='card-columns'>";
                        
                        for( $i = 0 ; $i < $size && ($row1 = mysqli_fetch_array( $res1 )) ; $i++ ) {
                            showCard($row1);
                        }
                        
                    echo "</div>";
                echo "<a class='btn linkdown' href='../viewJobs/viewJobs.php'>Scopri di pi&ugrave;</a>";		
            echo "</div>";
          
            for ($i=$size ; $i < $rows1 ; $i += $size){
                echo "<div class='carousel-item'>";
                    echo "<h1><b>I tuoi impegni</b></h1>";
                    echo "<div class='card-columns'>";
                        
                        for( $j = 0 ; $j < $size && $row1 = mysqli_fetch_array( $res1 ); $j++ ) {
                            showCard($row1);
                        }
                        
                    echo "</div>";
                    echo "<a class='btn' href='../viewJobs/viewJobs.php'>Scopri di pi&ugrave;</a>";		
                echo "</div>"; 
            }
                          

            for ($i=0 ; $i < $rows2 ; $i += $size){
                
                echo "<div class='carousel-item'>";
                    echo "<h1><b>Lavori che hai richiesto</b></h1>";
                        echo "<div class='card-columns'>";
                            
                            for( $j = 0 ; $j < $size && $row2 = mysqli_fetch_array( $res2 ); $j++ ) {
                                showCard($row2);
                            }
                            
                        echo "</div>";
                    echo "<a class='btn' href='../viewJobs/viewJobsRequired.php'>Scopri di pi&ugrave;</a>";
                echo "</div>"; 
        }

        ?>
    </div> 
</div> 
    <a class="carousel-control-prev" href="#carouselIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
    </div>
<?php  } ?>
