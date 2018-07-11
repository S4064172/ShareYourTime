<select class="mySelection" id="" requred>
    <option selected disabled>Scegli il tag</option>
    
    <?php
			require_once('db/connection.php');

			$getJobsQuery = "SELECT Tag FROM ShareYourTagsTime ORDER BY Tag ASC;";
			$conn = connectionToDb();
			
			if ( !($res = mysqli_query($conn, $getJobsQuery)) ) 
				die('Errore nella selezione dei lavori');

			while( $row = mysqli_fetch_array($res) ) 
				echo '<option>'.$row['Tag'].'</option>';

			mysqli_free_result($res);
		?>	

</select>