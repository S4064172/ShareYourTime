<?php if($_SESSION['page'] == "viewprofile"){ ?>
    <div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
<?php } ?>
<?php if($_SESSION['page'] == "viewjobs"){ ?>
    <div class="modal fade" id="confirmDelete_<?php echo sanitizeToHtml( $row['IdJob']) ?>" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
<?php } ?>
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-body">
                <div class="container myContainer-padding">
                    <div class="row">
                        <div class="col-12 text-center">
                            <label><b>Inserisci la password</b></label>
                            <input onfocusout="checkPsw('modalPswDelete', 'errModalPswDelete');" onfocusin="cleanErr('errModalPswDelete');" id="modalPswDelete" class="inputTextModal" type="password" name="psw" minlength=<?php echo PasswordMinLength?>>
                            <p id="errModalPswDelete"></p>    
                        </div>                                                        
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
                <?php if($_SESSION['page'] == "viewprofile"){ ?>
                    <button type="button" class="btn btn-primary" onclick="confirmOperation('modalPswDelete','errModalPswDelete')">Conferma</button>
                <?php } ?>
                <?php if($_SESSION['page'] == "viewjobs"){ ?>
                    <button type="button" class="btn btn-primary" onclick="confirmOperation('modalPswDelete','errModalPswDelete',<?php echo sanitizeToHtml( $row['IdJob']) ?>)">Conferma</button>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
