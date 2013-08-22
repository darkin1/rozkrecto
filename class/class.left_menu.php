<?php
/*
 * Created on 2011-01-30 by DCCODE
 *
 */

class LeftMenu {

	private $_db;
	private	$_iddep 		= NULL; //id departamentu
	private $_arrCats 		= array(); //lista kategorii
	private $_arrSubCats	= array(); //lista subkategorii


 	/**
 	 * polaczenie z baza danych
 	 */
	function __construct(){
		global $db;

		$this->_db = $db;
	}

	/**
	 * ustawia id dep
	 */
	public function setIddep($iddep){
		$this->_iddep = $iddep;
	}



	/**
	 * pobiera kategorie dla departamentu
	 */
	private function GetCategoryByDep(){

		$SQL = "SELECT id, name, id_dep, normal
				FROM cat
				WHERE active = 1 AND id_dep = '$this->_iddep'
				ORDER BY sort";

		$RES = $this->_db->query($SQL);
		DebugSQL($SQL, $RES);

		while ($row=$RES->fetch_assoc()){
			$this->_arrCats[]=$row;
		}
	}


	/**
	 * pobiera subkategorie dla kategorii
	 */
	 private function GetSubcatByCategory($idcat){

		$SQL = "SELECT id, name
				FROM catsub
				WHERE active = 1 AND id_cat = '$idcat'
				ORDER BY sort";


		$RES = $this->_db->query($SQL);
		DebugSQL($SQL, $RES);

		while ($row=$RES->fetch_assoc()){
			$ROW[]=$row;
		}
	 return $ROW;
	 }

	/**
	 * tworzy html'a z kategoriamii
	 */
	public function GenerateHtmlMenu(){
		global $_CLEAN;
		$this->GetCategoryByDep();//pobiera kategorie


		foreach($this->_arrCats as $cat){

			/*pobiera subkategorie*/
			$arrSubCats = $this->GetSubcatByCategory($cat['id']);
			$arrSubCats = (is_array($arrSubCats) ? $arrSubCats : array());
				foreach($arrSubCats as $subCats){
					$style = ($_CLEAN['_idcatsub']==$subCats['id'] ? 'style="background-color: #C6D1E6"' : '');
					$urlSubCat = ModRewrite('cs',$subCats['id'],$subCats['name']);/*tworzenie url*/

					$htmlSub .= '<li '.$style.'><a href="'.$urlSubCat.'">'.$subCats['name'].'</a></li>';/*tworzenie linka*/
				}


			/*tworzenie titla*/
			$title = ($cat['normal'] == 0 ? $cat['name'] : '<a href="'.ModRewrite('c',$cat['id'],$cat['name']).'">'.$cat['name'].'</a>');


			/*tworzenie boxu*/
			$html.='
			<div class="dep-wrap">
					<div class="title">'.$title.'</div>

					<div class="body">
						<ul>'.$htmlSub.'</ul>
					</div>
			</div>';

		unset($htmlSub);
		}

		
	return $html;
	}
}
?>
