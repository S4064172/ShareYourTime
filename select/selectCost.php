<select class="mySelection"  id="">
    <option selected disabled>Seleziona il costo</option>
    
    <?php
        $i=1;
        while( $i < 10){
            echo '<option value='.'"'.($i*5).'">'.($i*5).' Euro</option>';
            $i=$i+1;
        }
        $i=1;
        while( $i < 10){
            echo '<option value='.'"'.($i*50).'">'.($i*50).' Euro</option>';
            $i=$i+1;
        }
        $i=1;
        while( $i < 10){
            echo '<option value='.'"'.($i*500).'">'.($i*500).' Euro</option>';
            $i=$i+1;
        }

    ?>




</select>