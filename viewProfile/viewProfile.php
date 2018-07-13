<?php
    require_once('utils/dataBaseConstant.php');
    require_once('db/connection.php');

    $conn = connectionToDb();
    $getInfoUserQuery = "SELECT User,Name,Surname,Phone,Email,Street,Photo FROM ShareYourUsersTime where user='".$_SESSION['user']."'";
    if ( !($res = mysqli_query($conn, $getInfoUserQuery)) ) 
                die('Errore nella selezione dei lavori');
    $row = mysqli_fetch_array($res);
    mysqli_free_result($res);
    mysqli_close($conn);
    
?>

<div class="myContainerPageToView">
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
                <img class="card-img-top" id="imgCard" src='<?php echo $row['Photo']?>' alt="Foto Profilo">
                <div class="card-body">
                    <h4 class="card-title" id="imgName"><?php echo ($row['Name'].' '. $row['Surname']) ?></h4>
                </div>
            </div>
            <div class="fieldHide" id="imgModified">
                <label>Immagine del profilo</label>&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="file" id="photoModified" onchange="checkGenericSingleField('photoModified','errPhotoModified',1,'<?php echo $row['User'] ?>')" name="photo" accept=".png, .jpg, .jpeg" required>
                <p id="errPhotoModified"></p>
            </div>
        </div>  
        <div class="col-lg-8">
            <div class="MyContainer">
                <div class="row">
                    <div class="col-md-6">
                        <label class="labelText"><b>Username</b></label>
                    </div>
                    <div class="col-md-6">
                        <input onfocusout="checkGenericSingleField('userModified','errUserModified',1,'<?php echo $row['User'] ?>')" onfocusin="cleanErr('errUserModified')" id="userModified" type="text" value="<?php echo $row['User'] ?>" name="user" minlength=<?php echo UserNameMinLength?> maxlength=<?php echo UserNameMaxLength?> readonly>
                        <p id="errUserModified"></p> 
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                    <label class="labelText"><b>Email</b></label>
                    </div>
                    <div class="col-md-6">
                        <input onfocusout="checkGenericSingleField('emailModified','errEmailModified',1,'<?php echo $row['Email'] ?>')" onfocusin="cleanErr('errEmailModified')" id="emailModified" type="email" value="<?php echo $row['Email'] ?>" name="email" minlength=<?php echo EmailMinLength?> maxlength=<?php echo EmailMaxLength?> readonly>
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
                        <input onfocusout="checkGenericSingleField('nameModified','errNameModified',1)" onfocusin="cleanErr('errNameModified')" id="nameModified" type="text" value="<?php echo $row['Name'] ?>" name="name" minlength=<?php echo NameMinLength?> maxlength=<?php echo NameMaxLength?> readonly>
                        <p id="errNameModified"></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label class="labelText"><b>Cognome</b></label>
                    </div>
                    <div class="col-md-6">
                        <input onfocusout="checkGenericSingleField('surnameModified','errSurnameModified',1)" onfocusin="cleanErr('errSurnameModified')" id="surnameModified" type="text" value="<?php echo $row['Surname'] ?>" name="surname" minlength=<?php echo SurnameMinLength?> maxlength=<?php echo SurnameMaxLength?> readonly> 
                        <p id="errSurnameModified"></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label class="labelText" ><b>Indirizzo</b></label>
                    </div>
                    <div class="col-md-6">
                        <input onfocusout="checkGenericSingleField('addressModified','errAddressModified',1)" onfocusin="cleanErr('errAddressModified')" id="addressModified" type="text" value="<?php echo $row['Street'] ?>" name="address" minlength=<?php echo StreetMinLength?> maxlength=<?php echo StreetMaxLength?> readonly>
                        <p id="errAddressModified"></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label class="labelText"><b>Telefono</b></label>
                    </div>
                    <div class="col-md-6">
                        <input onfocusout="checkGenericSingleField('phoneModified','errPhoneModified',1,'<?php echo $row['Phone'] ?>')" onfocusin="cleanErr('errPhoneModified')" id="phoneModified" type="tel" value="<?php echo $row['Phone'] ?>" name="phone" minlength=<?php echo PhoneLength?> maxlength=<?php echo PhoneLength?> readonly>
                        <p id="errPhoneModified"></p>
                    </div>
                </div>

                <div class="row text-center">
                    <div class="col-md-6">
                        <button class="btn btn-primary mb-2 mb-sm-0" id="bntModify" onClick="enableChanges();">Modifica</button>
                        <button class="btn btn-primary fieldHide mb-2 mb-sm-0" id="bntSave" onClick="checkModifiedAllField('waitRegistration','<?php echo $row['User'] ?>','<?php echo $row['Email'] ?>','<?php echo $row['Phone'] ?>');">Salva</button>
                        
                    </div>
                    <div class="col-md-6">
                       <button class="btn btn-success" onClick="showHome();disableChanges();" id="bntExit">Esci</button>
                    </div>
                </div>

            </div>
        </div> 
    </div>

   

</div>