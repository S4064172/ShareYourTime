<?php
	require_once('../utils/constant.php');
	require_once('../utils/utils.php');
	require_once('../db/insertFunctions.php');
	require_once('../db/updataFunctions.php');
	
	$result = array();

	//Controlli sulla descrizione
	if ( !check_POST_IsSetAndNotEmpty('description') 
		 || notValidString($_POST['description'], alphaNumRegex, DescriptionMinLength, DescriptionMaxLength) )
		$result['errModalDescription'] = "La descrizione non &egrave; valido";

	//Controlli sul costo
	if ( !check_POST_IsSetAndNotEmpty('cost') 
		 || $_POST['cost'] < CostMin )
	  	$result['errModalCost'] = "Il costo non &egrave; valido";

	//Controlli sulla distanza
	if ( !check_POST_IsSetAndNotEmpty('distance') 
		 || $_POST['distance'] < DistanceMin )
	  	$result['errModalDistance'] = "La distanza non &egrave; valida";

	//Controlli sulle date e sui tempi
	if ( !check_POST_IsSetAndNotEmpty('dateStart') || !check_POST_IsSetAndNotEmpty('timeStart') 
		 || !check_POST_IsSetAndNotEmpty('dateEnd') || !check_POST_IsSetAndNotEmpty('timeEnd') ) 
		$result['errTime'] = "Le date inserite non sono valide";
	
	if ( check_POST_IsSetAndNotEmpty('insert') ) {
		//inserimento
		if ( $_POST['insert'] == 'true' )
			if ( !checkDatesAndTime($_POST['dateStart'].' '.$_POST['timeStart'], $_POST['dateEnd'].' '.$_POST['timeEnd'], null) )
					$result['errTime'] = "Hai gi&agrave; un impegno in quella data1";
		//modifica
		else if ( $_POST['insert'] == 'false' )
			if ( check_POST_IsSetAndNotEmpty('IdJob') ) 
				if ( !checkDatesAndTime($_POST['dateStart'].' '.$_POST['timeStart'], $_POST['dateEnd'].' '.$_POST['timeEnd'], $_POST['IdJob']) )
					$result['errTime'] = "Hai gi&agrave; un impegno in quella data2";
				
	}	
			
	//Controlli sull'indirizzo
	if ( !check_POST_IsSetAndNotEmpty('street')
		 || notValidString($_POST['street'], addressRegex, StreetMinLength, StreetMaxLength))	
		$result['errModalStreet'] = "L'indirizzo non &egrave; valido";

	//Controlli sul tag
	if ( !check_POST_IsSetAndNotEmpty('tag') 
		 || !checkIfTagExistInDb($_POST['tag']) )
		$result['errModalTag'] = "Il tag inviato non &egrave; valido";

	//Inserimento nel DB
	if ( count($result) === 0 ) {	
    	if ( session_status() == PHP_SESSION_NONE ) {
	        session_start();
		}

		if ( $_POST['insert'] == 'true' )
			insertInto_ShareYourJobsTime(	$_POST['description'], $_POST['cost'], 
											$_POST['dateStart'].' '.$_POST['timeStart'], 
											$_POST['dateEnd'].' '.$_POST['timeEnd'], 
											$_POST['distance'], "DEFAULT", $_POST['street'], 
											$_POST['lat'], $_POST['long'], 
											$_SESSION['user'], $_POST['tag'] ); 
		else if ( $_POST['insert'] == 'false' ) 
			updateInto_ShareYourJobsTimeAll(	$_POST['description'], $_POST['cost'], 
												$_POST['dateStart'].' '.$_POST['timeStart'], 
												$_POST['dateEnd'].' '.$_POST['timeEnd'], 
												$_POST['distance'], $_POST['street'], 
												$_POST['lat'], $_POST['long'], 
												$_POST['tag'], $_POST['IdJob'] );
	}
	
	//Ritorna errori
	echo json_encode($result);
