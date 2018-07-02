<!DOCTYPE html>
<html>
 	<head>
    	<?php
	      require ('header/header.html');
	    ?>
    	<link rel="stylesheet" type="text/css" href="index.css"/>
	    <link rel="stylesheet" type="text/css" href="navBar/navBar.css"/> 
		<link rel="stylesheet" type="text/css" href="footer/footer.css"/>
	  </head>
	
	<body>
    <?php
        require ('navBar/navBar.php');
	?>

	
	<section id="homeView">
		<div class="container">
    		<div class="row">
	        <!--
    	    	 descrizine generale sito
        	-->
				<div class="col-md-6 offset-md-6 offset-md-4 offset-md-2 mt-5" >
					<div class="container">
						<div class="jumbotron infoJumbo">
							<h1><b>Share Your Time</b></h1>
							<br>
							<p>
								Hai un minuto da dedicare agli altri ? <br>
								Hai esperienza in un particolare settore ? <br>
								Cerchi di mettere qualche soldo da parte ? <br>
								Sei la persona giusta per noi !
							</p>
						</div>
					<div>
				</div> 
			</div>
		</div>  


		<div class="container">
    		<div class="row">
	        <!--
    	    	 ultimi lavori caricati
        	-->
				<div class="col-md-6 offset-md-6 offset-md-4 offset-md-2 mt-5" >
					<?php
						require('last5.html');
					?>
				</div>
			</div>
		<div-->

      <!--
          -> Login a scomparsa
      -->	
	<div class="modal myModal myModal-mt fade" id="loginModalTarget" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    	<div class="modal-dialog" role="document">
        	<div class="modal-content animate">
            	<form  action="login.php" method="POST">
	            	<div class="imgcontainer">
    					<button type="button"  class="close myClose" data-dismiss="modal" aria-label="Close">
		            		<span aria-hidden="true">&times;</span>
		              	</button>
			            <img src="img/avatar.png" alt="Avatar" class="avatar">
					</div> 
					<div class="myContainer-padding">
	            		<label for="usernameLogin" class="text-c"><b>Username</b></label>
			            	<input type="text" placeholder="Enter Username" name="usernameLogin" minlength="5" maxlength="125" required>
	    	    	    <label for="pswLogin" class="text-c"><b>Password</b></label>
    	    	    		<input type="password" placeholder="Enter Password" name="pswLogin" minlength="8" maxlength="125" required>
	    	    	    <button type="submit" class="btn btn-success mybutton mt-4">Login</button>
					</div>	
				</form>
			</div>
		</div>
	</div>    

      <!--
            -> Sign-up a scomparsa
      -->	

    <div class="modal myModal fade" id="signUpModalTarget" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  		<div class="modal-dialog" role="document">
		   	<div class="modal-content animate">
    			<form  action="register.php" method="POST">
					<div class="imgcontainer">
						<button type="button" class="close myClose" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<label class="signupText">Benvenuto !</label>&nbsp;
						<img src="img/Time1.png" alt="Avatar" class="avatar">
					</div>
					<div class="container myContainer-padding">
						<div class="row">
							<div class="col-md-6">
								<label for="usernameReg"><b>Username</b></label>
									<input type="text" placeholder="Inserisci un username" name="usernameReg" minlength="5" maxlength="125" required>
								<label for="pswReg"><b>Password</b></label>
									<input type="password" placeholder="Inserisci una password" name="pswReg" minlength="8" maxlength="125" required>
								<label for="confPswReg"><b>Conferma Password</b></label>
									<input type="password" placeholder="Conferma la password" name="confPswReg" minlength="8" maxlength="125" required>
								<label for="address"><b>Indirizzo</b></label>
									<input type="text" placeholder="Inserisci il tuo indirizzo" name="address" minlength="3" maxlength="125" required>
							</div>
							<div class="col-md-6">
								<label for="nameReg" class="text-r"><b>Nome</b></label>
									<input type="text" placeholder="Inserisci il tuo nome" name="nameReg" maxlength="125" required>
								<label for="surnameReg" class="text-r"><b>Cognome</b></label>
									<input type="text" placeholder="Inserisci il tuo cognome" name="surnameReg" maxlength="125" required>
								<label for="emailReg" class="text-r"><b>Email</b></label>
									<input type="email" placeholder="Inserisci il tuo indirizzo email" name="emailReg" maxlength="125" required>
								<label for="telephone" class="text-r"><b>Telefono</b></label>
									<input type="tel" placeholder="Inserisci un numero di telefono" name="telephone" minlength="10" maxlength="10" required>
							</div>
						</div>
						<label for="profilePhoto">Immagine del profilo</label>&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="file" name="profilePhoto">
						<button type="submit" class="btn btn-success mybutton mt-4">Registrati</button>
					</div>
				</form>
		    </div>
		</div>
	</div>
	</section>

     <?php
        require('footer/footer.php');
     ?>

    <!--script type="text/javascript" src="index.js"></script-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
  </body>
</html>
