<?php
	require_once('../utils/utils.php');
	require_once('../db/updataFunctions.php');

	if ( session_status() == PHP_SESSION_NONE ) {
        session_start();
	}

	function returnToPageWithError($error) {
		$_SESSION['errorEval'] = $error;
		header('Location: ../viewJobs/viewJobsRequired.php');	
	}


	if ( !check_POST_IsSetAndNotEmpty('star') || !isset($_SESSION['id']) || empty($_SESSION['id']) ) {
		returnToPageWithError('Riscontrato errore nella valutazione');	
		return;
	}

	$user_val = intVal($_POST['star']);

	if ($user_val < 1 || $user_val > 5) {
		returnToPageWithError('Valore sconosciuto');	
		return;
	}

	updataInto_ShareYourJobsTime('Evaluation', $user_val, $_SESSION['id']); 
	unset($_SESSION['id']);
