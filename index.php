<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
	}
	
	if ( !isset($_SESSION['user']) || empty($_SESSION['user']) ) {
        header("Location: index/index.php");
	}

    $_SESSION['page']="homepage";
    header("Location: homepage/homepage.php");
