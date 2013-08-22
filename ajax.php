<?php
error_reporting(E_ALL);

require 'config.php';
require 'functions.php';
require 'debug.php';
require("class/class.db.php");
require(Xpath('class/class.stats.php'));

$objDB 	= new ClassDB;
$db		= $objDB->ConnectDB();

$objStats = new Stats;

/*zapis statow z pobierania plikow*/
if(!empty($_POST['data'])){

	$data = array('name' => $_POST['data']['0'],
				  'ip' => $_POST['data']['1'],
				  'user_agent' => $_POST['data']['2']);
	

	$objStats->DownloadFilesStats($data);
}
?>