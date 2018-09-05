<?php
	require_once("../utils/utils.php");

    if ( session_status() == PHP_SESSION_NONE ) {
        session_start();
	}
	
	if ( !isset($_SESSION['user']) || empty($_SESSION['user']) ) {
        header("Location: ../index/index.php");
	}

	$_SESSION['page'] = "chatview";
?>
<!DOCTYPE html>
<html lang="it">
 	<head>
		<?php require ('../header/header.html'); ?>
	    <link rel="stylesheet" type="text/css" href="../navBar/navBar.css"/> 
		<link rel="stylesheet" type="text/css" href="../footer/footer.css"/>
		<link rel="stylesheet" type="text/css" href="../menu/menu.css"/>
		<link rel="stylesheet" type="text/css" href="chatView.css"/>

	</head>
	
	<body onload="connectToServer('<?php echo $_SESSION['user']?>')" onclick="myCollapseHide()">
		<?php require('../noscript/noscript.html'); ?>
		<?php require_once('../navBar/navBar.php'); ?>
		<?php require_once('../menu/menu.php'); ?>
    
		<section class="navbar navbar-expand-md viewChat" onClick="hideItem('menu');">
			
			<div class="myContainer">
				<div class="row text-center">
					<h2 id="infoComando">Se vuoi scrivere un messaggio privato scrivi @<i>NomeUtente</i> e poi il tuo messaggio</h2>
				</div>

				<button class="navbar-toggler text-center" id="bntUserChat" type="button" data-toggle="collapse" data-target="#userListView" aria-controls="userListView" aria-expanded="false" aria-label="Toggle navigation">
        			<span style="color: black;">
                		Users
        			</span>
		   		</button>
	
				<div class="row">		
					<div class="col-md-2 collapse navbar-collapse" id="userListView"></div>

					<iframe class="col-md-10" id="chatView"></iframe>
				</div>
				<br>
				<div class="row">
					<div class="offset-md-2 col-md-8" id="textSendChat">
			            <input id="msgChat" class="offset-md-1 col-md-10" type="text" name="msgChat" maxlength="256" placeholder="Scrivi qui il tuo messaggio" autocomplete="off" onkeyup="handleKey(event)">
					</div>
					<div class="col-md-2" id="bntSendMsg">
            			<input type="button" id="sendButton" name="sendButton" value="Invia" onclick="sendMessage()">
					</div>
				</div>
			</div>
		</section>
			
		
		<?php require ('../footer/footer.php'); ?>
		

		<!-- BOOTSTRAP -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

		<script src="../js/chatWebSocket.js"></script>
		
		<script src="../js/utils.js"></script>
		<script src="../js/navBar.js"></script>
	
    </body>
</html>
