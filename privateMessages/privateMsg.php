<?php
    if ( session_status() == PHP_SESSION_NONE ) {
        session_start();
	}
	
	if ( !isset($_SESSION['user']) || empty($_SESSION['user']) ) {
       header("Location: ../index/index.php");
	}

    $_SESSION['page'] = "privateMsg";

	require_once('../utils/utils.php');
	require_once('../utils/constant.php');
	require_once('../db/connection.php');

	function showOldChat($conn) 
	{
		$arr = checkNewMsg($_SESSION['user']);

		$prevChatsQuery = "SELECT DISTINCT Sender FROM ShareYourPvtMsgTime WHERE Receiver='".$_SESSION['user'].
						  "' UNION ".
						  "SELECT DISTINCT Receiver FROM ShareYourPvtMsgTime WHERE Sender='".$_SESSION['user']."'";

	 	if ( !($res = mysqli_query($conn, $prevChatsQuery)) ) 
    		die('Errore nella selezione della chat'.mysqli_error($conn));

		$rows = mysqli_num_rows($res);

		if ( $rows === 0 ) {
			echo '<b id="noChat">Nessuna chat disponibile</b><br>';
		} else {
			for ($i = 0; $i < $rows && ($row = mysqli_fetch_array($res)); $i++) 
					echo '<button onclick="openOldChat(\''.sanitizeToHtml($row['Sender']).'\');" class="prevChatBtn" type="submit">'.
							'<span class="namesInChat">'.sanitizeToHtml($row['Sender']).'</span>&nbsp;&nbsp;'.
							'<i id="chat_'.sanitizeToHtml($row['Sender']).'" class="fas fa-envelope'.(usrInArr($row['Sender'], $arr) ? ' redEnv' : '').'"></i>'.
						 '</button>';
			
			mysqli_free_result($res);
		}
	}

	function populateSelect($conn) 
	{
		$usersQuery = "SELECT User From ShareYourUsersTime WHERE User <> '".$_SESSION['user']."';";

	 	if ( !($res = mysqli_query($conn, $usersQuery)) ) 
	        die('Errore nella selezione dei lavori');

	    $rows = mysqli_num_rows($res);
		
		for ($i = 0; $i < $rows && ($row = mysqli_fetch_array($res)); $i++)
			echo '<option value="'.sanitizeToHtml($row['User']).'">'.sanitizeToHtml($row['User']).'</option>';
					
		mysqli_free_result($res);
	}

	$conn = connectionToDb();
?>

<html>
 	<head>
    	<?php require ('../header/header.html'); ?>
	    <link rel="stylesheet" type="text/css" href="../navBar/navBar.css"/> 
		<link rel="stylesheet" type="text/css" href="../footer/footer.css"/>
		<link rel="stylesheet" type="text/css" href="../menu/menu.css"/>
		<link rel="stylesheet" type="text/css" href="privateMsg.css"/>
	    <!--link rel="stylesheet" type="text/css" href="../homepage/homepage.css"/--> 
    </head>
	
	<body onclick="myCollapseHide();">
        <?php require_once ('../navBar/navBar.php'); ?>
        <?php require_once('../noscript/noscript.html'); ?>

        <section id="viewMessages" onClick="hideItem('menu');">
			<?php require_once("../menu/menu.php"); ?>
			<div class="row">
				<select id="selectContact" class="offset-md-4 col-md-4 selector" onchange="cleanErr('errMsg'); openChat();">
					<option selected disabled>Seleziona un contatto</option>
					<?php
						populateSelect($conn);
					?>
				</select>
			</div>
			<br>	
			<div class="row">
				<div id="prevChat" class="col-md-2 chatSection text-center" onfocusin="cleanErr('errMsg')" onload="openChat()">
					<h3>Contatti</h3>
					<?php
						showOldChat($conn);
						mysqli_close($conn);
					?>
				</div>

				<div class="col-md-4">
					<div class="row">
						<div class="col-md-6">
							<b>Contatto &nbsp;</b>
						</div>
						<div class="col-md-6">
							<input type="text" class="text-center w100" id="msgTo" disabled>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<b>Oggetto &nbsp;</b>
						</div>
						<div class="col-md-6">
							<input class="w100" type="text" id="obj" maxlength="<?php echo ObjMaxLength;?>" disabled>
						</div>
					</div>
					<div class="row">
					<textarea cols="60" rows="10"id="textMsg" maxlength="<?php echo MsgMaxLength;?>" disabled></textarea>
					</div>
					<br>
					<div class="row">
						<button id="sendPvt" class="col-md-4 offset-md-4" onclick="sendPvtMessage()" disabled>Invia</button>
					</div>
					<p id="errMsg"></p>
				</div>

				<div id="currChat" class="col-md-6 chatSection">
					<!-- mostra chat corrente -->
				</div>
			</div>
		</section>

        <?php require ('../footer/footer.php'); ?>

        <!-- BOOTSTRAP -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    
        
        <script type="text/javascript" src="../js/utils.js"></script>
	    <script type="text/javascript" src="../js/navBar.js"></script>
		<script type="text/javascript" src="../js/viewProfile.js"></script>
		<script type="text/javascript" src="../js/pvtMsg.js"></script>
        
	</body>
</html>
