"use strict";

function fillModalFieldJobs(){

    document.getElementById('modalDescription').value=
        document.getElementById('cardDescription').getAttribute('value');
    document.getElementById('modalCost').value=
        document.getElementById('cardCost').getAttribute('value');
    
    document.getElementById('modalDateStart').value=
        document.getElementById('cardTimeStart').getAttribute('value').split(" ")[0];
    document.getElementById('modalTimeStart').value=
        document.getElementById('cardTimeStart').getAttribute('value').split(" ")[1];

    var endDate =  document.getElementById('cardTimeEnd').getAttribute('value').split(" ");
    document.getElementById('modalDateEnd').value= end[0];
    var endTime =end[1].split(":")
    document.getElementById('modalTimeEnd').value= 
        document.getElementById('cardTimeEnd').getAttribute('value').split(" ")[1].split(":")[0]+":"+document.getElementById('cardTimeEnd').getAttribute('value').split(" ")[1].split(":")[1];
    document.getElementById('modalDistance').value=
        document.getElementById('cardDistance').getAttribute('value');
    document.getElementById('modalStreet').value=
        document.getElementById('cardStreet').getAttribute('value');
    
}