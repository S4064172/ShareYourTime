<div class="modal myModal myModal-mt fade" id="loginModalTarget" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content animate">
            <form  action="login.php" method="POST">
                <div class="imgcontainer">
                    <button type="button"  class="close myClose" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <img src="img/avatar.png" alt="Avatar" class="avatar">
                </div> 
                <div class="myContainer-padding">
                    <label for="usernameLogin" class="textModal-c"><b>Username</b></label>
                        <input type="textModal" placeholder="Enter Username" name="usernameLogin" minlength="5" maxlength="125" required>
                    <label for="pswLogin" class="textModal-c"><b>Password</b></label>
                        <input type="password" placeholder="Enter Password" name="pswLogin" minlength="8" maxlength="125" required>
                    <button type="submit" class="btn btn-success mybutton mt-4">Login</button>
                </div>	
            </form>
        </div>
    </div>
</div>