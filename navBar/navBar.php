<!--
    -nav bar
-->

<nav class="navbar navbar-expand-md d-flex flex-column flex-md-row justify-content-md-between  mb-3 bg-dark navbar-dark navbar-shrink fixed-top" id="navBar">  
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbarTogglerSignupLogin" aria-controls="navbarTogglerSignupLogin" aria-expanded="false" aria-label="Toggle navigation">
        <span>
            <img class="sizeTitle" src="img/Time1.png">
                ShareYourTime
        </span>
    </button>

    <div>
        <div class="collapse navbar-collapse navbarTogglerSignupLogin">
            <ul class="navbar-nav">
            <li class="nav-item active ml-4 ml-mg-0 pr-2">
                <a class="nav-link" href="index.php"><i class="fas fa-home pl-2 pl-mg-0"></i></a>
            </li>
            <li class="nav-item active pl-2">
                <a class="nav-link" href="#TagDettagliSito">Chi Siamo</a>
            </li>
            <li class="nav-item active pl-2">
                <a class="nav-link" href="#TagRicerca">
                    <i class="fas fa-search"></i>
                    Trova
                </a>
            </li>
            </ul>
        </div>
    </div>
    
    <div class="d-none d-md-inline">
        <a class="navbar-brand mt-0" href="index.php">
            <img src="img/Time1.png" class="sizeTitle">
            ShareYourTime
        </a>
    </div>
    <div>
        <span class="collapse navbar-collapse navbarTogglerSignupLogin">	
            <button type="button" href="#" class="btn btn-primary mr-2 d-block d-sm-inline btnSize"  data-toggle="modal" data-target="#signUpModalTarget">
                <i class="fa fa-user-plus"></i>
                    Registrati
            </button>
            <button type="button" class="btn btn-success mt-2 mt-sm-0  ml-3 ml-sm-0 btnSize" data-toggle="modal" data-target="#loginModalTarget">
            <i class="fas fa-sign-in-alt"></i>
                    Login
            </button>

            
        </span>
    </div> 
</nav>
