<?php 
if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    
    require_once("../db/selectFunctions.php");

    if ( checkIfUserHaveThatJob($_SESSION['user'],$_POST['idJob']) == 1 ){
        require_once("../db/deleteFunctions.php");
        deleteJob($_POST['idJob']);
        echo json_encode("1");
        return;
    }
    echo json_encode("-1");