<?php
class Video {
	
	private $_db;
	private $_parePage = 5; // ile video na jedna strone
	
	public $id_catsub;// id catsub
	public $start; //od ktorego video zaczac pobieranie

	
	
	
	function __construct(){
		global $db;

		$this->_db = $db;
	}
	
	
	/**
	 * 
	 * pobiera paczek video z bazy
	 * @return $ROW array -- zwraca tablice z danymi o video
	 */
	public function getVideos(){
		
		$SQL = 'SELECT id, title, object, `text`, sort
				FROM video
				WHERE active = 1 AND id_catsub = '.$this->id_catsub.'
				ORDER BY sort ASC
				LIMIT '.$this->start.', '.$this->_parePage.';';

		$RES = $this->_db->query($SQL);
		DebugSQL($SQL, $RES);
		
		while($row = $RES->fetch_assoc()){
			$ROW[] = $row;
		}
	return $ROW;
	}

	
	
	/**
	 * 
	 * pobiera paczek video z bazy
	 * @return $ROW array -- zwraca tablice z danymi o video
	 */
	public function getVideosTop(){
		
		$SQL = 'SELECT id, title, object, `text`, sort
				FROM video
				WHERE active = 1
				ORDER BY id DESC
				LIMIT 5;';

		$RES = $this->_db->query($SQL);
		DebugSQL($SQL, $RES);
		
		while($row = $RES->fetch_assoc()){
			$ROW[] = $row;
		}
	return $ROW;
	}	
	
	/**
	 * 
	 * generuje kod html dla jednego video
	 * @param unknown_type $arrVideo
	 */
	public function htmlVideo($arrVideo){
		
		$html = '<div class="box">
				<a name="'.$arrVideo['id'].'"></a>
					<div class="title">'.htmlspecialchars($arrVideo['title']).'</div>
					
					<div class="body">
						<div class="video">'.$arrVideo['object'].'</div>
						<div class="text">'.htmlspecialchars($arrVideo['text']).'</div>
					</div>
				</div>';
	return $html;
	}
}

?>