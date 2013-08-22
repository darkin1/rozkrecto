<?php
class FileOne {
	
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
	 * pobiera dane jednego pliku oraz ustawia zmienne prywatne
	 * 
	 */
	private function getDataFile(){
			
		$SQL = "SELECT name, id_subcat, title
				FROM files
				WHERE id = ".$this->_id;
		
		$RES = $this->_db->query($SQL);
		DebugSQL($SQL, $RES);

		$row = $RES->fetch_assoc();
	
		if(count($row) > 0){
			$this->_name 		= $row['name'];
			$this->_title 		= $row['title']; 
			$this->_id_subcat 	= $row['id_subcat'];
		}
			
	}
	

	/**
	 * 
	 * generuje kod html z widokiem pojedynczego pliku
	 */
	private function htmlFile() {
		global $_CLEAN;

		/* -->reklama */
		$objAdv = new Advertisement;
		/* <--reklama */
		//<div class="name"><a href="'.ModRewrite('f',$_CLEAN['_iddep'],$_CLEAN['_dep'],null,$this->_id,$this->_title).'">'.$this->_title.'</a></div>
		//<div class="name">'.$this->_title.'</div>
		
		$html = '<div class="box">
					<a name="'.$this->_id.'"></a>
				 	<div class="title">
				 		<div class="name">'.$this->_title.'</div>
				 		<div class="data" style="display: none;">Pobrań: 999</div>
				 	</div>
				 	<div class="body">
				 		<div class="img" style="margin: 0 auto;">
				 			<a href="'.$this->_dirImg.'big/'.$this->_id.'.jpg"><img src="'.$this->_dirImg.'195/'.$this->_id.'.jpg" border="0" /></a>
				 		</div>
				 		<div style="height: 20px; padding-top: 10px;">'.$objAdv->AdvTextFilesHorizon().'</div>
				 		<div class="button" id="'.$this->_name.'"><a href="'.$this->_dirFiles.$this->_name.'">Pobierz</a></div>
				 	</div>
				 </div>';
	return $html;
	}
	
	/**
	 * 
	 * logika dzialania
	 * @param int $id -- id pliku
	 */
	public function Engine($id){

		$this->_id = $id;
		$this->getDataFile();
	 	$html = $this->htmlFile();
	 	
	echo $html;
	}
}

?>
