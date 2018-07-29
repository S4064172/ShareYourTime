<?php
	require_once('connection.php');
	require_once('../utils/utils.php');

	
	function searchInto_ShareYourJobsTime($street, $distance, $cost, $tag) {
		
		$conn = connectionToDb();
		$street = sanitizeToSql($street, $conn);
		$distance = sanitizeToSql($distance, $conn);
		$cost = sanitizeToSql($cost, $conn);
		$tag = sanitizeToSql($tag, $conn);
		
		$searchQuery = "SELECT * FROM ShareYourJobsTime WHERE 	( '$street'=''   OR Street = '$street' ) AND ( '$distance'=''  OR Distance = '$distance') AND ( '$cost'=''  OR Cost = '$cost') AND ( '$tag'=''  OR Tag = '$tag');";
		
		/*if ( ($search_prep_stmt = mysqli_prepare($conn, $searchQuery)) ) {
			//if ( !mysqli_stmt_bind_param($search_prep_stmt, "ssiiiiss",	$street, $street, $distance, $distance, $cost, $cost, $tag, $tag ) )
			//echo ("Errore nell'accoppiamento dei parametri");
			  
			if ( !mysqli_stmt_execute($insert_prep_stmt) )
			echo ("Errore nell'aggiornamento nel DB");


			mysqli_stmt_store_result($prep_stmt);
			$row = mysqli_stmt_num_rows($prep_stmt);
			mysqli_stmt_close($search_prep_stmt);
                
				
		} else {
			echo ("Errore nella preparazione della query");
		}
		mysqli_close($conn);
		*/
		if ( !($res = mysqli_query($conn, $searchQuery)) ) 
			die('Errore nella selezione dei lavori');
		
		$result =array();
		$i=0;
		while ($row = mysqli_fetch_array($res))
		{
			$result[$i++] = $row['IdJob'];
		}
		mysqli_free_result($res);
		mysqli_close($conn);
		
		

        return $result;
	}

	