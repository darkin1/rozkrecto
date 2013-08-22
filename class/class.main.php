<?php
class Main {
	
	private $_db;
	
	function __construct(){
		global $db;

		$this->_db = $db;
	}
	
	
	public function getNewFeeds(){
		
		$SQL = "SELECT id, pubdate, it_title
				FROM agr
				ORDER BY id DESC
				LIMIT 10;";
		
		$RES = $this->_db->query($SQL);
		DebugSQL($SQL, $RES);

		while ($row = $RES->fetch_assoc()){
			$ROW[] = $row;
		}

	return $ROW;
	}
}

?>