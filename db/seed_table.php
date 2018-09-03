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
	$time9S = date('Y-m-d H:i', strtotime('-4 day +8 hour'));
	$time9E = date('Y-m-d H:i', strtotime('-4 day +10 hour'));

	insertInto_ShareYourTagsTime("INFORMATICA");
	insertInto_ShareYourTagsTime("IDRAULICA");
	insertInto_ShareYourTagsTime("RIPARAZIONI");
	insertInto_ShareYourTagsTime("LAVAGGIO");
	insertInto_ShareYourTagsTime("GIARDINAGGIO");
	insertInto_ShareYourTagsTime("CUCINA");
	insertInto_ShareYourTagsTime("RIPETIZIONI");
	insertInto_ShareYourTagsTime("FAI DA TE");
	insertInto_ShareYourTagsTime("ANIMALI");
	insertInto_ShareYourTagsTime("SITTING");
	
	insertInto_ShareYourUserTime("pippo", "11111111aA!", "Pippo", "Regex", "1234567890", "pippo@aaa.it", "via topolinia 44", "../../profile_imgs/pippo.jpg");
	insertInto_ShareYourUserTime("kenny", "987654321Qq?", "John", "Kennedy", "0987654321", "ken@bbb.it", "corso buenos aires 173", "../../profile_imgs/kenny.jpg");
	insertInto_ShareYourUserTime("ironman55", "Iam1ronM@n", "Tony", "Stark", "5791284523", "stark@industries.usa", "Via Dodecaneso", "../../profile_imgs/ironman55.jpg");
	insertInto_ShareYourUserTime("theQueen", "bohem1An/Rap", "Freddie", "Mercury", "8724689105", "brian@may.uk", "Corso Europa", "../../profile_imgs/theQueen.jpg");


	
	insertInto_ShareYourJobsTime("Insegno ad usare il pacchetto Office2017", 5, $time1S, $time1E, 2, "DEFAULT", "Via Fereggiano", 44.4167606, 8.961800900000071, "pippo", "INFORMATICA");
	//updataInto_ShareYourJobsTime('Receiver','kenny' , 1);
	
	insertInto_ShareYourJobsTime("Riparo tubature e condotti idraulici tra cui impianti di irrigazione", 20, $time2S, $time2E, 4, "DEFAULT", "Via Sturla", 44.3999293, 8.978978999999981, "kenny", "IDRAULICA");
	updataInto_ShareYourJobsTime('Receiver', 'pippo', 2);
	
	insertInto_ShareYourJobsTime("Insegno a fare gli aquiloni", 10, $time3S, $time3E, 2, "DEFAULT", "Corso Alessandro de Stefanis, Genoa, Metropolitan City of Genoa, Italy", 44.4167606, 8.952091800000062, "pippo", "FAI DA TE");
	//updataInto_ShareYourJobsTime('Receiver', 'kenny', 3);
	
	insertInto_ShareYourJobsTime("Taglio il prato e gli alberi che ostacolano la strada", 50, $time4S, $time4E, 10, "DEFAULT", "Via Giovanni Amarena, Genoa, Metropolitan City of Genoa, Italy", 44.41349769999999, 8.95928189999995, "pippo", "GIARDINAGGIO");
	insertInto_ShareYourJobsTime("Preparo pranzo a domicilio", 15, $time5S, $time5E, 1, "DEFAULT", "Viale delle Brigate Partigiane", 44.3986179, 8.94487730000003, "kenny", "CUCINA");
	insertInto_ShareYourJobsTime("Lavo le scale negli appartamenti", 60, $time6S, $time6E, 2, "DEFAULT", "Via XX Settembre", 44.4059247, 8.939580200000023, "pippo", "LAVAGGIO");

	
	insertInto_ShareYourJobsTime("Lavo la macchina nei garage in giro per Genova", 40, $time7S, $time7E, 2, "DEFAULT", "Via San Martino", 44.4058381, 8.970980999999938, "pippo", "LAVAGGIO");
	updataInto_ShareYourJobsTime('Receiver', 'kenny', 7);
	updataInto_ShareYourJobsTime('Evaluation', 5, 7);

	insertInto_ShareYourJobsTime("Insegno a preparare le torte dolci", 17, $time8S, $time8E, 2, "DEFAULT", "Via Silvio Lagustena", 44.4065962, 8.976878700000043, "kenny", "CUCINA");
	insertInto_ShareYourJobsTime("Design di siti web e consulenza", 100, $time7S, $time7E, 2, "DEFAULT", "Piazza Dante", 44.4052777, 8.935792699999979, "kenny", "INFORMATICA");
	
	insertInto_ShareYourJobsTime("Incontro di patchwork", 5, $time7S, $time7E, 2, "DEFAULT", "Corso Torino", 44.4013028, 8.950326099999984, "kenny", "FAI DA TE");
	updataInto_ShareYourJobsTime('Receiver', 'pippo', 10);
	updataInto_ShareYourJobsTime('Evaluation', 4, 10);

	insertInto_ShareYourJobsTime("Riparo i motorini e le biciclette", 85, $time7S, $time7E, 2, "DEFAULT", "Via Casaregis", 44.4048195, 8.952552800000035, "pippo", "RIPARAZIONI");
	updataInto_ShareYourJobsTime('Receiver', 'kenny', 11);






	insertInto_ShareYourUserTime("br3nd3r", "123456789qQ?", "Eugenio", "Brandi", "3495855439", "brender@gmail.com", "Via Fereggiano, Genova GE, Italy", "../../profile_imgs/br3nd3r.jpg");
	insertInto_ShareYourJobsTime("Ripetizioni DataWhereHouse", 10, $time1S, $time1E, 4, "DEFAULT", "Via Fereggiano, Genova GE, Italy", 44.416761, 8.961533700000018, "br3nd3r", "RIPETIZIONI");
	insertInto_ShareYourJobsTime("Manutenzione orti, prati e taglio legna", 100, $time2S, $time2E, 50, "DEFAULT", "16049 La Villa GE, Italy", 44.5274689, 9.43983609999998, "br3nd3r", "FAI DA TE");
	insertInto_ShareYourJobsTime("Abbellimento giardini privati", 25, $time3S, $time3E, 15, "DEFAULT", "Corso Alessandro de Stefanis, Genova GE, Italy", 44.4167606, 8.952091800000062, "br3nd3r", "FAI DA TE");
	insertInto_ShareYourJobsTime("Assistenza uno personal computer", 50, $time4S, $time4E, 10, "DEFAULT", "Via Giovanni Amarena, 16143 Genova GE, Italy", 44.41349769999999, 8.95928189999995, "br3nd3r", "INFORMATICA");
	insertInto_ShareYourJobsTime("Preparo pranzo a domicilio", 15, $time5S, $time5E, 1, "DEFAULT", "Via Armando Diaz, Genova GE, Italy", 44.4015968, 8.944812700000057, "br3nd3r", "CUCINA");
	insertInto_ShareYourJobsTime("Lavaggio auto privati", 80, $time6S, $time6E, 100, "DEFAULT", "Genoa, Metropolitan City of Genoa, Italy", 44.44662539999999, 9.145615300000031, "br3nd3r", "LAVAGGIO");
	insertInto_ShareYourJobsTime("Ripetizioni informatica universitarie", 70, $time7S, $time7E, 2, "DEFAULT", "Via XX Settembre, 16121 Genova GE, Italy", 44.40570270000001, 8.939600799999994, "br3nd3r", "INFORMATICA");
	insertInto_ShareYourJobsTime("Tengo bambini", 35, $time8S, $time8E, 2, "DEFAULT", "Via Silvio Lagustena, Genova GE, Italy", 44.40664820000001, 8.976895900000045, "br3nd3r", "SITTING");
	insertInto_ShareYourJobsTime("Accudisco cani", 55, $time9S, $time9E, 2, "DEFAULT", "Genoa, Metropolitan City of Genoa, Italy", 44.44662539999999, 9.145615300000031, "br3nd3r", "ANIMALI");

