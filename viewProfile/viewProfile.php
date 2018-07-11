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
                        <input onfocusout="" onfocusin="cleanErr('')" id="userModified" type="text" placeholder="Inserisci un username" name="userModified" minlength=<?php echo UserNameMinLength?> maxlength=<?php echo UserNameMaxLength?> readonly>
                        <p id="errUserModified"></p> 
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                    <label class="labelText"><b>Email</b></label>
                    </div>
                    <div class="col-md-6">
                        <input onfocusout="" onfocusin="cleanErr('')" id="emailModified" type="email" placeholder="Inserisci il tuo indirizzo email" name="emailModified" minlength=<?php echo EmailMinLength?> maxlength=<?php echo EmailMaxLength?> readonly>
                        <p id="errEmailModified"></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label class="labelText fieldHide" id="pswLabel"><b>Password</b></label>
                    </div>
                    <div class="col-md-6">
                        <input onfocusout="" onfocusin="cleanErr('')" id="pswModified" type="password" placeholder="Inserisci una password" name="pswModified" minlength=<?php echo PasswordMinLength?> readonly>
                        <p id="errPswModified"></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label class="labelText"><b>Nome</b></label>
                    </div>
                    <div class="col-md-6">
                        <input onfocusout="" onfocusin="cleanErr('')" id="nameModified" type="text" placeholder="Inserisci il tuo nome" name="nameModified" minlength=<?php echo NameMinLength?> maxlength=<?php echo NameMaxLength?> readonly>
                        <p id="errNameModified"></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label class="labelText"><b>Cognome</b></label>
                    </div>
                    <div class="col-md-6">
                        <input onfocusout="" onfocusin="cleanErr('')" id="surnameModified" type="text" placeholder="Inserisci il tuo cognome" name="surnameModified" minlength=<?php echo SurnameMinLength?> maxlength=<?php echo SurnameMaxLength?> readonly> 
                        <p id="errSurnameModified"></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label class="labelText" ><b>Indirizzo</b></label>
                    </div>
                    <div class="col-md-6">
                        <input onfocusout="" onfocusin="cleanErr('')" id="addressModified" type="text" placeholder="Inserisci il tuo indirizzo" name="addressModified" minlength=<?php echo StreetMinLength?> maxlength=<?php echo StreetMaxLength?> readonly>
                        <p id="errAddressModified"></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label class="labelText"><b>Telefono</b></label>
                    </div>
                    <div class="col-md-6">
                        <input onfocusout="" onfocusin="cleanErr('')" id="phoneModified" type="tel" placeholder="Inserisci un numero di telefono" name="phoneModified" minlength=<?php echo PhoneLength?> maxlength=<?php echo PhoneLength?> readonly>
                        <p id="errPhoneModified"></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <button class="btn btn-primary" id="bntModify" onClick="hideItem('bntModify');showItem('bntSave');showItem('pswLabel');showItem('pswModified');removeReadOnly();">Modifica</button>
                        <button class="btn btn-primary fieldHide" id="bntSave" onClick="hideItem('bntSave');showItem('bntModify');hideItem('pswLabel');hideItem('pswModified');addReadOnly();">Salva</button>
                    </div>
                    <div class="col-md-6">
                       <button class="btn btn-success" onClick="hideItem('pswLabel');hideItem('pswModified');addReadOnly();showHome();" id="bntExit">Esci</button>
                    </div>
                </div>

            </div>
        </div> 
    </div>

   

</div>