<?php
	require("insertFunctions.php");

	//Test
	echo time()."<br>".date('D, d M Y  h:m', strtotime('+26 hour'))."<br>";
	$now = date('Y-m-d');
	$time1S = date('Y-m-d H:i:s', strtotime('+1 hour'));
	$time1E = date('Y-m-d H:i:s', strtotime('+3 hour'));
	$time2S = date('Y-m-d H:i:s', strtotime('+3 day +18 hour'));
	$time2E = date('Y-m-d H:i:s', strtotime('+3 day +20 hour'));
	$then = date('Y-m-d', strtotime('+3 day'));

	insertInto_ShareYourUserTime("pippo", "11111111aA!", "Pippo", "Regex", "1234567890", "pippo@aaa.it", "via topolinia 44", "../../profile_imgs/pippo.jpg");
	insertInto_ShareYourUserTime("ken", "987654321Qq?", "John", "Kennedy", "0987654321", "ken@bbb.it", "corso buenos aires 173", "../../profile_imgs/ken.jpg");

	insertInto_ShareYourJobsTime(5, $time1S, $time1E, $now, 2, 1, "via pia", 86.51, 77.41, "pippo");
	insertInto_ShareYourJobsTime(20, $time2S, $time2E, $then, 4, 3, "corso ricci", 12.39, 36.88, "ken");

	insertInto_ShareYourTagsTime("INFORMATICA");
	insertInto_ShareYourTagsTime("IDRAULICA");
	insertInto_ShareYourTagsTime("RIPARAZIONI");
	insertInto_ShareYourTagsTime("RIPETIZIONI");
	
	insertInto_ShareYourTagsJobsTime("INFORMATICA", 1);
	insertInto_ShareYourTagsJobsTime("IDRAULICA", 2);
	insertInto_ShareYourTagsJobsTime("RIPARAZIONI", 2);

