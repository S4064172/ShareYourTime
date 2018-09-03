<?php
	require_once('connection.php');
	require_once('../utils/utils.php');
	
	
	function searchInto_ShareYourJobsTime($userFilter, $street, $distance, $cost, $tag, $user, $lat, $lon) {
		
		$conn = connectionToDb();
		$userFilter = sanitizeToSql($userFilter, $conn);
		$street = sanitizeToSql($street, $conn);
		$distance = sanitizeToSql($distance, $conn);
		$cost = sanitizeToSql($cost, $conn);
		$tag = sanitizeToSql($tag, $conn);
		$user = sanitizeToSql($user, $conn);
		$lat = sanitizeToSql($lat, $conn);
		$lon = sanitizeToSql($lon, $conn);


		$earthRadius = 6378.1;
		
		$searchQuery =  "SELECT IdJob, Description, Cost, TimeStart, TimeEnd, Distance, Evaluation, Street, Proposer, Tag, Latitude, Longitude ". 
						"FROM ShareYourJobsTime ". 
						"WHERE 	TimeStart > NOW()
								AND  Proposer != ?
								AND  Receiver is NULL
								AND ( ?='' OR Proposer = ? )
								AND ( ?='' OR ?<>0  OR Street = ? ) 
								AND ( ?=0  OR ( 
											? >= (?*SQRT(RADIANS( ? - Latitude)*RADIANS(? - Latitude) + RADIANS( ? - Longitude)*RADIANS(? -  Longitude) ) )  
											AND
											Distance >= ( ? *SQRT(RADIANS( ? - Latitude)*RADIANS( ? - Latitude) + RADIANS( ? - Longitude)*RADIANS( ? -  Longitude) ) ) ) ) 
								AND ( ?=0  OR Cost < ? ) 
								AND ( ?=''  OR Tag = ?);";
		
		if ( ($search_prep_stmt = mysqli_prepare($conn, $searchQuery)) ) {
			if ( !mysqli_stmt_bind_param($search_prep_stmt, "ssssdsddddddddddddddss",	$user, 
																						$userFilter, $userFilter,
																						$street, $distance, $street,
																						$distance, 
																							$distance, $earthRadius, $lat, $lat, $lon, $lon, 
																							$earthRadius, $lat, $lat, $lon, $lon,
																						$cost, $cost, 
																						$tag, $tag ) )
				die ("Errore nell'accoppiamento dei parametri");
			
			if ( !mysqli_stmt_execute($search_prep_stmt) )
				die ("Errore nell'aggiornamento nel DB");

			
			mysqli_stmt_store_result($search_prep_stmt);
			
			mysqli_stmt_bind_result($search_prep_stmt, $IdJob, $Description, $Cost, $TimeStart, $TimeEnd, $Distance, $Evaluation, $Street, $Proposer, $Tag, $Latitude, $Longitude);
			
		
			$i=0;
			$result = array();
			while (mysqli_stmt_fetch($search_prep_stmt)) {
				$result[$i]['IdJob']=$IdJob;	
				$result[$i]['Description']=$Description;	
				$result[$i]['Cost']=$Cost;	
				$result[$i]['TimeStart']=$TimeStart;	
				$result[$i]['TimeEnd']=$TimeEnd;	
				$result[$i]['Distance']=$Distance;	
				$result[$i]['Evaluation']=$Evaluation;	
				$result[$i]['Street']=$Street;	
				$result[$i]['Proposer']=$Proposer;	
				$result[$i]['Tag']=$Tag;
				$result[$i]['Latitude']=$Latitude;
				$result[$i++]['Longitude']=$Longitude;
			}
			mysqli_stmt_close($search_prep_stmt);
            
				
		} else {
			die ("Errore nella preparazione della query");
		}
		mysqli_close($conn);
		
        return $result;
	}

	function checkIfUserHaveThatJob($user, $job)
	{
		$conn = connectionToDb();
		$user = sanitizeToSql($user, $conn);
		$job = sanitizeToSql($job, $conn);
		

		$searchQuery =  "SELECT * ".
						"FROM ShareYourJobsTime ". 
						"WHERE 	Proposer = ? AND 
								IdJob = ?";
		
		if ( ($search_prep_stmt = mysqli_prepare($conn, $searchQuery)) ) {
			if ( !mysqli_stmt_bind_param($search_prep_stmt, "si",$user,	$job ) )
				die ("Errore nell'accoppiamento dei parametri");
			  
			if ( !mysqli_stmt_execute($search_prep_stmt) )
				die ("Errore nell'aggiornamento nel DB");

			mysqli_stmt_store_result($search_prep_stmt);
			$rows = mysqli_stmt_num_rows($search_prep_stmt);
			mysqli_stmt_close($search_prep_stmt);
                
				
		} else {
			die ("Errore nella preparazione della query");
		}
		mysqli_close($conn);
		return $rows;
        
	}