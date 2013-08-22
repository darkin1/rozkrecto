<?php
/*
 * Created on 2011-01-30 by DCCODE
 *
 * ustawia tablice $_CLEAN[]
 */

class Clean {

	private $_db;

	private $_site			= NULL; //jaka strona d,c,cs

	private $_iddep 		= NULL; //id dep
	private $_dep	 		= NULL; //nazwa dep z wywalonymi polskimi znakami, male litery
	private $_dep_n			= NULL; //nazwa dep z duzymi literami, literami polskimi (wyciagane z bazy)

	private $_idcat 		= NULL;
	private $_cat 			= NULL;
	private $_cat_n			= NULL;

	private $_idcatsub 		= NULL;
	private $_catsub 		= NULL;
	private $_catsub_n		= NULL;

	private $_idfile 		= NULL;
	private $_file	 		= NULL;
	private $_file_n		= NULL;	
	
	private $_page			= NULL; //numer podstrony
	
	private $_url			= NULL; //url strony


 	/**
 	 * polaczenie z baza danych
 	 */
	function __construct(){
		global $db;

		$this->_db = $db;

		$this->_site		= (isset($_GET['site']) 	? seostring($_GET['site']) 	: NULL);

		$this->_iddep 		= (isset($_GET['iddep']) 	? (int)$_GET['iddep'] 			: NULL);
		$this->_dep 		= (isset($_GET['dep']) 		? seostring($_GET['dep']) 		: NULL);
		$this->_dep_n;

		$this->_idcat 		= (isset($_GET['idcat']) 	? (int)$_GET['idcat'] 			: NULL);
		$this->_cat  		= (isset($_GET['cat']) 		? seostring($_GET['cat']) 		: NULL);
		$this->_cat_n;

		$this->_idcatsub 	= (isset($_GET['idcatsub']) ? (int)$_GET['idcatsub'] 		: NULL);
		$this->_catsub 		= (isset($_GET['catsub']) 	? seostring($_GET['catsub']) 	: NULL);
		$this->_catsub_n;
		
		$this->_idfile 		= (isset($_GET['idfile']) 	? (int)$_GET['idfile'] 			: NULL);
		$this->_file 		= (isset($_GET['file']) 	? seostring($_GET['file']) 	: NULL);
		$this->_file_n;
		
		$this->_page 		= (isset($_GET['page'])		? (int)$_GET['page'] 			: NULL);
	}

//	/**
//	 * ustawia site
//	 */
//	public function setSite($site){
//		$this->_site = $site;
//	}

	/**
	 * pobierz kat i dep od subcat oraz 'catsub_n'
	 */
	 private function GetCatAndDep(){

		$SQL = "SELECT cs.name as cs_name,
					   c.id as c_id, c.name as c_name,
				       d.id as d_id, d.name as d_name
				FROM catsub cs
				  LEFT JOIN cat c ON cs.id_cat=c.id
				    LEFT JOIN dep d ON c.id_dep=d.id
				WHERE cs.active AND cs.id = ".$this->_idcatsub;

		$RES = $this->_db->query($SQL);
		DebugSQL($SQL, $RES);

		while ($row=$RES->fetch_assoc()){
			$this->_idcat 		= $row['c_id'];
			$this->_cat 		= seostring($row['c_name']);
			$this->_cat_n 		= $row['c_name'];
			$this->_iddep 		= $row['d_id'];
			$this->_dep			= seostring($row['d_name']);
			$this->_dep_n		= $row['d_name'];
			$this->_catsub_n	= $row['cs_name'];

		}
	 }


	/**
	 * pobiera dane dep na podstawie cat oraz pobierz '_cat_n'
	 */
	private function GetDep(){

		$SQL = "SELECT d.id as d_id, d.name as d_name,
					   c.name as c_name
				FROM cat c
				  LEFT JOIN dep d ON c.id_dep=d.id
				WHERE c.active = 1 AND c.id = ".$this->_idcat;

		$RES = $this->_db->query($SQL);
		DebugSQL($SQL, $RES);

		while ($row=$RES->fetch_assoc()){
			$this->_iddep 		= $row['d_id'];
			$this->_dep			= seostring($row['d_name']);
			$this->_dep_n		= $row['d_name'];
			
			$this->_cat_n 		= $row['c_name'];
		}
	}


