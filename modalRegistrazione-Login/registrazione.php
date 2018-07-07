<div class="modal myModal fade" id="signUpModalTarget" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content animate">
			<form action="modalRegistrazione-Login/registerUser.php" method="POST">
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
                            <label><b>Username</b></label>
						    <input onfocusout="checkFieldReg('usernameReg','errUsername')" onfocusin="cleanErr('errUsername')" id="usernameReg" type="textModal" placeholder="Inserisci un username" name="usernameReg" minlength="5" maxlength="25" required>
                            <p id="errUsername"></p>                                                            
                        </div>
                        <div class="col-md-6">
                            <label class="textModal-r"><b>Email</b></label>
                            <input onfocusout="checkFieldReg('emailReg','errEmail')" onfocusin="cleanErr('errEmail')" id="emailReg" type="email" placeholder="Inserisci il tuo indirizzo email" name="emailReg" minlength="6" maxlength="125" required>
                            <p id="errEmail"></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label><b>Password</b></label>
                            <input onfocusout="checkFieldReg('pswReg','errPsw')" onfocusin="cleanErr('errPsw')" id="pswReg" type="password" placeholder="Inserisci una password" name="pswReg" minlength="8" maxlength="45" required>
                            <p id="errPsw"></p>
                        </div>
                        <div class="col-md-6">
                            <label class="textModal-r"><b>Conferma Password</b></label>
                            <input  onfocusout="checkFieldReg('pswRegConf','errPswConf','pswReg')" onfocusin="cleanErr('errPswConf')" id="pswRegConf" type="password" placeholder="Conferma la password" name="pswRegConf" minlength="8" maxlength="45" required>
                            <p id="errPswConf"></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label><b>Nome</b></label>
                            <input onfocusout="checkFieldReg('nameReg','errName')" onfocusin="cleanErr('errName')" id="nameReg" type="textModal" placeholder="Inserisci il tuo nome" name="nameReg" maxlength="30" required>
                            <p id="errName"></p>
                        </div>
                        <div class="col-md-6">
                            <label class="textModal-r"><b>Cognome</b></label>
                            <input onfocusout="checkFieldReg('surnameReg','errSurname')" onfocusin="cleanErr('errSurname')" id="surnameReg" type="textModal" placeholder="Inserisci il tuo cognome" name="surnameReg" maxlength="30" required> 
                            <p id="errSurname"></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label><b>Indirizzo</b></label>
                            <input onfocusout="checkFieldReg('addressReg','errAddress')" onfocusin="cleanErr('errAddress')" id="addressReg" type="textModal" placeholder="Inserisci il tuo indirizzo" name="addressReg" minlength="6" maxlength="125" required>
                            <p id="errAddress"></p>
                        </div>
                        <div class="col-md-6">
                            <label for="telephone" class="textModal-r"><b>Telefono</b></label>
                            <input onfocusout="checkFieldReg('telephoneReg','errTelephone')" onfocusin="cleanErr('errTelephone')" id="telephoneReg" type="tel" placeholder="Inserisci un numero di telefono" name="telephoneReg" minlength="10" maxlength="10" required>
                            <p id="errTelephone"></p>
                        </div>
                    </div>


                    <label>Immagine del profilo</label>&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="file" accept=".png, .jpg, .jpeg" name="profilePhoto">
                    <button type="submit" class="btn btn-success mybutton mt-4">Registrati</button>
                </div>
            </form>
        </div>
    </div>
</div>
