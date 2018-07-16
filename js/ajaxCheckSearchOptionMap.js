"use strict";

/** @description
*	Questa funzione ci permette di creare 
*	una richiesta in post per controllare
*	i campi che l'utente ha inserito.  
*	Viene utilizzata una chiamata ajax
*	per rimanere nella stessa pagina.
*/
function checkOptionSearchMap()
{
	var request = getRequest();
	request.open("POST", "checkOptionSearchMap.php", true);	
	request.onreadystatechange = validateCheckOptionSearchMap(request);
	request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	var htmlTagStreet = document.getElementById('optionMapStreet');
    var htmlTagCost = document.getElementById('optionMapCost');
    var htmlTagDistance = document.getElementById('optionMapDistance');
	var htmlTag = document.getElementById('optionMapTag');
	
    console.log( htmlTagStreet.name + "=" + htmlTagStreet.value);
    console.log( htmlTagCost.name+ "=" +htmlTagCost.value);
    console.log( htmlTagDistance.name+ "=" +htmlTagDistance.value );
    console.log( htmlTag.name+ "=" +htmlTag.value);
    
    request.send(   htmlTagStreet.name + "=" + htmlTagStreet.value+"&"+
                    htmlTagCost.name+ "=" +htmlTagCost.value+"&"+
                    htmlTagDistance.name+ "=" +htmlTagDistance.value+"&"+
                    htmlTag.name+ "=" +htmlTag.value);
	
}

/** @description
*	Questa callback ci permette di
*	informare l'utente sull'esito
*	dei controlli fatti
*/
function validateCheckOptionSearchMap(request)
{
	return function(){
		if (request.readyState === 4 && request.status === 200) {
			if (request.responseText != null) {
				var jsonObj = JSON.parse(request.responseText);
				for(var key in jsonObj){
					var notify = document.getElementById(key);
					notify.style.color = 'darkred';
					notify.innerHTML = jsonObj[key];
				}
			}
		}
	}
}
