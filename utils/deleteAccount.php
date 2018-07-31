<?php 
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    
    $cookie_name = "deleted";
    $cookie_value = "del";
    setcookie($cookie_name, $cookie_value, time() + (600), "/");

    require_once("../db/deleteFunctions.php");
    deleteAccount( $_SESSION['user'] );
    require_once("logout.php");

   