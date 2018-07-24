"use strict";

/*
    Questo file contiene tutti i controlli 
    necessari per validare i campi dei 
    lavori sia in fase di modifica che
    inserimento sia in locale che in remoto
*/


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

function checkTime(idDate1, idTime1,idDate2, idTime2,idErr){
    


    var data1 = document.getElementById(idDate1);
    var time1 = document.getElementById(idTime1);
    var data2 = document.getElementById(idDate2);
    var time2 = document.getElementById(idTime2);
    var err = document.getElementById(idErr);
    err.style.fontSize = '0.9em';
    err.style.color = 'darkred';
    
    var dateNow = new Date(data1.value+" "+time1.value);
    console.log(dateNow);
    if( data1.value < dateNow.getFullYear+"-"+dateNow.getMonth+"-"+dateNow.getDate){
        err.innerHTML="data1 < now ";
        return;
    }

    if( data1.value = dateNow.getFullYear+"-"+dateNow.getMonth+"-"+dateNow.getDate ){
        err.innerHTML="data1 < now ";
        return;
    }

    if(data1.value > data2.value ){
        err.innerHTML="data1 > data2 ";
        return;
    }

    if(data1.value == data2.value && time1.value >= time2.value){
        err.innerHTML="time1 >= time2 ";
        return;
    }


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