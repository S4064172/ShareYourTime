<?php
    session_start();

    session_unset();
    session_destroy();

	header("Location:  /~s4064172/ProgettoSaw/ShareYourTime/index.php");
