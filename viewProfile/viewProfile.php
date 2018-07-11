<?php require_once('utils/dataBaseConstant.php');?>

<div class="myContainerMarginTop">

    <div class="row">
        <div class="offset-4 col-md-6">
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
                                <input onfocusout="" onfocusin="cleanErr('errUsername')" id="" type="text" placeholder="Inserisci un username" name="" minlength=<?php echo UserNameMinLength?> maxlength=<?php echo UserNameMaxLength?> required>
                                <p id="errUsername"></p> 
                            </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                    <label class="labelText"><b>Email</b></label>
                    </div>
                    <div class="col-md-6">
                        <input onfocusout="" onfocusin="cleanErr('errEmail')" id="" type="email" placeholder="Inserisci il tuo indirizzo email" name="" minlength=<?php echo EmailMinLength?> maxlength=<?php echo EmailMaxLength?> required>
                        <p id=""></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label class="labelText"><b>Password</b></label>
                    </div>
                    <div class="col-md-6">
                        <input onfocusout="" onfocusin="cleanErr('errPsw')" id="pswReg" type="password" placeholder="Inserisci una password" name="pswReg" minlength=<?php echo PasswordMinLength?> required>
                        <p id="errPsw"></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label class="labelText"><b>Nome</b></label>
                    </div>
                    <div class="col-md-6">
                        <input onfocusout="checkRegistrationSingleField('nameReg','errName')" onfocusin="cleanErr('errName')" id="nameReg" type="text" placeholder="Inserisci il tuo nome" name="nameReg" minlength=<?php echo NameMinLength?> maxlength=<?php echo NameMaxLength?> required>
                        <p id="errName"></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label class="labelText"><b>Cognome</b></label>
                    </div>
                    <div class="col-md-6">
                        <input onfocusout="checkRegistrationSingleField('surnameReg','errSurname')" onfocusin="cleanErr('errSurname')" id="surnameReg" type="text" placeholder="Inserisci il tuo cognome" name="surnameReg" minlength=<?php echo SurnameMinLength?> maxlength=<?php echo SurnameMaxLength?> required> 
                        <p id="errSurname"></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label class="labelText" ><b>Indirizzo</b></label>
                    </div>
                    <div class="col-md-6">
                        <input onfocusout="checkRegistrationSingleField('addressReg','errAddress')" onfocusin="cleanErr('errAddress')" id="addressReg" type="text" placeholder="Inserisci il tuo indirizzo" name="addressReg" minlength=<?php echo StreetMinLength?> maxlength=<?php echo StreetMaxLength?> required>
                        <p id="errAddress"></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label class="labelText"><b>Telefono</b></label>
                    </div>
                    <div class="col-md-6">
                        <input onfocusout="checkRegistrationSingleField('telephoneReg','errTelephone')" onfocusin="cleanErr('errTelephone')" id="telephoneReg" type="tel" placeholder="Inserisci un numero di telefono" name="telephoneReg" minlength=<?php echo PhoneLength?> maxlength=<?php echo PhoneLength?> required>
                        <p id="errTelephone"></p>
                    </div>
                </div>
            </div>
        </div> 
    </div>

   

</div>