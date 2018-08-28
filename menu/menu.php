<?php
	require_once('../utils/utils.php');

	function createButtonInMenu($page, $text, $href) 
	{
		if ( check_SESSION_IsSetAndNotEmpty('page') && $_SESSION['page'] !== $page) { ?>
		    <div>
				<form method="GET" action="<?php echo $href; ?>">
	            	<button class="btn buttonMenu myOver">
						<?php echo $text; ?>
        	    	</button>
        		</form>
    		</div>
<?php 
		}
	} 
?>

<div id="showMenu" onmouseover="showItem('menu');"></div>

<div id="menu" onmouseover="showItem('menu');" onmouseout="hideItem('menu');" onClick="hideItem('menu');">
	<div id="optionMenu"></div>
	<?php 
			createButtonInMenu('homepage', 'Home', '../homepage/homepage.php');
			createButtonInMenu('viewprofile', 'Profilo', '../viewProfile/viewProfile.php'); 
			createButtonInMenu('viewjobs', 'I tuoi lavori', '../viewJobs/viewJobs.php'); 
			createButtonInMenu('viewjobsrequired', 'I lavori richiesti', '../viewJobs/viewJobsRequired.php'); 
			createButtonInMenu('searchjobs', 'Cerca un lavoro', '../searchJobs/searchJobs.php'); 
			createButtonInMenu('chatview', 'Chat', '../chatView/chatView.php'); 
			createButtonInMenu('privatemsg', 'Messaggi privati', '../privateMessages/privateMsg.php'); 
	?>
</div>
