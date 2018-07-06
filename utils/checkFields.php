<?php
	function check_POST_NotIsSetOrEmpty($field) 
	{
		return isset($_POST["$field"]) && !empty($_POST["$field"]);
	}

	function checkMatchRegex($inputSent, $regexToMatch) 
	{
		return preg_match($regexToMatch, $inputSent, $match);
	}
	
	function sanitizeToSql($data, $conn) 
	{
		return mysqli_real_escape_string($conn, trim($data));
	}
