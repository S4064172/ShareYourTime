<?php 
    require_once("../utils/utils.php");
    require_once("../utils/constant.php");

    //Controlli sulla password
	if ( !check_POST_IsSetAndNotEmpty('checkPsw') || !checkMinLength($_POST['checkPsw'], PasswordMinLength) ) {
        echo json_encode("La password inserita non &egrave; valida");
        return;
    }

    foreach(passwordRegex as $regex) {
        if ( !checkMatchRegex($_POST['checkPsw'], $regex) ) {
            echo json_encode("La password inserita non &egrave; valida");
            return;
        }
    }

    if(checkIfUserWithPswExistInDb($_POST['checkUser'],$_POST['checkPsw']))
        echo json_encode("0");
    else    
        echo json_encode("La password inserita non &egrave; valida");
      


    
