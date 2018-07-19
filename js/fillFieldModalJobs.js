"use strict";

function fillModalFieldJobs(){

    document.getElementById('modalDescription').value=
        document.getElementById('cardDescription').getAttribute('value');
    document.getElementById('modalCost').value=
        document.getElementById('cardCost').getAttribute('value');
    
    var startDate =  document.getElementById('cardTimeStart').getAttribute('value').split(" ");
    document.getElementById('modalDateStart').value=startDate[0];
    var startTime =startDate[1].split(":");
    document.getElementById('modalTimeStart').value=startTime[0]+":"+startTime[1];
        

    var endDate =  document.getElementById('cardTimeEnd').getAttribute('value').split(" ");
    document.getElementById('modalDateEnd').value= endDate[0];
    var endTime =endDate[1].split(":")
    document.getElementById('modalTimeEnd').value= endTime[0]+":"+endTime[1];
    document.getElementById('modalDistance').value=
        document.getElementById('cardDistance').getAttribute('value');
    document.getElementById('modalStreet').value=
        document.getElementById('cardStreet').getAttribute('value');
    
}