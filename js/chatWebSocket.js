"use strict";

var WebSocket = WebSocket || MozWebSocket;

//valori utili al client
const serverPort = 4444;
var connection = null;
var personal_id = null;

/*
    @description: Questa funzione invia i messaggi
*/
function sendMessage() {
    var textF = document.getElementById("msgChat");

	if ( textF.value === '' )
		return;

    //se textF.value inizia con @ allora voglio contattatre un preciso utente
    //es. @kenny ciao (ciao lo deve leggere solo kenny)
    var msg;
    if ( textF.value.startsWith('@') )
        msg = {
            type: "msgToSpecificUser",
            userTo: textF.value.split(" ")[0].split("@")[1],
            msgText: textF.value,
            date: Date.now(),
            id: personal_id,
        };
    else 
        msg = {
            type: "simpleMsg",
            msgText: textF.value,
            date: Date.now(),
            id: personal_id,
        };
  
    connection.send(JSON.stringify(msg));
    textF.value = '';
}

/**
    @description: Questa funzione fa inviare un messaggio quando viene premuto ENTER (13,14)
*/
function handleKey (e) {
    if (e.keyCode === 13 || e.keyCode === 14)
        if (!document.getElementById("sendButton").disabled)
            sendMessage();
}

/**
    @description: Questa funzione effettua la connessione al server NodeJS per
                  permettere al client di entrare a far parte della chat
*/
function connectToServer(userSYT) {
	personal_id = userSYT;

    var serverUrl = "ws://" + window.location.hostname + ":" + serverPort;
    connection = new WebSocket(serverUrl);
    console.log(serverUrl);

    //evento ---> appena viene accettata la connessione dal server
    connection.onopen = function () { 
		 var msg = {
            type: "setUserToServer",
            msgText: userSYT,
            date: Date.now(),
            id: personal_id,
        };
  
    	connection.send(JSON.stringify(msg));
    }

    //evento ---> appena viene ricevuto un messaggio dal server
    connection.onmessage = function (ev) {
        var textView = document.getElementById("chatView");

        var msgFromServer = JSON.parse(ev.data); 
        var time = new Date(msgFromServer.date).toLocaleTimeString();
        var msgContent = '';

        switch (msgFromServer.type) {
            case 'newUserInChat':
                break;
            case 'simpleMsg':
                msgContent = "(" + time + ") <b>" + msgFromServer.userWhoSentTheMsg + "</b>: " + msgFromServer.msgText + "<br>";
                break;
            case 'msgFromUser':
                msgContent = "(" + time + ") <b style='color:darkred'>" + msgFromServer.userWhoSentTheMsg + "</b>: <i style='color: darkred'>" + msgFromServer.msgText + "</i><br>";
                break;
            case 'listOfUsers':
                var user_list = "";
                for (var i = 0; i < msgFromServer.listOfUsers.length; i++) {
                	user_list += "<b style='color: white'>" + msgFromServer.listOfUsers[i] + "</b><br>";
                }
                document.getElementById("userListView").innerHTML = user_list;
                break;
			case 'error':
				msgContent = "<b style='color: darkred'>" + msgFromServer.msgText + "</b><br>";
				break;
            default:
                alert('Errore nel server ! ' +  msgFromServer.type);
                return;
        }       

        //scrivo il messaggio nella text area riservata
        if (msgContent.length) {
            textView.contentDocument.write(msgContent);
            textView.contentWindow.scrollByPages(1);
        } 
    }
}