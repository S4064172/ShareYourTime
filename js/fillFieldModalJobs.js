"use strict";

function fillModalFieldJobs(){

    document.getElementById('modalDescription').value=
        document.getElementById('cardDescription').getAttribute('value');
    document.getElementById('modalCost').value=
        document.getElementById('cardCost').getAttribute('value');
    
<<<<<<< HEAD
    var startDate =  document.getElementById('cardTimeStart').getAttribute('value').split(" ");
    document.getElementById('modalDateStart').value=startDate[0];
    var startTime =startDate[1].split(":");
    document.getElementById('modalTimeStart').value=startTime[0]+":"+startTime[1];
        

    var endDate =  document.getElementById('cardTimeEnd').getAttribute('value').split(" ");
    document.getElementById('modalDateEnd').value= endDate[0];
    var endTime =endDate[1].split(":")
    document.getElementById('modalTimeEnd').value= endTime[0]+":"+endTime[1];
=======
    document.getElementById('modalDateStart').value=
        document.getElementById('cardTimeStart').getAttribute('value').split(" ")[0];
    document.getElementById('modalTimeStart').value=
        document.getElementById('cardTimeStart').getAttribute('value').split(" ")[1];

    var endDate =  document.getElementById('cardTimeEnd').getAttribute('value').split(" ");
    document.getElementById('modalDateEnd').value= end[0];
    var endTime =end[1].split(":")
    document.getElementById('modalTimeEnd').value= 
        document.getElementById('cardTimeEnd').getAttribute('value').split(" ")[1].split(":")[0]+":"+document.getElementById('cardTimeEnd').getAttribute('value').split(" ")[1].split(":")[1];
>>>>>>> 1c69e0bb514b87200361309ab8652859ae77c9ef
    document.getElementById('modalDistance').value=
        document.getElementById('cardDistance').getAttribute('value');
    document.getElementById('modalStreet').value=
        document.getElementById('cardStreet').getAttribute('value');
    
}