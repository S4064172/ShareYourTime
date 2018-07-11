<?php 
    require_once('utils/dataBaseConstant.php');
    require_once('db/connection.php');

    $conn = connectionToDb();
    $getInfoUserQuery = "SELECT User,Name,Surname,Phone,Email,Street FROM ShareYourUsersTime where user='".$_SESSION['user']."'";
    if ( !($res = mysqli_query($conn, $getInfoUserQuery)) ) 
                die('Errore nella selezione dei lavori');
    $row = mysqli_fetch_array($res);
    mysqli_free_result($res);
?>

<div class="myContainerPageToView">

    <div class="row text-center">
        <div class="col-12">
            <h1>Impostazioni Profilo</h1>
        </div>  
    </div>
    
    <div class="row">
        <div class="col-lg-4">
        <h1>Foto Profilo</h1>
        </div>  
        <div class="col-lg-8">
            <div class="MyContainer">
                <div class="row">
                    <div class="col-md-6">
                        <label class="labelText"><b>Username</b></label>
                    </div>
                    <div class="col-md-6">
                        <input onfocusout="" onfocusin="cleanErr('')" id="userModified" type="text" value="<?php echo $row['User'] ?>" name="userModified" minlength=<?php echo UserNameMinLength?> maxlength=<?php echo UserNameMaxLength?> readonly>
                        <p id="errUserModified"></p> 
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                    <label class="labelText"><b>Email</b></label>
                    </div>
                    <div class="col-md-6">
                        <input onfocusout="" onfocusin="cleanErr('')" id="emailModified" type="email" value="<?php echo $row['Email'] ?>" name="emailModified" minlength=<?php echo EmailMinLength?> maxlength=<?php echo EmailMaxLength?> readonly>
                        <p id="errEmailModified"></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label class="labelText fieldHide" id="pswLabel"><b>Password</b></label>
                    </div>
                    <div class="col-md-6">
                        <input onfocusout="" onfocusin="cleanErr('')" id="pswModified" type="password" name="pswModified" minlength="<?php echo PasswordMinLength?>" readonly>
                        <p id="errPswModified"></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label class="labelText"><b>Nome</b></label>
                    </div>
                    <div class="col-md-6">
                        <input onfocusout="" onfocusin="cleanErr('')" id="nameModified" type="text" value="<?php echo $row['Name'] ?>" name="nameModified" minlength=<?php echo NameMinLength?> maxlength=<?php echo NameMaxLength?> readonly>
                        <p id="errNameModified"></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label class="labelText"><b>Cognome</b></label>
                    </div>
                    <div class="col-md-6">
                        <input onfocusout="" onfocusin="cleanErr('')" id="surnameModified" type="text" value="<?php echo $row['Surname'] ?>" name="surnameModified" minlength=<?php echo SurnameMinLength?> maxlength=<?php echo SurnameMaxLength?> readonly> 
                        <p id="errSurnameModified"></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label class="labelText" ><b>Indirizzo</b></label>
                    </div>
                    <div class="col-md-6">
                        <input onfocusout="" onfocusin="cleanErr('')" id="addressModified" type="text" value="<?php echo $row['Street'] ?>" name="addressModified" minlength=<?php echo StreetMinLength?> maxlength=<?php echo StreetMaxLength?> readonly>
                        <p id="errAddressModified"></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label class="labelText"><b>Telefono</b></label>
                    </div>
                    <div class="col-md-6">
                        <input onfocusout="" onfocusin="cleanErr('')" id="phoneModified" type="tel" value="<?php echo $row['Phone'] ?>" name="phoneModified" minlength=<?php echo PhoneLength?> maxlength=<?php echo PhoneLength?> readonly>
                        <p id="errPhoneModified"></p>
                    </div>
                </div>

                <div class="row text-center">
                    <div class="col-md-6">
                        <button class="btn btn-primary mb-2 mb-sm-0" id="bntModify" onClick="hideItem('bntModify');showItem('bntSave');showItem('pswLabel');showItem('pswModified');removeReadOnly();">Modifica</button>
                        <button class="btn btn-primary fieldHide mb-2 mb-sm-0" id="bntSave" onClick="hideItem('bntSave');showItem('bntModify');hideItem('pswLabel');hideItem('pswModified');addReadOnly();">Salva</button>
                    </div>
                    <div class="col-md-6">
                       <button class="btn btn-success" onClick="hideItem('pswLabel');hideItem('pswModified');addReadOnly();showHome();" id="bntExit">Esci</button>
                    </div>
                </div>

            </div>
        </div> 
    </div>

   

</div>