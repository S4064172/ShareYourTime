<?php
     if (session_status() == PHP_SESSION_NONE) {
        session_start();
	}
	
	if ( !isset($_SESSION['user']) || empty($_SESSION['user']) ) {
       header("Location: ../index/index.php");
	}

    $_SESSION['page']="viewprofile";

    require_once('../utils/dataBaseConstant.php');
    require_once('../utils/checkFields.php');
    require_once('../db/connection.php');

    $conn = connectionToDb();
    $getInfoUserQuery = "SELECT User,Name,Surname,Phone,Email,Street,Photo FROM ShareYourUsersTime where user='".$_SESSION['user']."'";
    if ( !($res = mysqli_query($conn, $getInfoUserQuery)) ) 
                die('Errore nella selezione dei lavori');
    $row = mysqli_fetch_array($res);
    mysqli_free_result($res);
    mysqli_close($conn);
    
?>


<html>
 	<head>
    	<?php require ('../header/header.html'); ?>
	    <link rel="stylesheet" type="text/css" href="../navBar/navBar.css"/> 
		<link rel="stylesheet" type="text/css" href="../footer/footer.css"/>
        <link rel="stylesheet" type="text/css" href="../menu/menu.css"/>
        <link rel="stylesheet" type="text/css" href="viewProfile.css"/>
        <link rel="stylesheet" type="text/css" href="../contactUs/contactUs.css"/>

	</head>
	
	<body>

        <?php require ('../navBar/navBar.php'); ?>

        <section id="viewProfile" onClick="hideItem('menu');">

            <?php require_once("../menu/menu.php"); ?>

            <div class="titleSessionTesto">
                <div class="wait" id="waitRegistration">
                    <img class="imgWait" src="img/sandclock.png">
                </div>
                <div class="row text-center">
                    <div class="col-12">
                        <h1>Impostazioni Profilo</h1>
                    </div>  
                </div>
                
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card text-center" style="width:400px">
                            <img class="card-img-top" id="imgCard" src='<?php echo sanitizeToHtml($row['Photo'])?>' alt="Foto Profilo">
                            <div class="card-body">
                                <h4 class="card-title" id="imgName"><?php echo sanitizeToHtml($row['Name'].' '. $row['Surname']) ?></h4>
                            </div>
                        </div>
                        <div class="fieldHide" id="imgModified">
                            <label>Immagine del profilo</label>&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="file" id="photoModified" onchange="checkGenericSingleField('photoModified','errPhotoModified',1,'<?php echo sanitizeToHtml($row['User']) ?>')" name="photo" accept=".png, .jpg, .jpeg" required>
                            <p id="errPhotoModified"></p>
                        </div>
                    </div>  
                    <div class="col-lg-8">
                        <div class="myContainer">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="labelText"><b>Username</b></label>
                                </div>
                                <div class="col-md-6">
                                    <input onfocusout="checkGenericSingleField('userModified','errUserModified',1,'<?php echo $row['User'] ?>')" onfocusin="cleanErr('errUserModified')" id="userModified" type="text" value="<?php echo sanitizeToHtml($row['User']) ?>" name="user" minlength=<?php echo UserNameMinLength?> maxlength=<?php echo UserNameMaxLength?> readonly>
                                    <p id="errUserModified"></p> 
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                <label class="labelText"><b>Email</b></label>
                                </div>
                                <div class="col-md-6">
                                    <input onfocusout="checkGenericSingleField('emailModified','errEmailModified',1,'<?php echo $row['Email'] ?>')" onfocusin="cleanErr('errEmailModified')" id="emailModified" type="email" value="<?php echo sanitizeToHtml($row['Email']) ?>" name="email" minlength=<?php echo EmailMinLength?> maxlength=<?php echo EmailMaxLength?> readonly>
                                    <p id="errEmailModified"></p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label class="labelText fieldHide" id="pswLabel"><b>Password</b></label>
                                </div>
                                <div class="col-md-6">
                                    <input onfocusout="checkGenericSingleField('pswModified','errPswModified',1)" onfocusin="cleanErr('errPswModified')" id="pswModified" type="password" name="psw" minlength="<?php echo PasswordMinLength?>" readonly>
                                    <p id="errPswModified"></p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label class="labelText"><b>Nome</b></label>
                                </div>
                                <div class="col-md-6">
                                    <input onfocusout="checkGenericSingleField('nameModified','errNameModified',1)" onfocusin="cleanErr('errNameModified')" id="nameModified" type="text" value="<?php echo sanitizeToHtml($row['Name']) ?>" name="name" minlength=<?php echo NameMinLength?> maxlength=<?php echo NameMaxLength?> readonly>
                                    <p id="errNameModified"></p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label class="labelText"><b>Cognome</b></label>
                                </div>
                                <div class="col-md-6">
                                    <input onfocusout="checkGenericSingleField('surnameModified','errSurnameModified',1)" onfocusin="cleanErr('errSurnameModified')" id="surnameModified" type="text" value="<?php echo sanitizeToHtml($row['Surname']) ?>" name="surname" minlength=<?php echo SurnameMinLength?> maxlength=<?php echo SurnameMaxLength?> readonly> 
                                    <p id="errSurnameModified"></p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label class="labelText" ><b>Indirizzo</b></label>
                                </div>
                                <div class="col-md-6">
                                    <input onfocusout="checkGenericSingleField('addressModified','errAddressModified',1)" onfocusin="cleanErr('errAddressModified')" id="addressModified" type="text" value="<?php echo sanitizeToHtml($row['Street']) ?>" name="address" minlength=<?php echo StreetMinLength?> maxlength=<?php echo StreetMaxLength?> readonly>
                                    <p id="errAddressModified"></p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label class="labelText"><b>Telefono</b></label>
                                </div>
                                <div class="col-md-6">
                                    <input onfocusout="checkGenericSingleField('phoneModified','errPhoneModified',1,'<?php echo $row['Phone'] ?>')" onfocusin="cleanErr('errPhoneModified')" id="phoneModified" type="tel" value="<?php echo sanitizeToHtml($row['Phone']) ?>" name="phone" minlength=<?php echo PhoneLength?> maxlength=<?php echo PhoneLength?> readonly>
                                    <p id="errPhoneModified"></p>
                                </div>
                            </div>

                            <div class="row text-center">
                                <div class="col-md-6">
                                    <button class="btn btn-primary mb-2 mb-sm-0" id="bntModify" onClick="enableChanges();">Modifica</button>
                                    <button class="btn btn-primary fieldHide mb-2 mb-sm-0" id="bntSave" onClick="checkModifiedAllField('waitRegistration','<?php echo $row['User'] ?>','<?php echo $row['Email'] ?>','<?php echo $row['Phone'] ?>');">Salva</button>
                                    
                                </div>
                                <div class="col-md-6">
                                <a href="../homepage/homepage.php"><button class="btn btn-success" onClick="disableChanges();" id="bntExit">Esci</button></a>
                                </div>
                            </div>

                        </div>
                    </div> 
                </div>
            </div>
        </section>

        <?php require ('../contactUs/contactUs.php'); ?>

        <?php require ('../footer/footer.php'); ?>

        <!-- BOOTSTRAP -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    
        
        
        <script type="text/javascript" src="../js/utils.js"></script>
	    <script type="text/javascript" src="../js/navBar.js"></script>
	    <script type="text/javascript" src="../js/viewProfile.js"></script>
	    <script type="text/javascript" src="../js/ajaxCheckModifiedAllField.js"></script>
           
	</body>
</html>