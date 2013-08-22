<?php
$Pnazwa = 'RozkrecTo.pl';

/*okresla link do strony glownej na podstawie adresu www----------------------------------------*/
if ($_SERVER['HTTP_HOST'] == "startup" || $_SERVER['HTTP_HOST'] == "localhost" || $_SERVER['HTTP_HOST'] == "192.168.2.2"|| $_SERVER['HTTP_HOST'] == "10.18.3.54"){
	$root = "http://startup/";
	$rootNoSlash = "http://startup";

	$dbR=array(
		'komp'	=>	"*",
		'user'	=>	"*",
		'pass'	=>	"*",
		'baza'	=>	"*"
	);
}

elseif($_SERVER['HTTP_HOST'] == "rozkrecto.pl" || $_SERVER['HTTP_HOST'] == "www.rozkrecto.pl" || $_SERVER['HTTP_HOST'] == "94.152.8.53"){
	$root = "http://www.rozkrecto.pl/";
	$rootNoSlash = "http://www.rozkrecto.pl";


	$dbR=array(
		"komp"	=>	"*",
		"user"	=>	"*",
		"pass"	=>	"*",
		"baza"	=>	"*"
	);
}
/*----------------------------------------------------------------------------------------------*/
?>
