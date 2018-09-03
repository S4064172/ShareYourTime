<?php
	require_once('../db/connection.php');	

	$conn = connectionToDb();

	$last5Query = 'SELECT Description, Latitude, Longitude FROM ShareYourJobsTime ORDER BY TimeStart Desc LIMIT 5;';

	if ( !($res = mysqli_query($conn, $last5Query)) )
		die('Errore nella selezione dei lavori');
	
	$size = mysqli_num_rows($res);

	$response = array();

	for( $i = 0 ; $i < $size && ($row = mysqli_fetch_array($res)) ; $i++ ) {
    	$response[$i] = $row['Description'].'@'.$row['Latitude'].'@'.$row['Longitude'];	
    }

	mysqli_close($conn);

	echo json_encode($response);
