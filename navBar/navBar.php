<nav class="navbar navbar-expand-md mb-3 bg-dark navbar-dark navbar-shrink fixed-top myNavBar" id="navBar">  
    
    <div class="myContainerNavBar">
        <div class="row">
            <div class="container text-center">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbarTogglerSignupLogin" aria-controls="toPoint" aria-expanded="false" aria-label="Toggle navigation">
                    <span>
                        <img class="sizeTitle" src="../img/Time1.png" alt="Logo di ShareYourTime">
                        ShareYourTime
                    </span>
                </button>
            </div>
        </div>

        <div id="toPoint" class="row">
            <?php if ( isset($_SESSION['user']) && !empty($_SESSION['user']) ) { ?>
                <div class="text-center col-md-4 collapse navbar-collapse navbarTogglerSignupLogin">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link clickable" onClick="showOrHideMenu('menu');myCollapseHide();">
                                <i class="fas fa-bars"></i>
                                <span class="myDNone">Menu</span>
                            </a>
                        </li>
                        <li class="nav-item active ">
                            <a class="nav-link" href="../homepage/homepage.php" onClick="myCollapseHide();">
                                <i class="fas fa-home"></i>
                                <span class="myDNone" >Home</span>
                            </a>
                        </li>
                        <?php if ( isset($_SESSION['page']) && !empty($_SESSION['page']) && ($_SESSION['page'] == "viewjobs") ) {?>
                            <li class="nav-item active">
                                <a class="nav-link clickable" data-toggle="modal" data-target="#jobsModal" onclick="emptyErrorModalJobs(); emptyModalJobs()">
                                    <i class="fas fa-plus"></i>
                                    <span class="s800pxDNone">Aggiungi un lavoro</span>
                                </a>
                            </li>
                        <?php }
                        if ( isset($_SESSION['page']) && !empty($_SESSION['page']) &&  ($_SESSION['page'] == "homepage") ) {?>
                            <li class="nav-item active">
                                <a class="nav-link" href="#contactUs" onClick="myCollapseHide()">Contattaci</a>
                            </li>
                        <?php } ?>
                    </ul>
                </div> 

            <?php  }else{ ?>
                
                <div class="text-center col-md-4 collapse navbar-collapse navbarTogglerSignupLogin">
                    <ul class="navbar-nav">
                        <li class="nav-item active ">
                            <a class="nav-link" href="../index/index.php" onClick="myCollapseHide()">
                                <i class="fas fa-home" ></i>
                                <span class="myDNoneIndex">Home</span>
                            </a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="#DettagliSito" onClick="myCollapseHide()">Chi Siamo</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="#RicercaMappa" onClick="myCollapseHide()">
                                <i class="fas fa-search"></i>
                                <span class="myDNoneIndex">Trova</span>
                            </a>
                        </li>
                    </ul>
                </div> 
            <?php } ?>


            <div class="col-md-4 d-none d-md-inline text-center">
                <a class=" navbar-brand mt-2" href="#">
                    <img src="../img/Time1.png" class="sizeTitle" alt="Logo di ShareYourTime">
                    ShareYourTime
                </a>
            </div> 


                
            <?php if ( isset($_SESSION['user']) && !empty($_SESSION['user']) ) {?>
                <div class=" text-center col-md-4 collapse navbar-collapse navbarTogglerSignupLogin">                
                    <form class="dimW100" action="../utils/logout.php" >
                        <button type='submit' class='btn btn-warning btnSize float-md-right mt-2'>
                            <i class='fa fa-sign-out-alt'></i>
                            Logout
                        </button>
                    </form> 
                </div>
            <?php }else{ ?>
                <div class=" text-center col-md-4 collapse navbar-collapse navbarTogglerSignupLogin">
                    <div class="dimW100">
                        <div class="float-md-right">
                            <button type='button' class='btn btn-primary mr-1 btnSize ' onClick='myCollapseHide()' data-toggle='modal' data-target='#signUpModalTarget'>
                                <i class='fa fa-user-plus'></i>
                                Registrati
                            </button>

                            <button type='button' class='btn btn-success btnSize' onClick='myCollapseHide()' data-toggle='modal' data-target='#loginModalTarget'>
                                <i class='fas fa-sign-in-alt'></i>
                                Login
                            </button>
                        </div>
                    </div>
                </div>
            <?php  }  ?> 
        </div>
    </div>
</nav>
