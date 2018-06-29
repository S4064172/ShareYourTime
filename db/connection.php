<?php
	
    function sanitizeToSql($data, $conn) 
	{
		return mysqli_real_escape_string($conn, trim($data));
	}

	function connectionToDb() 
	{
		include("mysql_credentials.php");	
		$conn = mysqli_connect($mysql_server, $mysql_user, $mysql_pass, $mysql_db);
		if ( mysqli_connect_errno($conn) )
				throw new Exception("Fallita la connessione a MySql" . mysqli_connect_error($conn));
		return $conn;
	}

	

   
