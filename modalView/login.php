<?php require_once('../utils/constant.php');?>

<div class="modal myModal myModal-mt fade" id="loginModalTarget" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="wait" id="waitLogin">
            <img class="imgWait" src="../img/sandclock.png">
    </div>
    <div class="modal-dialog" role="document">
        <div class="modal-content animate">
            <div class="imgcontainer">
                <button type="button"  class="close myClose" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <img src="../img/avatar.png" alt="Avatar" class="avatar">
            </div> 
            <div class="myContainer-padding">
                <label class="text-c"><b>Username</b></label>
                <input type="text" onfocusin="cleanErr('errLogin')" placeholder="Enter Username" id="userLogin" class="inputTextModal" name="usernameLogin" minlength=<?php echo UserNameMinLength?> maxlength=<?php echo UserNameMaxLength?> >
                <label class="text-c"><b>Password</b></label>
                <input type="password" onfocusin="cleanErr('errLogin')" placeholder="Enter Password" id="pwsLogin" class="inputTextModal"  name="pswLogin" minlength=<?php echo PasswordMinLength?> >
                <p id="errLogin"></p>
                <button type="button" onClick="checkLoginAllField('userLogin','pwsLogin', 'errLogin', 'waitLogin')" class="btn btn-success mybutton mt-4">Login</button>
            </div>	
        </div>
    </div>
</div>