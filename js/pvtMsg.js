"use strict";

/** @description
 * Questa funzione crea un bottone per una nuova chat
 */
function createButton(userTo)
{
	var prevChats = document.getElementById('prevChat');

	var button = document.createElement('button');
	var span = document.createElement('span');
	var i = document.createElement('i');
	i.setAttribute('id', 'chat_' + userTo);
	i.setAttribute('class', 'fas fa-envelope');
	span.innerHTML = userTo + '&nbsp;&nbsp;';
	span.setAttribute('class', 'namesInChat');
	button.setAttribute('class', 'prevChatBtn');
    button.setAttribute('type', 'submit');
   
	button.appendChild(span);
	button.appendChild(i);

	button.onclick = onclickOldChat(userTo);

    prevChats.appendChild(button);
}

/**
 * @description
 * Questa funzione serve per assegnare un evento
 * onclick in fase di creazione di una nuova chat
 */
function onclickOldChat(userTo)
{
	return function () {
		openOldChat(userTo)
	}
}

/** @description
 * Questa funzione fa visualizzare un messaggio
 * nella sezione dedicata alla chat
 */
function createMsg(jsonObj, userTo)
{
	var chat = document.getElementById('currChat');

	var msg = document.createElement('p');
	if (jsonObj.Receiver === userTo) 
		msg.setAttribute('class', 'text-right sendMsg');
	else 
		msg.setAttribute('class', 'text-left recvMsg');
	msg.innerHTML = 'Oggetto: ' + jsonObj.Obj + '<br>Data: ' + jsonObj.Date + '<br><br>' + jsonObj.Text;
		
	chat.appendChild(msg);
	chat.scrollTop = chat.scrollHeight;
}

/** @description
 * Questa funzione apre per la prima volta una chat
 * quando viene selezionato un utente dall'elenco
 * oppure si accerta di non crearne una nuova 
 * uguale
 */
function openChat() 
{
	var userTo = document.getElementById('selectContact').value;
	document.getElementById('obj').disabled = false;
	document.getElementById('textMsg').disabled = false;
	document.getElementById('sendPvt').disabled = false;
	document.getElementById('msgTo').value = userTo;

	//controlla se per caso non ci e' arrivato un utente che non esiste
	//leggendo da quelli in lista
	var usersAllowed = document.getElementsByTagName('option');
	
	var flag = false;
	for (var i = 0; i < usersAllowed.length; i++) 
		if (userTo === usersAllowed[i].innerHTML) {
			flag = true;
			break;
		}
	
	if ( !flag ) {
		var err = document.getElementById('errMsg');
		err.innerHTML = 'Questo utente non esiste !';
		return;
	}

	var firstChat = document.getElementById('noChat');
	if ( firstChat != null && firstChat.style.display !== 'none' )
		firstChat.style.display = 'none';
   
	var allBtns = document.getElementsByClassName('namesInChat');

	//se la chat e' gia' stata creata non la ricreo 
	for (var i = 0; i < allBtns.length; i++) 
		if ( allBtns[i].innerHTML === userTo ) {
			openOldChat(userTo);
			return;
		}

	createButton(userTo);
}
  	
/** @description
 * Questa funzione si occupa di comunicare con il server
 * per gestire l'invio del messaggio con relativo
 * inserimento nel database
 */
function sendPvtMessage()
{
	var msg = document.getElementById('textMsg');
	var obj = document.getElementById('obj');
	
	if (msg.value === '' || obj.value === '') { 
		document.getElementById('errMsg').innerHTML = 'IL messaggio e l\'oggetto devono essere presenti';
		return;
	}
	
	var userTo = document.getElementById('msgTo').value

	var request = getRequest();
	request.open("POST", "../utils/sendPvt.php", true);
	request.onreadystatechange = sendPvtCallback(request, userTo);

	var formData = new FormData();
	formData.append('text', msg.value);
	formData.append('obj', obj.value);
	formData.append('receiver', userTo);
	formData.append('msgDate', new Date().toISOString().slice(0, 19).replace('T', ' '));
	
	request.send(formData);

	document.getElementById('obj').value = '';
	document.getElementById('textMsg').value = '';
}

/** @description
 * Questa funzione si occupa di mostrare una
 * chat che esisteva gia'
 */
function openOldChat(userTo)
{
	var request = getRequest();
	request.open("POST", "../utils/sendPvt.php", true);
	request.onreadystatechange = sendPvtCallback(request, userTo);

	var formData = new FormData();
	formData.append('op', 'onlychat');
	formData.append('receiver', userTo);
	
	document.getElementById('obj').disabled = false;
	document.getElementById('textMsg').disabled = false;
	document.getElementById('sendPvt').disabled = false;
	document.getElementById('msgTo').value = userTo;
	document.getElementById('chat_' + userTo).style.color = 'white'; 
	
	request.send(formData);
}

/** @description
 * Callback che si occupa di comunicare con il server
 * ed elabora la risposta
 */
function sendPvtCallback(request, userTo)
{
	document.getElementById('currChat').innerHTML = '';
	
	return function() {
		if ( request.readyState === 4 && request.status === 200 ) {
			if ( request.responseText != null ) {

				var jsonObj = JSON.parse(request.responseText);	

				if ( !('errId' in jsonObj) )	//stampo la chat
					for (var i = 0; i < jsonObj.length; i++) 
						createMsg(jsonObj[i], userTo);
				else	//altrimenti stampo l'errore
					document.getElementById(jsonObj.errId).innerHTML = jsonObj.errMsg;
			}
		}
	}	
}

