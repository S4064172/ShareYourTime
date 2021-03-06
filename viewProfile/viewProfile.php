<?php
    if ( session_status() == PHP_SESSION_NONE ) {
        session_start();
	}
	
	if ( !isset($_SESSION['user']) || empty($_SESSION['user']) ) {
       header("Location: ../index/index.php");
	}

    $_SESSION['page'] = "viewprofile";

    require_once('../utils/constant.php');
    require_once('../utils/utils.php');
    require_once('../db/connection.php');

    $conn = connectionToDb();
    $getInfoUserQuery = "SELECT User,Name,Surname,Phone,Email,Street,Photo FROM ShareYourUsersTime WHERE user='".$_SESSION['user']."'";
    if ( !($res = mysqli_query($conn, $getInfoUserQuery)) ) 
        die('Errore nella selezione dei lavori');
    $row = mysqli_fetch_array($res);
    mysqli_free_result($res);
    mysqli_close($conn);
    
?>
<!DOCTYPE html>
<html lang="it">
 	<head>
    	<?php require ('../header/header.html'); ?>
	    <link rel="stylesheet" type="text/css" href="../navBar/navBar.css"/> 
		<link rel="stylesheet" type="text/css" href="../footer/footer.css"/>
        <link rel="stylesheet" type="text/css" href="../menu/menu.css"/>
        <link rel="stylesheet" type="text/css" href="viewProfile.css"/>
        <link rel="stylesheet" type="text/css" href="../contactUs/contactUs.css"/>
        <link rel="stylesheet" type="text/css" href="../modalView/modalView.css"/>
	</head>
	
	<body onclick="myCollapseHide();">
        <?php require_once ('../navBar/navBar.php'); ?>
        <?php require_once('../noscript/noscript.html'); ?>

        <section id="viewProfile" onClick="hideItem('menu');">

            <?php require_once("../menu/menu.php"); ?>
            <?php require_once("../modalView/confirmOperation.php"); ?>
            <div class="myContainer titleSessionTesto">
                <div class="wait" id="waitRegistration">
                    <img class="imgWait" src="../img/sandclock.png" alt="Clessidra">
                </div>
                <div class="row text-center">
                    <div class="col-12">
                        <h1>Impostazioni Profilo</h1>
                    </div>  
                </div>
                               
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card text-center wi400">
                            <img class="card-img-top" id="imgCard" src='<?php echo sanitizeToHtml($row['Photo'])?>' alt="Foto Profilo">
                            <div class="card-body">
                                <h4 class="card-title" id="imgName"><?php echo sanitizeToHtml($row['Name'].' '. $row['Surname']) ?></h4>
                            </div>
                        </div>
                        <div class="fieldHide" id="imgModified">
                            <label>Immagine del profilo</label>&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="file" id="photoModified" onchange="cleanErr('errPhotoModified');checkPhotoUpdate('photoModified','errPhotoModified','<?php echo sanitizeToHtml($row['User']) ?>')" name="photo" accept=".png, .jpg, .jpeg" required>
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
                                    <input onblur="checkUsernameUpdate('userModified','errUserModified','<?php echo $row['User'] ?>')" onfocus="cleanErr('errUserModified')" id="userModified" class="inputType" type="text" value="<?php echo sanitizeToHtml($row['User']) ?>" name="user" minlength=<?php echo UserNameMinLength?> maxlength=<?php echo UserNameMaxLength?> disabled>
                                    <p id="errUserModified"></p> 
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                <label class="labelText"><b>Email</b></label>
                                </div>
                                <div class="col-md-6">
                                    <input onblur="checkEmailUpdate('emailModified','errEmailModified','<?php echo $row['Email'] ?>')" onfocus="cleanErr('errEmailModified')" id="emailModified" class="inputType" type="email" value="<?php echo sanitizeToHtml($row['Email']) ?>" name="email" minlength=<?php echo EmailMinLength?> maxlength=<?php echo EmailMaxLength?> disabled>
                                    <p id="errEmailModified"></p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label class="labelText"><b>Nome</b></label>
                                </div>
                                <div class="col-md-6">
                                    <input onblur="checkName('nameModified','errNameModified')" onfocus="cleanErr('errNameModified')" id="nameModified" class="inputType" type="text" value="<?php echo sanitizeToHtml($row['Name']) ?>" name="name" minlength=<?php echo NameMinLength?> maxlength=<?php echo NameMaxLength?> disabled>
                                    <p id="errNameModified"></p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label class="labelText"><b>Cognome</b></label>
                                </div>
                                <div class="col-md-6">
                                    <input onblur="checkSurname('surnameModified','errSurnameModified')" onfocus="cleanErr('errSurnameModified')" id="surnameModified"  class="inputType" type="text" value="<?php echo sanitizeToHtml($row['Surname']) ?>" name="surname" minlength=<?php echo SurnameMinLength?> maxlength=<?php echo SurnameMaxLength?> disabled> 
                                    <p id="errSurnameModified"></p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label class="labelText" ><b>Indirizzo</b></label>
                                </div>
                                <div class="col-md-6">
                                    <input onfocus="cleanErr('errAddressModified')" id="addressModified" class="inputType" type="text" value="<?php echo sanitizeToHtml($row['Street']) ?>" name="address" minlength=<?php echo StreetMinLength?> maxlength=<?php echo StreetMaxLength?> disabled>
                                    <p id="errAddressModified"></p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label class="labelText"><b>Telefono</b></label>
                                </div>
                                <div class="col-md-6">
                                    <input onblur="checkPhoneUpdate('phoneModified','errPhoneModified','<?php echo $row['Phone'] ?>')" onfocus="cleanErr('errPhoneModified')" id="phoneModified" class="inputType" type="tel" value="<?php echo sanitizeToHtml($row['Phone']) ?>" name="phone" minlength=<?php echo PhoneLength?> maxlength=<?php echo PhoneLength?> disabled>
                                    <p id="errPhoneModified"></p>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="labelText fieldHide" id="pswLabel"><b>Password</b></label>
                                </div>
                                <div class="col-md-6">
                                    <input onblur="checkPswUpdate('pswModified','errPswModified')" onfocus="cleanErr('errPswModified')" id="pswModified" class="inputTypePsw" type="password" name="psw" minlength="<?php echo PasswordMinLength?>" disabled>
                                    <p id="errPswModified"></p>
                                </div>
                            </div>

                             <div class="row">
                                <div class="col-md-6">
                                    <label class="labelText fieldHide" id="pswConfLabel"><b>Conferma password</b></label>
                                </div>
                                <div class="col-md-6">
                                    <input onblur="checkConfPswUpdate('pswConfModified','errPswConfModified','pswModified')" onfocus="cleanErr('errPswModified')" id="pswConfModified" class="inputTypePsw" type="password" name="psw" minlength="<?php echo PasswordMinLength?>" disabled>
                                    <p id="errPswConfModified"></p>
                                </div>
                            </div>


                            <div class="row">
                                <div class="offset-md-3  col-md-3">
                                    <button class="btn btn-primary" id="bntModify" onClick="enableChanges();">Modifica profilo</button>
                                    <button class="btn btn-primary fieldHide" id="bntSave" onClick="checkModifiedAllField('waitRegistration','<?php echo $row['User'] ?>','<?php echo $row['Email'] ?>','<?php echo $row['Phone'] ?>');">Salva modifiche</button>
                                    
                                </div>
                                <div class="col-md-3">
                                    <button  class="btn btn-danger" id="bntDelete" onclick="addEvent();" data-toggle="modal" data-target="#confirmDelete">Elimina profilo</button>
                                </div>
                                <div class="col-md-3">
                                    <a href="../homepage/homepage.php" class="btn btn-success" id="bntExit">Torna alla homepage</a>
                                </div>
                            </div>

                        </div>
                    </div> 
                </div>
            </div>
        </section>

        <?php require ('../footer/footer.php'); ?>

        <!-- BOOTSTRAP -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    
        
        <script src="../js/constant.js"></script>
        <script src="../js/utils.js"></script>
        <script src="../js/navBar.js"></script>
        <script src="../js/checkProfileUserField.js"></script>
        <script src="../js/viewProfile.js"></script>
        
        
	    
        <?php require_once('googleAPIkey.html'); ?>
	</body>
</html>
