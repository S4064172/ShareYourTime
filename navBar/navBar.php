<!--
    -nav bar
-->

<nav class="navbar navbar-expand-md d-flex justify-content-between  mb-3 bg-dark navbar-dark navbar-shrink fixed-top h-auto" id="navBar">  
    <div class="p-2">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse navbarTogglerDemo01">
            <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            </ul>
        </div>
    </div>
    
    <div class="p-2">
        <a class="navbar-brand mt-2 mt-lg-0" href="#">
            <img src="img/Time1.png" style="width:40px;">
            ShareYourTime
        </a>
    </div>

    <div class="p-2">
        <span class="my-right-btn collapse navbar-collapse navbarTogglerDemo01">	
            <button id="signupB" type="submit" href="#" class="btn btn-primary" onclick="showById('signupModal'); disableButtonById('loginB')">
                <i class="fa fa-user-plus"></i>
                    Sign-Up
            </button>
            <button id="loginB" type="submit" href="#" class="btn btn-success" onclick="showById('loginModal'); disableButtonById('signupB')">
                <i class="fas fa-sign-in-alt"></i>
                    Login
            </button>
        </span>
    </div>
</nav>
