<?php

	/*
	*	Questa funzione stabisce una connessione
	*	senza collegarsi ad alcun database
	*/
	function connection() 
	{
		include("mysql_credentials.php");	
		$conn = mysqli_connect($mysql_server, $mysql_user, $mysql_pass);
		if (!$conn) 
		  die("Impossibile stabilire la connessione");

		return $conn;
	}

	/*
	*	Questa funzione stabisce una connessione
	*	e si collega al database specificato
	*/
	function connectionToDb()
	{
		include("mysql_credentials.php");
		$conn = connection();
		$conn_db_selected = mysqli_select_db($conn,$mysql_db);
		if (!$conn_db_selected) 
		  die ("Impossibile selezionare il database");
		return $conn;
	}
