<?php
/*
 * Created on 2011-01-28
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

if($_SERVER['HTTP_HOST'] == "startup"){
	error_reporting(E_ALL); //na serv wylaczyc obsluge bledow
}



require_once("config.php");
require_once("debug.php");
require_once("functions.php");
require_once("class/class.db.php");

$start_php = getmicrotime();

$objDB 	= new ClassDB;
$db		= $objDB->ConnectDB();

include("main.php");


if($_SERVER['HTTP_HOST'] == "startup"){
	Debug_Log::display();
}


$end = getmicrotime();
echo '<span style="color: #9094BA; display: none;">'.($end - $start_php).' sekund </span>';
?>
