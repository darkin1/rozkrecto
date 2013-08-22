<?php
class Stats{
	
	private $_db;
	
	
	function __construct(){
		global $db;

		$this->_db = $db;
	}	
	
	
	public function DownloadFilesStats($data){
		
		$data['name'] 		= mysqli_real_escape_string($this->_db, $data['name']);
		$data['ip'] 		= mysqli_real_escape_string($this->_db, $data['ip']);
		$data['user_agent'] = mysqli_real_escape_string($this->_db, $data['user_agent']);
		
		$SQL = 'INSERT INTO files_stats VALUES (null, null, "'.$data['name'].'", "'.$data['ip'].'", "'.$data['user_agent'].'");';
				
		
		$RES = $this->_db->query($SQL);
		DebugSQL($SQL, $RES);

	return $RES;
	}
}

?>