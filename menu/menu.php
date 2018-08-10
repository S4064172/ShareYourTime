<div id="showMenu" onmouseover="showItem('menu');"></div>

<div id="menu" onmouseover="showItem('menu');" onmouseout="hideItem('menu');" onClick="hideItem('menu');">
    <div id="optionMenu"></div>
    <?php if ( isset($_SESSION['page']) && !empty($_SESSION['page']) &&  $_SESSION['page']!="homepage") {?>
    <div>
        <a href="../homepage/homepage.php">
            <button class="btn buttonMenu myOver">
                Home
            </button>
        </a>
    </div>
    <?php } ?> 
     
    <?php if ( isset($_SESSION['page']) && !empty($_SESSION['page']) &&  $_SESSION['page']!="viewprofile") {?>
    <div>
        <a href="../viewProfile/viewProfile.php">
            <button class="btn buttonMenu myOver">
                Profilo
            </button>
        </a>
    </div>
    <?php } ?>
    <?php if ( isset($_SESSION['page']) && !empty($_SESSION['page']) &&  $_SESSION['page']!="viewjobs") {?>
    <div>
        <a href="../viewJobs/viewJobs.php">
            <button class="btn buttonMenu myOver">
                I tuoi lavori
            </button>
        </a>
    </div>
    <?php } ?>
    <?php if ( isset($_SESSION['page']) && !empty($_SESSION['page']) &&  $_SESSION['page']!="viewjobsrequired") {?>
    <div>
        <a href="../viewJobs/viewJobsRequired.php">
            <button class="btn buttonMenu myOver">
                I lavori richiesti
            </button>
        </a>
    </div>
    <?php } ?>
    <?php if ( isset($_SESSION['page']) && !empty($_SESSION['page']) &&  $_SESSION['page']!="searchjobs") {?>
    <div>
        <a href="../searchJobs/searchJobs.php">
            <button class="btn buttonMenu myOver">
                Cerca un lavoro
            </button>
        </a>
    </div>
    <?php } ?> 
    <?php if ( isset($_SESSION['page']) && !empty($_SESSION['page']) &&  $_SESSION['page']!="chatView") {?>
    <div>
        <a href="../chatView/chatView.php">
            <button class="btn buttonMenu myOver">
                Chat
            </button>
        </a>
    </div>
    <?php } ?> 



</div>