
<?php
    require_once("../db/connection.php");
    require_once("../utils/checkFields.php");
    require_once("../utils/regexConstant.php");



    foreach ($_POST as $key => $value) 
            checkDataNullOrEmpty($key);
            
    if (!checkMatchRegex($_Post['usernameLogin'],alphaNumRegex))
        die("errore");

    foreach(passwordRegex as $regex) {
        if ( !checkMatchRegex($_POST['pswReg'], $regex) ) 
            die("errore");
        
    }

    $conn = selectionDB();

    $loginSanitize = sanitizeToSql($_Post['usernameLogin'],$conn);

    

