<select class="mySelection " id="">
    <option selected disabled>Seleziona la distanza</option>
    
    <?php
        $i=1;
        while( $i < 10){
            echo '<option value='.'"'.($i).'">'.($i).' Km</option>';
            $i=$i+1;
        }
        $i=1;
        while( $i < 6){
            echo '<option value='.'"'.($i*10).'">'.($i*10).' Km</option>';
            $i=$i+1;
        }
       

    ?>

</select>