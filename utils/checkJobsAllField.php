<?php
	require_once('../utils/constant.php');
	require_once('../utils/utils.php');
	require_once('../db/connection.php');
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


	//finire i controlli e inserire il lavoro nel DB