	/**
	 * pobiera nazwe dep na podstawie id dep
	 */
	private function GetDepName(){

		$SQL = "SELECT name FROM dep WHERE id = ".$this->_iddep;

		$RES = $this->_db->query($SQL);
		DebugSQL($SQL, $RES);

		while ($row=$RES->fetch_assoc()){
			$this->_dep_n	= $row['name'];
		}
	}

	
	private function GetCatAndSubCatByIdDepAndFile(){

		switch($this->_iddep){
			case 1:
				$SQL = "SELECT  cs.id as cs_id, cs.name as cs_name,
								c.id as c_id, c.name as c_name,
								f.title as f_file_n
						FROM files f
						LEFT JOIN catsub cs ON f.id_subcat = cs.id
							LEFT JOIN cat as c ON cs.id_cat = c.id
						WHERE f.id = ".$this->_idfile;
				break;
				
			case 2:
				$SQL = "SELECT  cs.id as cs_id, cs.name as cs_name,
								c.id as c_id, c.name as c_name,
								f.it_title as f_file_n
						FROM agr f
						LEFT JOIN catsub cs ON f.idwww = cs.id
							LEFT JOIN cat as c ON cs.id_cat = c.id
						WHERE f.id = ".$this->_idfile;
				break;

			/**
			 * dla kolejnego modulu dopisac kolejny wyjatek
			 */
			default:
				/*to samo co pod '1'*/
				$SQL = "SELECT  cs.id as cs_id, cs.name as cs_name,
								c.id as c_id, c.name as c_name,
								f.title as f_file_n
						FROM files f
						LEFT JOIN catsub cs ON f.id_subcat = cs.id
							LEFT JOIN cat as c ON cs.id_cat = c.id
						WHERE f.id = ".$this->_idfile;
				break;				
			
		}

		$RES = $this->_db->query($SQL);
		DebugSQL($SQL, $RES);

		$row=$RES->fetch_assoc();
		

		if(count($row)>0){
			$this->_idcatsub		= $row['cs_id'];
			$this->_catsub			= seostring($row['cs_name']);
			$this->_catsub_n		= $row['cs_name'];
			
			$this->_idcat			= $row['c_id'];
			$this->_cat				= seostring($row['c_name']);
			$this->_cat_n			= $row['c_name'];
			
			$this->_file_n			= $row['f_file_n'];//pamietac aby w zapytaniu zawsze istnialo takie pole (tzn aby tak je nazwa po przez komende AS)
		}	
	}
	
	
	/*tworzy url obecnej strony*/
	private function GetUrl(){
		$this->_url = 'http://'.$_SERVER['HTTP_HOST'];
	}
	
	 /**
	  * sterownik w zaleznosci od $site
	  * (czyli od tego w ktorym miejscu na stronie jestesmy)
	  */
	  public function DriverClean(){

			$_CLEAN['_site']	 	= NULL;
			
	  		$_CLEAN['_iddep']	 	= NULL;
	  		$_CLEAN['_dep'] 		= NULL;
	  		$_CLEAN['_dep_n'] 		= NULL;
	  		
	  		$_CLEAN['_idcat'] 		= NULL;
	  		$_CLEAN['_cat'] 		= NULL;
	  		$_CLEAN['_cat_n'] 		= NULL;
	  		
	  		$_CLEAN['_idcatsub'] 	= NULL;
	  		$_CLEAN['_catsub'] 		= NULL;
	  		$_CLEAN['_catsub_n']	= NULL;
	  		
	  		$_CLEAN['_idfile'] 		= NULL;
	  		$_CLEAN['_file'] 		= NULL;
	  		$_CLEAN['_file_n']		= NULL;
	  		
	  		$_CLEAN['_page'] 		= NULL;
	  		
	  		$_CLEAN['_url'] 		= NULL;


	  		$this->GetUrl();//tworze poczatek url strony
	  		
		  	if(isset($this->_site) && $this->_site=='d'){
				$this->GetDepName();
				$this->_url .= '/d/'.$this->_iddep.'-'.$this->_dep;//tworzenie url - koncowa
		  	}
		  	if(isset($this->_site) && $this->_site=='c'){
				$this->GetDep();
				$this->_url .= '/c/'.$this->_idcat.'-'.$this->_cat;//tworzenie url - koncowa
		  	}
			if(isset($this->_site) && $this->_site=='cs'){
		  		$this->GetCatAndDep();
		  		$this->_url .= '/cs/'.$this->_idcatsub.'-'.$this->_catsub;//tworzenie url - koncowa
		  	}
		  	if(isset($this->_site) && $this->_site == 'd' && !empty($_GET['idfile'])){
		  		$this->GetCatAndSubCatByIdDepAndFile();
		  	}
		  	
		  	

			$_CLEAN['_site'] 		= $this->_site;
			
	  		$_CLEAN['_idcat'] 		= $this->_idcat;
	  		$_CLEAN['_cat'] 		= $this->_cat;
	  		$_CLEAN['_cat_n'] 		= htmlspecialchars($this->_cat_n);
	  		
	  		$_CLEAN['_iddep']	 	= $this->_iddep;
	  		$_CLEAN['_dep'] 		= $this->_dep;
	  		$_CLEAN['_dep_n'] 		= htmlspecialchars($this->_dep_n);
	  		
		  	$_CLEAN['_idcatsub'] 	= $this->_idcatsub;
	  		$_CLEAN['_catsub'] 		= $this->_catsub;
	  		$_CLEAN['_catsub_n'] 	= htmlspecialchars($this->_catsub_n);

		  	$_CLEAN['_idfile'] 		= $this->_idfile;
	  		$_CLEAN['_file'] 		= $this->_file;
	  		$_CLEAN['_file_n'] 		= htmlspecialchars($this->_file_n);	  		
	  		
	  		$_CLEAN['_page'] 		= $this->_page;
	  		
	  		$_CLEAN['_url'] 		= $this->_url;

	return $_CLEAN;
	}
}
?>
