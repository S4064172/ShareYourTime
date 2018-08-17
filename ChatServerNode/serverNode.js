"use strict";

//moduli websocket
var http = require('http');
var WebSocketServer = require('websocket').server;

//valori utili al server
const serverPort = 4444;
var connectedUsers = [];
var temp_nextClientId = '@@';//Date.now();  //token randomico


/* --- START FUNCTIONS --- */

function logMsg(msg) {
    console.log((new Date()) + ' ' + msg);
}

/*
    @description: Questa funzione controlla la provenienza delle connessioni
*/
function originIsAllowed(origin) {
    return true;
}

/*
    @description: Questa funzione restituisce un socket a partire da un client
*/
function getClientSocketById(id) {
    for (var i = 0; i < connectedUsers.length; i++)   
        if (connectedUsers[i].clientId === id)
            return connectedUsers[i];
    return null;
}

/*
    @description: Questa funzione prepara il messaggio della lista utenti
*/
function prepareUserlistMessage() {
    var msg = {
        type: "listOfUsers",
        listOfUsers: []
    };

    for (var i = 0; i < connectedUsers.length; i++)
        msg.listOfUsers.push(connectedUsers[i].clientId);

    return msg;
}

/*
    @description: Questa funzione comunica la lista degli utenti connessi
*/
function pollingUserlist() {
    var userlistMessageJson = JSON.stringify(prepareUserlistMessage());

    for (var i = 0; i < connectedUsers.length; i++)
        connectedUsers[i].sendUTF(userlistMessageJson);
}

/* --- END FUNCTIONS --- */


var chatServer = http.createServer(
    function (request, response) {
        logMsg('Ricevuta richiesta da ' + request.url);
        response.writeHead(404);
        response.end();
    }
);

chatServer.listen(
    serverPort,
    function () {
        logMsg('Il server si e\' messo in ascolto sulla porta ' + serverPort);
    }
);

var serverWS_chat = new WebSocketServer(
    {
        httpServer: chatServer,
        autoAcceptConnections: false
    }
);

serverWS_chat.on(
    'request',
    function(request) {
        //controllo la connessione
        if (!originIsAllowed(request.origin)) {
            request.reject();
            console.log((new Date()) + "Rifutata connessione da " + connection.origin);
            return;
        }    
        
        //accetto la connessione
        var conn = request.accept(null, request.origin);
        logMsg('Connessione accettata da ' + request.origin);
        connectedUsers.push(conn);

        //creo un id univoco ai fini della chat e lo comunico al client
        conn.clientId = temp_nextClientId;
        //nextClientId++;
        
        //gestione messaggi ricevuti dal client
        conn.on(
            "message",
            function (clientMsg) {
                var broadcast = true;
                if (clientMsg.type === "utf8") {
                    console.log("Ricevuto questo messaggio: " + clientMsg.utf8Data);

                    var msgReceivedFromClient = JSON.parse(clientMsg.utf8Data);
                    var clientConn = getClientSocketById(msgReceivedFromClient.id);

                    var newMsg = { id: conn.clientId };
                    switch(msgReceivedFromClient.type) {
						case 'setUserToServer':
							conn.clientId = msgReceivedFromClient.msgText;
							console.log('Nuovo utente ---> ' + conn.clientId);
							broadcast = false;
        					pollingUserlist();
							break;


                        case 'simpleMsg':
                            newMsg.type = 'simpleMsg';
                            newMsg.date = new Date();
                            newMsg.userWhoSentTheMsg = clientConn.clientId;
                            newMsg.msgText = msgReceivedFromClient.msgText.replace(/(<([^>]+)>)/ig,"");
                            break;


                        case 'msgToSpecificUser':
                            newMsg.type = 'msgFromUser';
                            newMsg.date = new Date();
                            newMsg.userWhoSentTheMsg = clientConn.clientId;
                            newMsg.msgText = msgReceivedFromClient.msgText.replace(/(<([^>]+)>)/ig,"");
							var toSock = getClientSocketById(msgReceivedFromClient.userTo);
						
							if (toSock == null) {
								newMsg.msgText = 'L\'utente che vuoi contattare non esiste o non &egrave; online';
								newMsg.type = 'error';
								clientConn.sendUTF(JSON.stringify(newMsg));
								return;
							}

                            for (var j = 0; j < connectedUsers.length; j++) {
                                if (connectedUsers[j].clientId == msgReceivedFromClient.userTo || connectedUsers[j].clientId == msgReceivedFromClient.id) {
                                    connectedUsers[j].sendUTF(JSON.stringify(newMsg));
                                    broadcast = false;
                                    //break;        
                                }
                            }


                            break;
                    }

                    //mando in broadcast il messaggio
                    if (broadcast) {
                        var msgToUsers = JSON.stringify(newMsg);
                        for (var i = 0; i < connectedUsers.length; i++)
                            connectedUsers[i].sendUTF(msgToUsers);
                    }

                    broadcast = true;
                }
            }
        );

        conn.on(
            'close', 
            function(connection) {
                connectedUsers = connectedUsers.filter(
                    function(el, idx, ar) {
                        return el.connected;
                    }
                );
                pollingUserlist();  //aggiorna la lista degli utenti
                console.log((new Date()) + " Peer " + connection.remoteAddress + " disconnected.");
            }
        );
    }
);


































