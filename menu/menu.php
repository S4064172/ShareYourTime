<div id="showMenu" onmouseover="showItem('menu');"></div>

<div id="menu" onmouseover="showItem('menu');" onmouseout="hideItem('menu');" onClick="hideItem('menu');">
    <div id="optionMenu"></div>
    <?php if ( isset($_SESSION['page']) && !empty($_SESSION['page']) &&  $_SESSION['page']!="viewprofile") {?>
    <div>
        <a href="../viewProfile/viewProfile.php">
            <button class="buttonMenu">
                Profilo
            </button>
        </a>
    </div>
    <?php } ?>
    <?php if ( isset($_SESSION['page']) && !empty($_SESSION['page']) &&  $_SESSION['page']!="homepage") {?>
    <div>
        <a href="../homepage/homepage.php">
            <button class="buttonMenu">
                Home
            </button>
        </a>
    </div>
    <?php } ?>
</div>