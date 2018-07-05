<?php
	function check_POST_NotIsSetOrEmpty($field) 
	{
		return isset($_POST["$field"]) && !empty($_POST["$field"]);
	}

	function check_StringLength($string, $minLen, $maxLen) 
	{
		if ($minLen > $maxLen)
			return false;

		$len = strlen($string);
		return $len >= $minLen && $len <= $maxLen; 
	}
