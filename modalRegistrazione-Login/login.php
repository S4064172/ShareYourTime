<div class="modal myModal myModal-mt fade" id="loginModalTarget" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content animate">
            <form>
                <div class="imgcontainer">
                    <button type="button"  class="close myClose" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <img src="img/avatar.png" alt="Avatar" class="avatar">
                </div> 
                <div class="myContainer-padding">
                    <label class="textModal-c"><b>Username</b></label>
                    <input type="textModal" onfocusin="cleanErr('errLogin')" placeholder="Enter Username" id="userLogin" name="usernameLogin" minlength="5" maxlength="125" required>
                    <label class="textModal-c"><b>Password</b></label>
                    <input type="password" onfocusin="cleanErr('errLogin')" placeholder="Enter Password" id="pwsLogin" name="pswLogin" minlength="8" maxlength="125" required>
                    <p id="errLogin"></p>
                    <button type="button" onClick="checkLogin('userLogin','pwsLogin','errLogin')" class="btn btn-success mybutton mt-4">Login</button>
                </div>	
            </form>
        </div>
    </div>
</div>