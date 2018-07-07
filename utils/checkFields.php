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

	function checkMinLength($string, $min) {
		return strlen($string) >= $min;
	}
	
	function checkMaxLength($string, $max) {
		return strlen($string) <= $max;
	}

	function notValidString($string, $regex, $minLen, $maxLen) {
		return !checkMinLength($string, $minLen) ||
			   !checkMaxLength($string, $maxLen) ||
			   !checkMatchRegex($string, $regex);
	}
