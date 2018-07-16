<!--
    -nav bar
-->
<nav class="navbar navbar-expand-md d-flex flex-column flex-md-row justify-content-md-between mb-3 bg-dark navbar-dark navbar-shrink fixed-top" id="navBar">  
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbarTogglerSignupLogin" aria-controls="navbarTogglerSignupLogin" aria-expanded="false" aria-label="Toggle navigation">
        <span>
            <img class="sizeTitle" src="../img/Time1.png">
                ShareYourTime
        </span>
    </button>

    <div>
        <div class="collapse navbar-collapse navbarTogglerSignupLogin">
            <ul class="navbar-nav">

                <?php if ( isset($_SESSION['user']) && !empty($_SESSION['user']) ) { ?>
                    <li class="nav-item active ">
                        <a class="nav-link" id="clickable" onClick="showOrHideMenu('menu');myCollapseHide();">
                            <i class="fas fa-bars" ></i>
                            <span class="d-inline d-md-none">Menu</span>
                        </a>
                    </li>
                    <li class="nav-item active ">
                        <a class="nav-link" href="../homepage/homepage.php" onClick="myCollapseHide();">
                            <i class="fas fa-home" ></i>
                            <span class="d-inline d-md-none">Home</span>
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#contactUs" onClick="myCollapseHide()">Contattaci</a>
                    </li>

                <?php  }else{ ?>

                    <li class="nav-item active ">
                        <a class="nav-link" href="../index/index.php" onClick="myCollapseHide()">
                            <i class="fas fa-home" ></i>
                            <span class="d-inline d-md-none">Home</span>
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#DettagliSito" onClick="myCollapseHide()">Chi Siamo</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#RicercaMappa" onClick="myCollapseHide()">
                            <i class="fas fa-search"></i>
                            Trova
                        </a>
                    </li>

                <?php } ?>
                
            
            </ul>
        </div>
    </div>
    
    <div class="d-none d-md-inline">
            <a class="navbar-brand mt-0" href="#">
            <img src="../img/Time1.png" class="sizeTitle">
            ShareYourTime
        </a>
    </div>
    <div>
    <span class='collapse navbar-collapse navbarTogglerSignupLogin'>
        <?php if ( isset($_SESSION['user']) && !empty($_SESSION['user']) ) {?>
            <form action="../navBar/logout.php" >
                <button type='submit' class='btn btn-warning mr-2 d-block d-sm-inline btnSize'>
                    <i class='fa fa-sign-out-alt'></i>
                    Logout
                </button>
            </form> 
        <?php }else{ ?>
            <button type='button' href='#' class='btn btn-primary mr-2 d-block d-sm-inline btnSize' onClick='myCollapseHide()' data-toggle='modal' data-target='#signUpModalTarget'>
                <i class='fa fa-user-plus'></i>
                Registrati
            </button>
            <button type='button' class='btn btn-success mt-2 mt-sm-0  ml-3 ml-sm-0 btnSize' onClick='myCollapseHide()' data-toggle='modal' data-target='#loginModalTarget'>
                <i class='fas fa-sign-in-alt'></i>
                Login
            </button>
        <?php  }  ?>
        </span>
    </div> 
</nav>
