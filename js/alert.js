"use strict";


function showAlertSuccess(msg){
    var htmlTag = document.getElementById("alertDelete");
    htmlTag.classList.add("alert-success");
    htmlTag.classList.add("myAlert");
    var htmlTagText = document.getElementById("alertText");
    htmlTagText.innerHTML=msg;
    showItem('alertDelete');
}

function showAlertError(msg){
    var htmlTag = document.getElementById("alertDelete");
    htmlTag.classList.add("alert-danger");
    htmlTag.classList.add("myAlert");
    var htmlTagText = document.getElementById("alertText");
    htmlTagText.innerHTML=msg;
    showItem('alertDelete');
}
