<!DOCTYPE html>
<html>
  <head>
    <?php
      require ('header/header.html');
    ?>
    <link rel="stylesheet" type="text/css" href="index.css"/>
    <link rel="stylesheet" type="text/css" href="navBar/navBar.css"/>
  </head>

	<body class="h">
    <?php
        require ('navBar/navBar.php');
     ?>
        
    <section  id="homeView" >
      <div class="container">
        <div class="row">
          <!--
              -> descrizine generale sito
          -->
          <div class="col-md-6 offset-lg-6 offset-md-4 offset-sm-2" id="aboutUs">
              
          </div>

          <!--
              -> Login a scomparsa
          -->		
          <div id="loginModal" class="modal">
            <span onclick="noneById('loginModal'); enableButtonById('signupB');" class="close" title="Close Modal">&times;</span>
            <form class="modal-content animate mb-0" action="login.php" method="POST">
              <div class="imgcontainer">
                <span onclick="noneById('loginModal'); enableButtonById('signupB');" class="close" title="Close Modal">&times;</span>
                <img src="img/avatar.png" alt="Avatar" class="avatar">
              </div>

              <div class="myContainer">
                <label for="usernameLogin"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="usernameLogin" minlength="5" maxlength="125" required>
        
                <label for="pswLogin"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="pswLogin" minlength="8" maxlength="125" required>
                
                <button type="submit" class="btn btn-success mybutton mt-4">Login</button>
              </div>
            </form>
		    </div>
      </div>  
      
      <!--
            -> Sign in a scomparsa
      -->	
      <div id="signupModal" class="modal">
        <span onclick="noneById('signupModal'); enableButtonById('loginB');" class="close" title="Close Modal">&times;</span>
        <form class="modal-content animate w-50 mb-0" action="register.php" method="POST">
          <div class="imgcontainer">
            <span onclick="noneById('signupModal'); enableButtonById('loginB');" class="close" title="Close Modal">&times;</span>
            <img src="img/avatar.png" alt="Avatar" class="avatar">
          </div>
          <div class="container myContainer">
            <div class="row">
              <div class="col-md-6">
                  <label for="usernameReg"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="usernameReg" minlength="5" maxlength="125" required>

                <label for="pswReg"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="pswReg" minlength="8" maxlength="125" required>
            
                <label for="confPswReg"><b>Confirm Password</b></label>
                <input type="password" placeholder="Confirm Password" name="confPswReg" minlength="8" maxlength="125" required>
              </div>
              <div class="col-md-6">
                <label for="nameReg" class="text-r"><b>Name</b></label>
                <input type="text" placeholder="Enter Name" name="nameReg" maxlength="125" required>
            
                <label for="surnameReg" class="text-r"><b>Surname</b></label>
                  <input type="text" placeholder="Enter Surname" name="surnameReg" maxlength="125" required>
                
                <label for="emailReg" class="text-r"><b>Email</b></label>
                  <input type="email" placeholder="Enter Email" name="emailReg" maxlength="125" required>
              </div>
            </div>
            <button type="submit" class="btn btn-success mybutton mt-4">Register</button>
          </div>
        </form>
		  </div>



    </section>

     <?php
        require ('footer/footer.php');
     ?>

    <script type="text/javascript" src="index.js"></script>
<!---->
	  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>	
	</body>
</html>
