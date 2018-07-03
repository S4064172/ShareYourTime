<?php
	
    function sanitizeToSql($data, $conn) 
	{
		return mysqli_real_escape_string($conn, trim($data));
	}

	function connectionToDb() 
	{
		include("mysql_credentials.php");	
		$conn = mysqli_connect($mysql_server, $mysql_user, $mysql_pass);
		if (!$conn) 
		  die("Impossibile stabilire la connessione");

		return $conn;
	}

	function selectionDB()
	{
		include("mysql_credentials.php");
		$conn = connectionToDb();
		$conn_db_selected = mysqli_select_db($conn,$mysql_db);
		if (!$conn_db_selected) 
		  die ("Impossibile selezionare il database");
		return $conn;
	}
