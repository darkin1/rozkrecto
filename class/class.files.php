<?php
class Files extends FileOne{
	
	private $_db;
	
	
	
	
	function __construct(){
		global $db;

		$this->_db = $db;
	}	
	
	
	
	/**
	 * 
	 * pobiera id'iki plikow z danej subkategorii
	 * @param int $idsubcat -- id subkategorii
	 */
	public function getIdFilesBySubcat($idsubcat, $start, $parePage){
		
		$SQL = "SELECT id, name
				FROM files
				WHERE active = 1 AND id_subcat = ".$idsubcat."
				LIMIT ".$start." , ".$parePage;
		
		$RES = $this->_db->query($SQL);
		DebugSQL($SQL, $RES);

		while ($row = $RES->fetch_assoc()){
			$ROW[] = $row['id'];
		}

		$ROW = (is_array($ROW) ? $ROW : array());
	return $ROW;		
	}
	
	
	
	/**
	 * wyswietla liste plikow
	 * (non-PHPdoc)
	 * @see FileOne::Engine()
	 */
	public function Engine($arrId){
		parent::__construct();
		
		foreach($arrId as $id){
			parent::Engine($id);
		}
	}
}

?>