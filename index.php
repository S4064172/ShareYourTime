<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
	}
	
	if ( !isset($_SESSION['user']) || empty($_SESSION['user']) ) {
        header("Location: index/index.php");
	}

    header("Location: homepage/homepage.php");
