<div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-body">
                <div class="container myContainer-padding">
                    <div class="row">
                        <div class="col-12 text-center">
                            <label><b>Inserisci la password</b></label>
                            <input onblur="checkPsw('modalPswDelete', 'errModalPswDelete');" onfocus="cleanErr('errModalPswDelete');" id="modalPswDelete" class="inputTextModal" type="password" name="psw" minlength=<?php echo PasswordMinLength?>>
                            <p id="errModalPswDelete"></p>    
                        </div>                                                        
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
                <button id="btnConfirm" type="button" class="btn btn-primary">Conferma</button>
            </div>
        </div>
    </div>
</div>
