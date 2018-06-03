<!--
    -nav bar
-->

<nav class="navbar navbar-expand-md d-flex flex-column flex-md-row justify-content-md-between  mb-3 bg-dark navbar-dark navbar-shrink fixed-top" id="navBar">  
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span>
            <img class"navbar-toggler-icon" src="img/Time1.png" style="width:40px;">
                ShareYourTime
        </span>
    </button>

    <div>
        <div class="collapse navbar-collapse navbarTogglerDemo01">
            <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            </ul>
        </div>
    </div>
    
    <div class="d-none d-md-inline">
        <a class="navbar-brand mt-2 mt-lg-0" href="#">
            <img src="img/Time1.png" style="width:40px;">
            ShareYourTime
        </a>
    </div>

    <div>
        <span class="collapse navbar-collapse navbarTogglerDemo01">	
            <button id="signupB" type="submit" href="#" class="btn btn-primary mr-2 d-block d-sm-inline " onclick="showById('signupModal'); disableButtonById('loginB')">
                <i class="fa fa-user-plus"></i>
                    Sign-Up
            </button>
            <button id="loginB" type="submit" href="#" class="btn btn-success mt-2 mt-sm-0 ml-2" onclick="showById('loginModal'); disableButtonById('signupB')">
                <i class="fas fa-sign-in-alt"></i>
                    Login
            </button>
        </span>
    </div> 
</nav>
