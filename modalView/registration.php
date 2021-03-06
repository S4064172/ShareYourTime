<?php require_once('../utils/constant.php');?>

<div class="modal myModal fade" id="signUpModalTarget" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="wait" id="waitRegistration">
        <img class="imgWait" src="../img/sandclock.png" alt="Clessidra">
    </div>
    <div class="modal-dialog" role="document">
        <div class="modal-content animate">
			
            <div class="imgcontainer">
                <button type="button" class="close myClose" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <label class="signupText">Benvenuto !</label>&nbsp;
                <img src="../img/Time1.png" alt="Avatar" class="avatar">
            </div>

            <div class="container myContainer-padding">
                <div class="row">
                    <div class="col-md-6">
                        <label><b>Username</b></label>
                        <input onblur="checkUsername('usernameReg','errUsername')" onfocus="cleanErr('errUsername')" id="usernameReg" class="inputTextModal" type="text" placeholder="Inserisci un username" name="user" minlength=<?php echo UserNameMinLength?> maxlength=<?php echo UserNameMaxLength?> >
                        <p id="errUsername"></p>                                                            
                    </div>
                    <div class="col-md-6">
                        <label class="text-r"><b>Email</b></label>
                        <input onblur="checkEmail('emailReg','errEmail')" onfocus="cleanErr('errEmail')" id="emailReg" class="inputTextModal" type="email" placeholder="Inserisci il tuo indirizzo email" name="email" minlength=<?php echo EmailMinLength?> maxlength=<?php echo EmailMaxLength?> >
                        <p id="errEmail"></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label><b>Password</b></label>
                        <input onblur="checkPsw('pswReg','errPsw')" onfocus="cleanErr('errPsw')" id="pswReg" class="inputTextModal" type="password" placeholder="Inserisci una password" name="psw" minlength=<?php echo PasswordMinLength?> >
                        <p id="errPsw"></p>
                    </div>
                    <div class="col-md-6">
                        <label class="text-r"><b>Conferma Password</b></label>
                        <input  onblur="checkConfPsw('pswRegConf','errPswConf','pswReg')" onfocus="cleanErr('errPswConf')" id="pswRegConf" class="inputTextModal" type="password" placeholder="Conferma la password" name="pswConf" minlength=<?php echo PasswordMinLength?> >
                        <p id="errPswConf"></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label><b>Nome</b></label>
                        <input onblur="checkName('nameReg','errName')" onfocus="cleanErr('errName')" id="nameReg" class="inputTextModal" type="text" placeholder="Inserisci il tuo nome" name="name" minlength=<?php echo NameMinLength?> maxlength=<?php echo NameMaxLength?> >
                        <p id="errName"></p>
                    </div>
                    <div class="col-md-6">
                        <label class="text-r"><b>Cognome</b></label>
                        <input onblur="checkSurname('surnameReg','errSurname')" onfocus="cleanErr('errSurname')" id="surnameReg" class="inputTextModal" type="text" placeholder="Inserisci il tuo cognome" name="surname" minlength=<?php echo SurnameMinLength?> maxlength=<?php echo SurnameMaxLength?> > 
                        <p id="errSurname"></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label><b>Indirizzo</b></label>
                        <input onfocus="cleanErr('errAddress')" id="addressReg" class="inputTextModal" type="text" placeholder="Inserisci il tuo indirizzo" name="address" minlength=<?php echo StreetMinLength?> maxlength=<?php echo StreetMaxLength?> >
                        <p id="errAddress"></p>
                    </div>
                    <div class="col-md-6">
                        <label class="text-r"><b>Telefono</b></label>
                        <input onblur="checkPhone('telephoneReg','errTelephone')" onfocus="cleanErr('errTelephone')" id="telephoneReg" class="inputTextModal" type="tel" placeholder="Inserisci un numero di telefono" name="phone" minlength=<?php echo PhoneLength?> maxlength=<?php echo PhoneLength?> >
                        <p id="errTelephone"></p>
                    </div>
                </div>

                <label>Immagine del profilo</label>&nbsp;&nbsp;&nbsp;&nbsp;
              	<input type="file" onchange="cleanErr('errPhoto');checkPhoto('photoReg','errPhoto')" id="photoReg" name="photo" accept=".png, .jpg, .jpeg" >
				<p id="errPhoto"></p>

                <button type="button" onclick="checkRegistrationAllField('waitRegistration')" class="btn btn-success mybutton mt-4">Registrati</button>
            </div>

        </div>
    </div>
</div>
