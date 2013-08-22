<?php
/*
 * Created on 2011-01-30 by DCCODE
 *
 */
class Tracker {

	private $_db;

	private $_idcatsub 		= NULL;
	private $_catsub 		= NULL;

	private $_idcat 		= NULL;
	private $_cat 			= NULL;

	private $_iddep 		= NULL;
	private $_dep	 		= NULL;


 	/**
 	 * polaczenie z baza danych
 	 */
	function __construct(){
		global $db;

		$this->_db = $db;
	}

	/**
	 * ustawia id subcat
	 */
	public function setIdcatsub($idcatsub){
		$this->_idcatsub = $idcatsub;
	}


	/**
	 * pobierz kat i dep od subcat
	 */
	 public function GetCatAndDep(){

		$SQL = "SELECT cs.id, cs.name,
				       c.id as c_id, c.name as c_name,
				       d.id as d_id, d.name as d_name
				FROM catsub cs
				  LEFT JOIN cat c ON cs.id_dep=c.id
				    LEFT JOIN dep d ON c.id_dep=d.id
				WHERE cs.active = 1 AND cs.id = '$this->_idcatsub'
				ORDER BY cs.sort";

		$RES = $this->_db->query($SQL);
		DebugSQL($SQL, $RES);

		while ($row=$RES->fetch_assoc()){
			$this->_idcat 		= $row['c_id'];
			$this->_cat 		= $row['c_name'];
			$this->_iddep 		= $row['d_id'];
			$this->_dep			= $row['d_name'];

		}
	 }

	 /**
	  * sterownik
	  */
	  public function DriverClean(){

	  	if(isset($this->_idcatsub)){
	  		$this->GetCatAndDep();

	  		$_CLEAN['_idcat'] 		= $this->_idcat;
	  		$_CLEAN['_cat'] 		= $this->_cat;
	  		$_CLEAN['_iddep']	 	= $this->_iddep;
	  		$_CLEAN['_dep'] 		= $this->_dep;

	  	echo $_CLEAN['_dep'];
	  	}

	  }
}
?>
