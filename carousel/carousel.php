<?php
    require ('../cardjobs/singleCard.php');
    function showJobsCarousel($getJobsQuery, $size) {
        require_once('../db/connection.php');
        $size=(int)$size;
        $conn = connectionToDb();
        
        if ( !($res = mysqli_query($conn, $getJobsQuery)) ) 
            die('Errore nella selezione dei lavori');

        $rows = mysqli_num_rows($res);
        mysqli_close($conn);
        
?>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <?php 
            for( $i=$size ; $i<$rows; $i+= $size ){
                echo "<li data-target='#carouselExampleIndicators' data-slide-to='".$i."'></li>";
            }
       ?>
    </ol>
<div class="container">
    <div class="carousel-inner">
        <?php
                echo "<div class='carousel-item active'>";
                    echo "<div class='card-columns'>";
                       for( $i = 0 ; $i < $size && ($row = mysqli_fetch_array($res)) ; $i++ ) {
                            showCard($row);
                        }
                    echo "</div>";
                echo "</div>";
          
           for ($i=$size ; $i < $rows ; $i += $size){
                
                    echo "<div class='carousel-item'>";
                        echo "<div class='card-columns'>";
                            for( $j = 0 ; $j < $size && ($row = mysqli_fetch_array($res)); $j++ ) {
                                showCard($row);
                            }
                        echo "</div>";
                    echo "</div>"; 
            }
        ?>
    </div> 
</div> 
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
    </div>
<?php  } ?>
