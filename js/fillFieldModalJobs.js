"use strict";

function fillModalFieldJobs(id){

    var num=id.split("_");
    document.getElementById('modalDescription').value=
        document.getElementById('cardDescription_'+num[2]).getAttribute('value');
    document.getElementById('modalCost').value=
        document.getElementById('cardCost_'+num[2]).getAttribute('value');
    
    var startDate =  document.getElementById('cardTimeStart_'+num[2]).getAttribute('value').split(" ");
    document.getElementById('modalDateStart').value=startDate[0];
    var startTime =startDate[1].split(":");
    document.getElementById('modalTimeStart').value=startTime[0]+":"+startTime[1];
        

    var endDate =  document.getElementById('cardTimeEnd_'+num[2]).getAttribute('value').split(" ");
    document.getElementById('modalDateEnd').value= endDate[0];
    var endTime =endDate[1].split(":")
    document.getElementById('modalTimeEnd').value= endTime[0]+":"+endTime[1];
    document.getElementById('modalDistance').value=
        document.getElementById('cardDistance_'+num[2]).getAttribute('value');
    document.getElementById('modalStreet').value=
        document.getElementById('cardStreet_'+num[2]).getAttribute('value');
    
}