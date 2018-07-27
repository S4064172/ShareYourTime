<?php
	require_once("insertFunctions.php");
	require_once("updataFunctions.php");

	echo '<br>';

	//Test
	$time1S = date('Y-m-d H:i', strtotime('+1 hour'));
	$time1E = date('Y-m-d H:i', strtotime('+3 hour'));
	$time2S = date('Y-m-d H:i', strtotime('+3 day +1 hour'));
	$time2E = date('Y-m-d H:i', strtotime('+3 day +5 hour'));
	$time3S = date('Y-m-d H:i', strtotime('+1 day +1 hour'));
	$time3E = date('Y-m-d H:i', strtotime('+1 day +3 hour'));
	$time4S = date('Y-m-d H:i', strtotime('+2 day +6 hour'));
	$time4E = date('Y-m-d H:i', strtotime('+2 day +7 hour'));
	$time5S = date('Y-m-d H:i', strtotime('+6 day +1 hour'));
	$time5E = date('Y-m-d H:i', strtotime('+6 day +3 hour'));
	$time6S = date('Y-m-d H:i', strtotime('+2 day +8 hour'));
	$time6E = date('Y-m-d H:i', strtotime('+2 day +10 hour'));
	$time7S = date('Y-m-d H:i', strtotime('-2 day +8 hour'));
	$time7E = date('Y-m-d H:i', strtotime('-2 day +10 hour'));
	$time8S = date('Y-m-d H:i', strtotime('+1 day +8 hour'));
	$time8E = date('Y-m-d H:i', strtotime('+1 day +10 hour'));

	insertInto_ShareYourTagsTime("INFORMATICA");
	insertInto_ShareYourTagsTime("IDRAULICA");
	insertInto_ShareYourTagsTime("RIPARAZIONI");
	insertInto_ShareYourTagsTime("LAVAGGIO");
	insertInto_ShareYourTagsTime("GIARDINAGGIO");
	insertInto_ShareYourTagsTime("CUCINA");
	insertInto_ShareYourTagsTime("FAI DA TE");
	
	insertInto_ShareYourUserTime("pippo", "11111111aA!", "Pippo", "Regex", "1234567890", "pippo@aaa.it", "via topolinia 44", "../../profile_imgs/pippo.jpg");
	insertInto_ShareYourUserTime("kenny", "987654321Qq?", "John", "Kennedy", "0987654321", "ken@bbb.it", "corso buenos aires 173", "../../profile_imgs/kenny.jpg");


	insertInto_ShareYourJobsTime("Insegno ad usare il pacchetto Office2017", 5, $time1S, $time1E, 2, "DEFAULT", "via pia", 86.51, 77.41, "pippo", "INFORMATICA");
	updataInto_ShareYourJobsTime('Receiver','kenny' , 1);
	
	insertInto_ShareYourJobsTime("Riparo tubature e condotti idraulici tra cui impianti di irrigazione", 20, $time2S, $time2E, 4, "DEFAULT", "corso ricci", 12.39, 36.88, "kenny", "IDRAULICA");
	updataInto_ShareYourJobsTime('Receiver', 'pippo', 2);
	
	insertInto_ShareYourJobsTime("Insegno a fare gli aquiloni", 10, $time3S, $time3E, 1, "DEFAULT", "via XX settembre", 15.53, 44.57, "pippo", "FAI DA TE");
	updataInto_ShareYourJobsTime('Receiver', 'kenny', 3);
	
	insertInto_ShareYourJobsTime("Taglio il prato e gli alberi che ostacolano la strada", 50, $time4S, $time4E, 10, "DEFAULT", "via ferragiana", 66.45, 39.74, "pippo", "GIARDINAGGIO");
	insertInto_ShareYourJobsTime("Preparo pranzo a domicilio", 15, $time5S, $time5E, 1, "DEFAULT", "corso viglienzoni", 7.56, 8.94, "kenny", "CUCINA");
	insertInto_ShareYourJobsTime("Lavo le scale negli appartamenti", 60, $time6S, $time6E, 2, "DEFAULT", "via gramsci", 55.99, 23.31, "pippo", "LAVAGGIO");

	
	insertInto_ShareYourJobsTime("Lavo le scale negli appartamenti1", 60, $time7S, $time7E, 2, "DEFAULT", "via gramsci", 55.99, 23.31, "pippo", "LAVAGGIO");
	updataInto_ShareYourJobsTime('Receiver', 'kenny', 7);
	updataInto_ShareYourJobsTime('Evaluation', 5, 7);

	insertInto_ShareYourJobsTime("Lavo le scale negli appartamenti2", 60, $time8S, $time8E, 2, "DEFAULT", "via gramsci", 55.99, 23.31, "kenny", "LAVAGGIO");
	insertInto_ShareYourJobsTime("Lavo le scale negli appartamenti3", 60, $time7S, $time7E, 2, "DEFAULT", "via gramsci", 55.99, 23.31, "kenny", "LAVAGGIO");
	
	insertInto_ShareYourJobsTime("Lavo le scale negli appartamenti4", 60, $time7S, $time7E, 2, "DEFAULT", "via gramsci", 55.99, 23.31, "kenny", "LAVAGGIO");
	updataInto_ShareYourJobsTime('Receiver', 'pippo', 10);
	updataInto_ShareYourJobsTime('Evaluation', 4, 10);

	insertInto_ShareYourJobsTime("Lavo le scale negli appartamenti5", 60, $time7S, $time7E, 2, "DEFAULT", "via gramsci", 55.99, 23.31, "pippo", "LAVAGGIO");
	updataInto_ShareYourJobsTime('Receiver', 'kenny', 11);
