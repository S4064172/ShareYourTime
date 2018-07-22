<?php

    require_once("../utils/utils.php");
    require_once("../utils/constant.php");

    foreach ($_POST as $key => $value) 
        if( !check_POST_IsSetAndNotEmpty($key) ){
            echo json_encode(array('code' => -1, 'msg' => 'Username o password errati !'));
            return;
        }
            
    if ( !checkMatchRegex($_POST['usernameLogin'], alphaNumRegex) ){
        echo json_encode(array('code' => -1, 'msg' => 'Username o password errati !'));
        return;
    }

    foreach(passwordRegex as $regex) {
        if ( !checkMatchRegex($_POST['pswLogin'], $regex) ){
            echo json_encode(array('code' => -1, 'msg' => 'Username o password errati !'));
            return;
        }
        
    }

    if( !checkIfUserWithPswExistInDb($_POST['usernameLogin'], $_POST['pswLogin']) ){
            echo json_encode(array('code' => -1, 'msg' => 'Username o password errati !'));
            return;
    }

    session_start();
    $_SESSION['user'] = $_POST['usernameLogin'];
    echo json_encode(array('code' => 0));

    
