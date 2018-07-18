<?php
    require_once("../utils/checkFields.php");
    require_once("../utils/regexConstant.php");
    require_once("../utils/dataBaseConstant.php");
    

    $result = array();
    if (!check_POST_IsSetAndNotEmpty('optionMapStreet') || 
        notValidString($_POST['optionMapStreet'], addressRegex, StreetMinLength, StreetMaxLength) ){
            $result['errStreetSearch'] = "Indirizzo non valido !";
    }

    if ($_POST['optionMapDistance'] === "Seleziona la distanza" ){
        $result['errDistanceSearch'] = "Distanza non valida !";
    }
    
    echo json_encode($result);

    
