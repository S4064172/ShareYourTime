<?php 
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
	}


    require_once("../db/updataFunctions.php");

    updataInto_ShareYourJobsTime('Receiver', $_SESSION['user'], $_POST['IdJob']);
