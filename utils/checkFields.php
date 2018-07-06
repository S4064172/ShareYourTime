<?php
	function check_POST_NotIsSetOrEmpty($field) 
	{
		return isset($_POST["$field"]) && !empty($_POST["$field"]);
	}

	function checkMatchRegex($inputSent, $regexToMatch) 
	{
		return preg_match($regexToMatch, $inputSent, $match);
	}