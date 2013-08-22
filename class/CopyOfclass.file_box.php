<?php
class FileBox {
	
	private $_db;
	
	private $_id;
	private $_name;
	private $_title;
	private $_id_subcat;
	
	private $_dirImg 	= '/module/dopobrania/files/img/';
	private $_dirFiles 	= '/module/dopobrania/files/';
	
	function __construct(){
		global $db;

		$this->_db = $db;
	}
	
	
	/**
	 * 
	 * pobiera nazwy kategorii na podstawie id dep
	 * @param int $iddep -- id dep
	 * @return array $ROW -- zwraca tablice z nazwami oraz idikami
	 */
	public function getCatsName($iddep){
		
		$SQL = "SELECT id,name FROM cat
				WHERE active = 1 AND id_dep = ".$iddep;

		$RES = $this->_db->query($SQL);
		DebugSQL($SQL, $RES);
		
		while($row = $RES->fetch_assoc()){
			$ROW[] = $row;
		}
		
	return $ROW;
	}
	
	
	/**
	 * 
	 * pobiera nazwy i id subcategorii
	 * @param int $idcat
	 * @return array $ROW -- zwraca tablice z nazwami oraz idikami
	 */
	public function getCatSubsNames($idcat){
		
		$SQL = "SELECT id, name FROM catsub
				WHERE active = 1 AND id_cat = ".$idcat;
		
		$RES = $this->_db->query($SQL);
		DebugSQL($SQL, $RES);
		
		while($row = $RES->fetch_assoc()){
			$ROW[] = $row;
		}
		
	return $ROW;		
	}
	
	
	/**
	 * 
	 * na podstawie subkategorii pobiera x id'kow plikow
	 * @param int $idsubcat -- id subcat
	 * @param int $limit -- limit pobranych plikow
	 */
	public function getFiles($idsubcat,$limit){

		$SQL = "SELECT id
				FROM files
				WHERE active = 1 AND id_subcat = ".$idsubcat."
				LIMIT ".$limit;

		$RES = $this->_db->query($SQL);
		DebugSQL($SQL, $RES);
		
		while($row = $RES->fetch_assoc()){
			$ROW[] = $row['id'];
		}
		
	return $ROW;	
	}
	
	
	/**
	 * 
	 * pobiera dane jednego pliku oraz ustawia zmienne prywatne
	 * 
	 */
	public function getDataFile($id){
			
		$SQL = "SELECT name, id_subcat, title
				FROM files
				WHERE id = ".$id;
		
		$RES = $this->_db->query($SQL);
		DebugSQL($SQL, $RES);

		$row = $RES->fetch_assoc();
	
		if(count($row) > 0){
			$this->_id 		= $row['id'];
			$this->_name 		= $row['name'];
			$this->_title 		= $row['title']; 
			$this->_id_subcat 	= $row['id_subcat'];
		}
			
	}	
	
	
	public function htmlListFiles($CatName){
	
	$html = '<div class="boxS boxSG" style="margin-top: 10px;">
				<div class="title boxStG">'.$CatName.'</div>
					<div class="body">
						to jest ciało
					</div>
			</div>';
	
	return $html;
	}
	
	
}

?>