<?php
	if ( session_status() == PHP_SESSION_NONE ) {
        session_start();
	}
	
	if ( !isset($_SESSION['user']) || empty($_SESSION['user']) ) {
        header("Location: ../index/index.php");
	}

	require_once('../db/connection.php');
	require_once('../utils/utils.php');

	if ( !check_POST_IsSetAndNotEmpty('textEmail') ) 
		die ("Impossibile eseguire l'operazione richiesta<br>");

	$conn = connectionToDB();

	$emailQuery = 'SELECT Email FROM ShareYourUsersTime WHERE User=?';

	if ( ($prep_stmt = mysqli_prepare($conn, $emailQuery)) ) {
			if ( !mysqli_stmt_bind_param($prep_stmt, "s", $_SESSION['user']) )
				die ("Errore nell'accoppiamento dei parametri<br>");
			
			if ( !mysqli_stmt_execute($prep_stmt) )
				die ("Errore nell'esecuzione della query<br>");
			
			mysqli_stmt_store_result($prep_stmt);
			$row = mysqli_stmt_num_rows($prep_stmt);

			if ( $row !== 1)
				die ("Errore nell'esecuzione della query<br>");

			mysqli_stmt_bind_result($prep_stmt, $emailFrom);
			mysqli_stmt_fetch($prep_stmt);

			mysqli_stmt_close($prep_stmt);
			mysqli_close($conn);

			$emailTo = 'shareyourtime.info@gmail.com';
			$object = 'Message from '.$_SESSION['user'];
			$header = "From: ".$emailFrom." \r\n";
			$message = wordwrap($_POST['textEmail'], 70, '\n');

			/*
			 *	Questa funzionalita' va bene se il server e' 
			 *	abilitato a	inviare mail all'esterno.
			 */
			if ( mail($emailTo, $object, $message, $header) ) 
				echo 'Email inviata con successo<br>';
			else
				echo 'Errore nell\'invio della mail<br>';

			header('Location: ../homepage/homepage.php');
			return;
	}
	die ("Errore nella preparazione della query<br>");
