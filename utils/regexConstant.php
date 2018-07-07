<?php
    define( "alphaNumRegex", "/^[[:alnum:] ]+$/" );
	define( "surnameRegex", "/^[[:alpha:]\']+$/" );
	define( "alphaRegex", "/^[[:alpha:]]+$/" );
    define( "emailRegex", "/^[[:alnum:]]([[:alnum:]]?|[\w\._]*[[:alnum:]])@[a-z\.]+\.[a-z]{2,}$/" ) ;
    define( "numRegex", "/^[[:digit:]]+$/" );

	define( "passwordRegex", array("/[A-Z]/", "/[a-z]/", "/[[:digit:]]/", "/[^A-Za-z0-9]/") );
