<table class="myTable" id="last5" onload="populateTable(myTable)">
	<thead>
		<tr>
			<th>Lavoro</th>
			<th>Data</th>
			<th>Luogo</th>
			<th>Utente</th>
		</tr>
	</thead>
	<tbody>
		<?php
			require_once('db/connection.php');

			$getJobsQuery = "SELECT * FROM ShareYourJobsTime ORDER BY TimeStart LIMIT 5";
			$conn = connectionToDb();
			
			if ( !($res = mysqli_query($conn, $getJobsQuery)) ) 
				die('Errore nella selezione dei lavori');

			while( $row = mysqli_fetch_array($res) ) 
				echo '<tr><td>'.$row['Description'].'</td><td>'.$row['JobDate'].'</td><td>'.$row['Street'].'</td><td>'.$row['Proposer'].'</td></tr>';

			mysqli_free_result($res);
		?>		
	</tbody>
</table>
