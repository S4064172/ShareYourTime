<?php

/*******************Costanti DataBase********************/
    define('UserNameMaxLength',25);
    define('UserNameMinLength',5);
    define('PasswordMaxLength',45);
    define('PasswordMinLength',8);
    define('NameMaxLength',30);
    define('NameMinLength',2);
    define('SurnameMaxLength',30);
    define('SurnameMinLength',2);
    define('EmailMaxLength',125);
    define('EmailMinLength',6);
    define('StreetMaxLength',125);
    define('StreetMinLength',6);
    define('PhotoMaxLength',50);
    define('PhoneLength',10);
    define('DescriptionMinLength',10);
    define('DescriptionMaxLength',150);
    define('TagMaxLength',20);
	define('CostMin',0);
	define('DistanceMin',0);


/*******************Costanti Regex********************/
    define( "alphaNumRegex", "/^[[:alnum:] ]+$/" );
    define( "addressRegex", "/^[[:alpha:]][[:alnum:],. ]+$/" );
	define( "surnameRegex", "/^[[:alpha:]\']+$/" );
	define( "alphaRegex", "/^[[:alpha:]]+$/" );
    define( "emailRegex", "/^[[:alnum:]]([[:alnum:]]?|[\w\._]*[[:alnum:]])@[a-z\.]+\.[a-z]{2,}$/" ) ;
    define( "numRegex", "/^[[:digit:]]+$/" );
	define( "passwordRegex", array("/[A-Z]/", "/[a-z]/", "/[[:digit:]]/", "/[^A-Za-z0-9]/") );
