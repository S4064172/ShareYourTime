
<?php
    require_once("../db/connection.php");
    require_once("../utils/checkFields.php");
    require_once("../utils/regexConstant.php");


    function checkIfExistInDb($fieldSearchUser,  $fieldSearchPsw )
	{
		$conn = selectionDB();

        $fieldSearchUser = sanitizeToSql($fieldSearchUser, $conn);
        $fieldSearchPsw = sanitizeToSql($fieldSearchPsw, $conn);
        $fieldSearchPsw=sha1($fieldSearchPsw);
		$querySelectUser = 	"SELECT user ".
							"FROM ShareYourUsersTime ".
							"WHERE user=? and password=?";

		if ( ($prep_stmt = mysqli_prepare($conn, $querySelectUser)) ) {
			if ( !mysqli_stmt_bind_param($prep_stmt, "ss", $fieldSearchUser, $fieldSearchPsw))
				die ("Errore nell'accoppiamento dei parametri<br>");
			
			if ( !mysqli_stmt_execute($prep_stmt) )
				die ("Errore nell'esecuzione della query<br>");

			mysqli_stmt_store_result($prep_stmt);
			$row = mysqli_stmt_num_rows($prep_stmt);
			
			mysqli_stmt_close($prep_stmt);
            mysqli_close($conn);
			return ($row == 1);
		}
		die ("Errore nella preparazione della query<br>");
	}


    foreach ($_POST as $key => $value) 
            check_POST_NotIsSetOrEmpty($key);
            
    if ( !checkMatchRegex($_POST['usernameLogin'], alphaNumRegex) )
        die("errore0");

    foreach(passwordRegex as $regex) {
        if ( !checkMatchRegex($_POST['pswLogin'], $regex) ) 
            die("errore1");
        
    }

    if(!checkIfExistInDb($_POST['usernameLogin'],$_POST['pswLogin']))
        die("errore2");

    session_start();
    $_SESSION['user'] = $_POST['usernameLogin'];
    header("Location: /~s4064172/ProgettoSaw/ShareYourTime/homepage.php");
    
