<?php
/*
 * Created on 2011-02-01 by DCCODE
 *
 */
 set_time_limit(0);
include("class.agregator_feed_reader.php");

class Agregator extends feedReader{


	private $_db;

	var $data;

//	private $_m_id				= NULL; //id rekordu
	private $_m_idwww; 					//id strony www np. wystartowali.pl
	private $_m_namewww; 				//strona www np. wystartowali.pl (bez http://)
	private $_m_date; 					//data wstawienia rekordu do bazy danych
	private $_m_active			= 1; 	//1-aktywy rekord, 0-nieaktywny
	private $_m_pubdate			= NULL; //przerobienie it_pubdate na postac 2011-01-01 00:00:00

	private $_ch_title;
	private $_ch_link;

	private $_i_link 			= NULL;
	private $_i_height 			= NULL;
	private $_i_width 			= NULL;
	private $_i_url 			= NULL;
	private $_i_title			= NULL;

	private $_it_title;
	private $_it_link;
	private $_it_description	= NULL;
	private $_it_pubdate		= NULL;




	function __construct($url){
		global $db;

		$this->_db = $db;

		$this->setFeedUrl($url);
		$this->parseFeed();
		$this->data = $this->getFeedOutputData();
	}
//********************* DOODAWANIE GLOWNYCH DANYCH **********************************
	public function setIdWww($idwww){
		$this->_m_idwww = (int)$idwww;
	}

	public function setNameWww($namewww){
		$this->_m_namewww = mysqli_real_escape_string($this->_db,$namewww);
	}

	private function setActive(){
		$this->_m_active = 1;
	}

	private function getDatee(){
		$this->_m_date = date("Y-m-d H:i:s");
	}

	private function BuildDate($date){//przerobienie daty
		$a=strtotime($date);
	return date("Y-m-d H:i:s",$a);
	}
//********************* CHANNEL **********************************
	private function getChannelTitle(){
		$this->_ch_title = $this->data['channel']['title'];
	}

	private function getChannelTitleLink(){
		$this->_ch_link = $this->data['channel']['link'];
	}


//********************* IMAGE *****************************
	private function getImageLink(){
		$this->_i_link = (isset($this->data['image']['link']) ? $this->data['image']['link'] : "");
	}

	private function getImageHeight(){
		$this->_i_height = (isset($this->data['image']['height']) ? $this->data['image']['height'] : "");
	}

	private function getImageWidth(){
		$this->_i_width = (isset($this->data['image']['width']) ? $this->data['image']['width'] : "");
	}

	private function getImageUrl(){
		$this->_i_url = (isset($this->data['image']['url']) ? $this->data['image']['url'] : "");
	}

	private function getImageTitle(){
		$this->_i_title = (isset($this->data['image']['title']) ? $this->data['image']['title'] : "");
	}

//*********************** ITEM ****************************
	private function getItemTitle($item){
		$this->_it_title =  mysqli_real_escape_string($this->_db,$this->data['item']['title'][$item]);
	}

	private function getItemTitleLink($item){
		$this->_it_link = $this->data['item']['link'][$item];
	}

	private function getItemDescription($item){
		$this->_it_description = (isset($this->data['item']['description'][$item]) ? mysqli_real_escape_string($this->_db,$this->data['item']['description'][$item]) : "");
	}

	private function getItemDescription2($item){//dla antyweb.pl
		$this->_it_description = (isset($this->data['item']['content:encoded'][$item]) ? mysqli_real_escape_string($this->_db,$this->data['item']['content:encoded'][$item]) : "");
	}

	private function getItemPubdate($item){
		$a = (isset($this->data['item']['pubdate'][$item]) ? $this->data['item']['pubdate'][$item] : "");
	return $a;
	}




	/**
	 * pobiera liczbe feedow
	 */
	public function getNumberOfNews(){
		return $this->getFeedNumberOfNodes();
	}

	/**
	 * pobiera title -  starsze feedy do sprawdzenia
	 * limit okresla ile ma byc sprawdzanych feedow
	 */
	public function GetOldFeed($idwww){

		$SQL = "SELECT ch_title, it_title, pubdate, it_link
				FROM agr
					WHERE idwww = '$idwww'
					ORDER BY id DESC
				LIMIT 200;";

		$RES = $this->_db->query($SQL);
		DebugSQL($SQL, $RES);

		while ($row = $RES->fetch_assoc()){
//			$ROW[] = $row['pubdate'];
			$ROW[] = $row['it_link'];
		}

	return $ROW;
	}

	/**
	 * pakuje dane o feed'zie do bazy danych
	 *
	 */
	public function InsertData($item){

		$this->getDatee();
		$this->setActive();

		$this->getChannelTitle();
		$this->getChannelTitleLink();

		$this->getImageLink();
		$this->getImageHeight();
		$this->getImageWidth();
		$this->getImageUrl();
		$this->getImageTitle();

		$this->getItemTitle($item);
		$this->getItemTitleLink($item);
		if($this->_m_idwww == 1){$this->getItemDescription2($item);}else{$this->getItemDescription($item);}
		$this->_it_pubdate = $this->getItemPubdate($item);

		$this->_m_pubdate = $this->BuildDate($this->_it_pubdate);



		$SQL = "INSERT INTO agr VALUES ( NULL, '$this->_m_idwww', '$this->_m_namewww', '$this->_m_date', '$this->_m_active',
										'$this->_ch_title', '$this->_ch_link',
										'$this->_i_link', '$this->_i_height', '$this->_i_width', '$this->_i_url', '$this->_i_title',
										'$this->_it_title', '$this->_it_link', '$this->_it_description', '$this->_it_pubdate', '$this->_m_pubdate')";

		$RES = $this->_db->query($SQL);
		DebugSQL($SQL, $RES);
	return $RES;
	}


	/**
	 * wpisuje do bazy feedy ktorych nie ma
	 */
	public function Engine($idwww){
		$filename = 'raport.txt';

		$nn = $this->getNumberOfNews();//policz ile jest feedow w rss
		$arrOldFeed = $this->GetOldFeed($idwww);//pobierz 20 ostatnio dodanych feedow do bazy
		$arrOldFeed = (is_array($arrOldFeed) ? $arrOldFeed : array());//jezeli nie ma wpisow to przerob na pusta tablice(brak w tedy warningow)

		$z=0;
		for($i=0;$i<$nn;$i++){
//			$pd = $this->getItemPubdate($i);//pobierz date z feeda z rss
//			$mpd = $this->BuildDate($pd);
			$this->getItemTitleLink($i);//ustawiam title
			$mpd = $this->_it_link;//pobieram title

		
//echo $mpd. '<br />';
			if(!in_array($mpd, $arrOldFeed)){//jesli obecnie pobranej daty z feeda z rss nie ma w bazie to zapisz nowego feeda
				$r= $this->InsertData($i);
				deb($r);
				echo $mpd.' <br />';
				$z++;

				$d .= "- ".$this->_it_title."\n";//dopisanie tekstu do raportu
			};
		}

		/*tworzenie raportu*/
		$date = date("Y-m-d H:i:s");
		$data = $date."\n";
		$data .= "----------------------\n";
		$data .= "Id www: ".$idwww."\n";
		$data .= "Dodano nowych feedow: ".$z."\n\n";
		$data .= $d;
		$data .= "=============================================================\n";
		file_put_contents($filename, $data, FILE_APPEND);
	}
}
?>
