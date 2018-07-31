<?php 
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
	}

    require_once("../db/updataFunctions.php");

    if ( updataInto_ShareYourJobsTime('Receiver', $_SESSION['user'], $_POST['IdJob']) == 0 )
        echo "-1";
    else
        echo "0";


