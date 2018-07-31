<?php
	require_once('../utils/constant.php');
	require_once('../utils/utils.php');
	require_once('../db/insertFunctions.php');
	
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
		 || !check_POST_IsSetAndNotEmpty('dateEnd') || !check_POST_IsSetAndNotEmpty('timeEnd') 
		 || !checkDatesAndTime($_POST['dateStart'].' '.$_POST['timeStart'], $_POST['dateEnd'].' '.$_POST['timeEnd'], null) )
		$result['errTime'] = "Le date inserite non sono valide";
	
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
		insertInto_ShareYourJobsTime(	$_POST['description'], $_POST['cost'], 
										$_POST['dateStart'].' '.$_POST['timeStart'], 
										$_POST['dateEnd'].' '.$_POST['timeEnd'], 
										$_POST['distance'], "DEFAULT", $_POST['street'], 
										$_POST['lat'], $_POST['long'], 
										$_SESSION['user'], $_POST['optionModalTag'] ); 
	}
	
	//Ritorna errori
	echo json_encode($result);