/*var http = require("http");
var url = require("url");
var fs = require("fs");

var WebSocketServer  = require("websocket").server;

var connectedUsers = [];
var nextClientId = Date.now();
var tokenForUniqueUsernames = 1;

var server = http.createServer(
    function(request, response) {
    console.log((new Date()) + " Ricevuta richiesta da " + request.url);
    response.writeHead(404);
    response.end();
    }
);

server.listen(
    4444,
    function() {
        console.log((new Date()) + " Il server sta ascoltando sulla porta 4444");
    }
);

var wsServer = new WebSocketServer({
    httpServer: server,
    autoAcceptConnection: true //dovrebbe essere falso per sicurezza
});

function checkUsernameUnique(newUser) {
    for (var i = 0; i < connectedUsers.length; i++)
        if (connectedUsers[i].username === newUser)
            return false;
    return true;
}

function getClientSocketById(id) {
    for (var i = 0; i < connectedUsers.length; i++)   
        if (connectedUsers[i].clientId === id)
            return connectedUsers[i];
    return null;
}

function prepareUserlistMessage() {
    var msg = {
        type: "listOfUsers",
        listOfUsers: []
    };

    for (var i = 0; i < connectedUsers.length; i++)
        msg.listOfUsers.push(connectedUsers[i].username);

    return msg;
}

function pollingUserlist() {
    var userlistMessageJson = JSON.strigify(prepareUserlistMessage());

    for (var i = 0; i < connectedUsers.length; i++)
        connectedUsers[i].sendUTF(userlistMessageJson);
}

wsServer.on(
    "connect",
    function (conn) {
        console.log((new Date()) + " Connessione accettata");
        connectedUsers.push(conn);

        conn.clientId = nextClientId;
        nextClientId++;
        
        var msg = {
            type: "id",
            id: connection.clientId        
        };

        conn.sendUTF(JSON.stringify(msg));

        conn.on(
            "message",
            function (clientMsg) {
                if (clientMsg.type === "utf8") {
                    console.log(clientMsg.utf8Data);

                    //var sendToClients = true;
                    msg = JSON.parse(clientMsg.utf8Data);
                    var clientConn = getClientSocketById(msg.id);

                    //sostituire username con newUser
                    switch(msg.type) {
                        case "simpleMsg":
                            msg.userWhoSentTheMsg = clientConn.username;
                            msg.msgText = msg.msgText.replace(/(<([^>]+)>)/ig,"");
                            break;
                        case "newUser":
                            //var nameChanged = false;
                            var originalName = msg.msgText;

                            //  -- CONTROLLI PER UNICITA' DEL NOME NELLA CHAT MA NOI ABBIAMO USERNAME UNIVOCI !!!
//                            while(!checkUsernameUnique(msg.msgText)) {
//                                msg.userWhoSentTheMsg = origName + appendToMakeUnique;
//                                tokenForUniqueUsernames++;
//                                nameChanged = true;
//                            }
//
//                            if (nameChanged) {
//                                var changeUsernameMsg = {
//                                    id: msg.id,
//                                    type: "rejectusername",
//                                    name: msg.name
//                                };
//                                connect.sendUTF(JSON.stringify(changeMsg));
//                            }

                            clientConn.username = msg.msgText;
                            pollingUserlist();
                            break;
                    }

                    var msgToUsers = JSON.stringify(msg);
                    for (var i = 0; i < connectedUsers.length; i++)
                        connectedUsers[i].sendUTF(msgToUsers);
                }
            }
        );

        conn.on(
           "close",
            function (conn) {
                connectedUsers = connectedUsers.filter(function(el, idx, ar) {return el.connected});
                pollingUserlist();
                console.log((new Date()) + " L'utente " + conn.remoteAddress + " si e' disconnesso");
       });
    }
);


*/
