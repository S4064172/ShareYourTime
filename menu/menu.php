<div id="showMenu" onmouseover="showItem('menu');"></div>

<div id="menu" onmouseover="showItem('menu');" onmouseout="hideItem('menu');" onClick="hideItem('menu');">
    <div id="optionMenu"></div>
    <?php if ( isset($_SESSION['page']) && !empty($_SESSION['page']) &&  $_SESSION['page']!="homepage") {?>
    <div>
        <a href="../homepage/homepage.php">
            <button class="btn buttonMenu">
                Home
            </button>
        </a>
    </div>
    <?php } ?>    
    <?php if ( isset($_SESSION['page']) && !empty($_SESSION['page']) &&  $_SESSION['page']!="viewprofile") {?>
    <div>
        <a href="../viewProfile/viewProfile.php">
            <button class="btn buttonMenu">
                Profilo
            </button>
        </a>
    </div>
    <?php } ?>
    <?php if ( isset($_SESSION['page']) && !empty($_SESSION['page']) &&  $_SESSION['page']!="viewjobs") {?>
    <div>
        <a href="../viewJobs/viewJobs.php">
            <button class="btn buttonMenu">
                I tuoi lavori
            </button>
        </a>
    </div>
    <?php } ?>
    <?php if ( isset($_SESSION['page']) && !empty($_SESSION['page']) &&  $_SESSION['page']!="viewjobsrequired") {?>
    <div>
        <a href="../viewJobs/viewJobsRequired.php">
            <button class="btn buttonMenu">
                I lavori richiesti
            </button>
        </a>
    </div>
    <?php } ?>



</div>