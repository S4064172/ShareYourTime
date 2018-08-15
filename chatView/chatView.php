<?php
	require_once("../utils/utils.php");
 	if ( !check_COOKIE_IsSetAndNotEmpty('sizeC') ) {
		$cookie_name = "sizeC";
		$cookie_value = "3";
		setcookie($cookie_name, $cookie_value, time() + (600*30), "/");
	}

   if ( session_status() == PHP_SESSION_NONE ) {
        session_start();
	}
	
	if ( !isset($_SESSION['user']) || empty($_SESSION['user']) ) {
        header("Location: ../index/index.php");
	}

	$_SESSION['page'] = "chatView";
?>
<!DOCTYPE html>
<html>
 	<head>
		<?php require ('../header/header.html'); ?>
	    <link rel="stylesheet" type="text/css" href="../navBar/navBar.css"/> 
		<link rel="stylesheet" type="text/css" href="../footer/footer.css"/>
		<link rel="stylesheet" type="text/css" href="chatView.css"/>

	</head>
	
	<body onload="connectToServer('<?php echo $_SESSION['user']?>')">
		<?php require('../noscript/noscript.html'); ?>
		<?php require_once ('../navBar/navBar.php'); ?>
    
		<section class="navbar navbar-expand-md viewChat">
			<button class="navbar-toggler text-center" id="bntUserChat" type="button" data-toggle="collapse" data-target=".UserInChat" aria-controls="UserInChat" aria-expanded="false" aria-label="Toggle navigation">
        	<span>
                	User
        	</span>
    	</button>
			
			<div class="myContainer">
				<div class="row">		
					<div class="col-md-2 collapse navbar-collapse" id="userListView">
					</div>

					<iframe class="col-md-10" id="chatView"></iframe>
				</div>

				<div class="row">
					<div class="offset-md-2 col-md-8" id="textSendChat">
			            <input id="msgChat" class="offset-md-1" type="text" name="msgChat" size="80" maxlength="256" placeholder="Scrivi qui il tuo messaggio" autocomplete="off" onkeyup="handleKey(event)">
					</div>
					<div class="col-md-2" id="bntSendMsg">
            			<input class="offset-md-4" type="button" id="sendButton" name="sendButton" value="Invia" onclick="sendMessage()">
					</div>
				</div>
			</div>
		</section>
			
		
		<?php require ('../footer/footer.php'); ?>
		

		<!-- BOOTSTRAP -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

		<script type="text/javascript" src="../js/chatWebSocket.js"></script>
	
    </body>
</html>
