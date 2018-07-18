"use strict";

function fillModalFieldJobs(){


console.log(document.getElementById('cardDescription').getAttribute('value'));

    document.getElementById('modalDescription').value=
        document.getElementById('cardDescription').getAttribute('value');
    document.getElementById('modalCost').value=
        document.getElementById('cardCost').getAttribute('value');
    //l'ora di inzio e fine sono passate assieme
    var str = document.getElementById('cardTimeStart').getAttribute('value');
    var res = str.split(',');
    document.getElementById('modalTimeStart').value=res[0];
   document.getElementById('modalTimeEnd').value= res[1];
    document.getElementById('modalDistance').value=
        document.getElementById('cardDistance').getAttribute('value');
    document.getElementById('modalStreet').value=
        document.getElementById('cardStreet').getAttribute('value');
    
}