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
				WHERE active = 1 AND id_dep = ".$iddep."
				ORDER BY sort";

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
//	public function getCatSubsNames($idcat){
//		
//		$SQL = "SELECT id, name FROM catsub
//				WHERE active = 1 AND id_cat = ".$idcat;
//		
//		$RES = $this->_db->query($SQL);
//		DebugSQL($SQL, $RES);
//		
//		while($row = $RES->fetch_assoc()){
//			$ROW[] = $row;
//		}
//		
//	return $ROW;		
//	}
	
	
	/**
	 * 
	 * na podstawie subkategorii pobiera x id'kow plikow
	 * @param int $idsubcat -- id subcat
	 * @param int $limit -- limit pobranych plikow
	 */
	public function getFiles($idsubcat,$limit){

		$SQL = "SELECT id
				FROM files
				WHERE active = 1 AND id_cat = ".$idsubcat."
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
			
		$SQL = "SELECT id, name, id_subcat, title
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
	
	
	public function htmlListFiles($idcat,$namecat){
	$url = ModRewrite('c', $idcat, $namecat);
		
	$html = '<div class="boxS boxSG" style="margin-top: 10px;">
				<div class="title boxStG"><a href="'.$url.'">'.$namecat.'</a></div>
					<div class="body">
				 		<div class="img" style="margin: 0 auto;">
				 			<a href="'.$this->_dirImg.'big/'.$this->_id.'.jpg"><img src="'.$this->_dirImg.''.$this->_id.'_s.jpg" border="0" /></a>
				 		</div>
				 		<div class="advertisement">reklama</div>
				 		<div class="button" id="'.$this->_name.'"><a href="'.$this->_dirFiles.$this->_name.'">Pobierz</a></div>
				 		<div class="advertisement">reklama</div>
					</div>
			</div>';
	
	return $html;
	}

	public function htmlListFiles2($idcat,$namecat){
	
		
	$html = '<div class="body" style="float: left; margin: 0 12px;">
				 		<div class="img" style="margin: 0 auto;">
				 			<a href="'.$this->_dirImg.'big/'.$this->_id.'.jpg"><img src="'.$this->_dirImg.'195/'.$this->_id.'.jpg" border="0" /></a>
				 		</div>
				 		<div class="button" style="padding-top: 15px;" id="'.$this->_name.'"><a href="'.$this->_dirFiles.$this->_name.'">Pobierz</a></div>
			</div>';
	
	return $html;
	}	
	
	public function htmlListFiles3($idcat,$namecat){
	
		
	$html = '<div class="body" style="float: left; margin: 0 25px;">
				 		<div class="img" style="margin: 0 auto;">
				 			<a href="'.$this->_dirImg.'big/'.$this->_id.'.jpg"><img src="'.$this->_dirImg.''.$this->_id.'_s.jpg" border="0" /></a>
				 		</div>
				 		<div class="advertisement">reklama</div>
				 		<div class="button" id="'.$this->_name.'"><a href="'.$this->_dirFiles.$this->_name.'">Pobierz</a></div>
				 		<div class="advertisement">reklama</div>
			</div>';
	
	return $html;
	}
}

?>