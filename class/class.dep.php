<?php


class Dep {

	private $_db;


 	/**
 	 * polaczenie z baza danych
 	 */
	function __construct(){
		global $db;

		$this->_db = $db;
	}

	/**
	 * pobierz departamenty
	 */
	public function GetDep(){

		$SQL = "SELECT *
				FROM dep
				WHERE active = 1
				ORDER BY sort";

		$RES = $this->_db->query($SQL);
		DebugSQL($SQL, $RES);

		while ($row=$RES->fetch_assoc()){
			$ROW[]=$row;
		}

	return $ROW;
	}

}
?>
