<?php
	require_once('../utils/constant.php');
	require_once('../utils/utils.php');
	require_once('../db/selectFunctions.php');
	
	$result = array();
    
	//Controlli sul costo
	if (  check_POST_IsSetAndNotEmpty('cost') && $_POST['cost'] != "Seleziona il costo" 
		 && $_POST['cost'] < CostMin )
	  	$result['errOptionCost'] = "Il costo non &egrave; valido";

	//Controlli sulla distanza
	if ( check_POST_IsSetAndNotEmpty('distance') && ($_POST['distance'] != "Seleziona la distanza"
		 && $_POST['distance'] < DistanceMin ) )
	  	$result['errOptionDistance'] = "La distanza non &egrave; valida";

	
	//Controlli sull'indirizzo
	if ( check_POST_IsSetAndNotEmpty('street')
		 && notValidString($_POST['street'], addressRegex, StreetMinLength, StreetMaxLength))	
		$result['errOptionStreet'] = "L'indirizzo non &egrave; valido";

	//Controlli sul tag
	if (  check_POST_IsSetAndNotEmpty('tag') && $_POST['tag'] != "Scegli il tag" 
		 && !checkIfTagExistInDb($_POST['tag']) )
		$result['errOptionTag'] = "Il tag inviato non &egrave; valido";
    
    if ( count($result) === 0 ) {
		
		if(!check_POST_IsSetAndNotEmpty('cost') || $_POST['cost'] == "Seleziona il costo" )
			$_POST['cost'] = '';

		if(!check_POST_IsSetAndNotEmpty('distance')|| $_POST['distance'] == "Seleziona la distanza")
			$_POST['distance'] = '';

		if(!check_POST_IsSetAndNotEmpty('street'))
			$_POST['street'] = '';

		if(  !check_POST_IsSetAndNotEmpty('tag') || $_POST['tag'] == "Scegli il tag" )
			$_POST['tag'] =	'';



		$result = searchInto_ShareYourJobsTime($_POST['street'], $_POST['distance'], $_POST['cost'], $_POST['tag'] );
	
		
	}

	
	
	
	//Ritorna errori
	echo json_encode($result);
