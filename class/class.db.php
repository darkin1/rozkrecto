<?php
/*
 * Created on 2010-02-01
 *
 *
 */

class ClassDB {


	public function ConnectDB (){

		global $dbR;

		//łączenie z bazą
	 	$db = new mysqli($dbR['komp'],$dbR['user'],$dbR['pass'],$dbR['baza']);
	 	$db->query("SET NAMES 'utf8'");


	//sprawdzanie połaczenia
	 	if (mysqli_connect_errno())
		 {
	 		 echo '<div class="error">Połączenie z baza danych nie powiodlo sie. Sprobuj jeszcze raz pozniej.</div>';
	 		 exit;
		 }
	  return $db;
	}

}
?>
