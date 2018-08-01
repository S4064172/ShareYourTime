<?php 
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
	}

    require_once("../db/updataFunctions.php");

    if( !check_SESSION_IsSetAndNotEmpty('id'.$_POST['IdJob'])  || $_SESSION['id'.$_POST['IdJob']] != "prenota"){
        echo json_encode("-1");
        return;
    }

    //reciver == null

    if ( updataInto_ShareYourJobsTime('Receiver', $_SESSION['user'], $_POST['IdJob']) == 0 )
        echo json_encode("-1");
    else
        echo json_encode("0");


