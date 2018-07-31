<?php
	require_once('connection.php');
	require_once('../utils/utils.php');
	
	
	function searchInto_ShareYourJobsTime($street, $distance, $cost, $tag, $user) {
		
		$conn = connectionToDb();
		$street = sanitizeToSql($street, $conn);
		$distance = sanitizeToSql($distance, $conn);
		$cost = sanitizeToSql($cost, $conn);
		$tag = sanitizeToSql($tag, $conn);
		$user = sanitizeToSql($user, $conn);

		$searchQuery =  "SELECT IdJob, Description, Cost, TimeStart, TimeEnd, Distance, Evaluation, Street, Proposer, Tag ". 
						"FROM ShareYourJobsTime ". 
						"WHERE 	TimeStart > NOW()
								AND  Proposer != ?
								AND  Receiver is NULL
								AND ( ?=''   OR Street = ? ) 
								AND ( ?=0  OR Distance = ? ) 
								AND ( ?=0  OR Cost < ? ) 
								AND ( ?=''  OR Tag = ?);";
		
		if ( ($search_prep_stmt = mysqli_prepare($conn, $searchQuery)) ) {
			if ( !mysqli_stmt_bind_param($search_prep_stmt, "sssiiiiss",$user,	$street, $street, $distance, $distance, $cost, $cost, $tag, $tag ) )
				echo ("Errore nell'accoppiamento dei parametri");
			  
			if ( !mysqli_stmt_execute($search_prep_stmt) )
				echo ("Errore nell'aggiornamento nel DB");


			mysqli_stmt_store_result($search_prep_stmt);
			
			mysqli_stmt_bind_result($search_prep_stmt, $IdJob, $Description, $Cost, $TimeStart, $TimeEnd, $Distance, $Evaluation, $Street, $Proposer, $Tag);
			
		
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
				$result[$i++]['Tag']=$Tag;
			}
			mysqli_stmt_close($search_prep_stmt);
                
				
		} else {
			echo ("Errore nella preparazione della query");
		}
		mysqli_close($conn);
		
        return $result;
	}

	