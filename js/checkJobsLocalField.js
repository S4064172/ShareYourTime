"use strict";


function checkDescription(idCheck,idErr){
   
    var desc = document.getElementById(idCheck);
    var errDEsc = document.getElementById(idErr);
    errDEsc.style.fontSize = '0.9em';
    errDEsc.style.color = 'darkred';
    if(desc == null || desc.value === ""){
        errDEsc.innerHTML="Descrizione non valida";
        return;
    }

    if( !checkMinLength( desc.value, DescriptionMinLength)){
        errDEsc.innerHTML="Descrizione troppo corta";
        return;
    }

    if( !checkMaxLength( desc.value, DescriptionMaxLength)){
        errDEsc.innerHTML="Descrizione troppo corta";
        return;
    }

    //manca controllo regex
}

function checkCost(idCheck,idErr){
   
    var check = document.getElementById(idCheck);
    var errCheck = document.getElementById(idErr);
    errCheck.style.fontSize = '0.9em';
    errCheck.style.color = 'darkred';
    if(check == null || check.value === ""){
        errCheck.innerHTML="Costo non valida";
        return;
    }

    if( !checkMin(parseInt(check.value), CostMin)){
        errCheck.innerHTML="Costo >= 0 ";
        return;
    }

    //manca controllo regex
}

function checkDistance(idCheck,idErr){
   
    var check = document.getElementById(idCheck);
    var errCheck = document.getElementById(idErr);
    errCheck.style.fontSize = '0.9em';
    errCheck.style.color = 'darkred';
    if(check == null || check.value === ""){
        errCheck.innerHTML="Distanza non valida";
        return;
    }

    if( !checkMin(parseInt(check.value), DistanceMin)){
        errCheck.innerHTML="Distanza >= 0 ";
        return;
    }

    //manca controllo regex
}

function checkStreet(idCheck,idErr){
   
    var desc = document.getElementById(idCheck);
    var errDEsc = document.getElementById(idErr);
    errDEsc.style.fontSize = '0.9em';
    errDEsc.style.color = 'darkred';
    if(desc == null || desc.value === ""){
        errDEsc.innerHTML="Strada non valida";
        return;
    }

    if( !checkMinLength( desc.value, StreetMinLength)){
        errDEsc.innerHTML="Strada troppo corta";
        return;
    }

    if( !checkMaxLength( desc.value, StreetMaxLength)){
        errDEsc.innerHTML="Strada troppo corta";
        return;
    }

    //manca controllo regex
}