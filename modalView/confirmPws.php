<div class="modal fade" id="confirmDeleteAccount" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteAccountLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-body">
                <div class="container myContainer-padding">
                    <div class="row">
                        <div class="col-12 text-center">
                            <label><b>Inserisci la password</b></label>
                            <input onfocusout="checkPsw('modalPwsDelete', 'errModalPwsDelete');" onfocusin="cleanErr('errModalPwsDelete');" id="modalPwsDelete" class="inputTextModal" type="password" name="psw" minlength=<?php echo PasswordMinLength?>>
                            <p id="errModalPwsDelete"></p>    
                        </div>                                                        
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onClick="confirmPws('<?php $_SESSION['user'] ?>','modalPwsDelete','errModalPwsDelete')">Save changes</button>
            </div>
        </div>
    </div>
</div>
