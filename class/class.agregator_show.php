<?php
/*
 * Created on 2011-02-06 by DCCODE
 *
 */

class AgrFeed{

	private $_db;
	private $_feed	= array();


	function __construct(){
		global $db;

		$this->_db = $db;
	}


	/**
	 * pobiera x feedow
	 */
	public function getFeedData($start, $ile){

		$SQL = "SELECT id, namewww, ch_link, it_title, it_link, it_description, pubdate
				FROM agr
				ORDER BY id DESC
				LIMIT $start, $ile;";

		$RES = $this->_db->query($SQL);
		DebugSQL($SQL, $RES);

		while ($row = $RES->fetch_assoc()){
			$ROW[] = $row;
		}

	return $ROW;
	}

	/**
	 * pobiera x feedow
	 */
	public function getFeedDataCat($start, $ile, $id){

		$SQL = "SELECT agr.id, agr.namewww, agr.ch_link, agr.it_title, agr.it_link, agr.it_description, agr.pubdate
				FROM agr
					JOIN catsub as cs ON cs.id=agr.idwww
				WHERE cs.id_cat = '$id'
				ORDER BY agr.id DESC
				LIMIT $start, $ile;";

		$RES = $this->_db->query($SQL);
		DebugSQL($SQL, $RES);

		while ($row = $RES->fetch_assoc()){
			$ROW[] = $row;
		}

	return $ROW;
	}	
	
	/**
	 * pobiera x feedow
	 */
	public function getFeedDataSubCat($start, $ile, $id){

		$SQL = "SELECT id, namewww, ch_link, it_title, it_link, it_description, pubdate
				FROM agr
				WHERE idwww = '$id'
				ORDER BY id DESC
				LIMIT $start, $ile;";

		$RES = $this->_db->query($SQL);
		DebugSQL($SQL, $RES);

		while ($row = $RES->fetch_assoc()){
			$ROW[] = $row;
		}

	return $ROW;
	}		
	
	private function ImgAgr($site){
		
		switch($site){
			
			case 'antyweb.pl' :
				$img = 'antyweb.jpg';
				break;
			case 'wystartowali.pl' :
				$img = 'wystartowali.jpg';
				break;
			case 'mambiznes.pl' :
				$img = 'mambiznes.jpg';
				break;
			case 'startups.pl' :
				$img = 'startups.jpg';
				break;
			case 'startopia.pl' :
				$img = 'startopia.jpg';
				break;
			case 'startupy.com.pl' :
				$img = 'startupycom.jpg';
				break;
			case 'inwestycje.pl' :
				$img = 'inwestycje.jpg';
				break;
			case 'killerstartups.com' :
				$img = 'killerstartups.jpg';
				break;
			case 'startuplift.com' :
				$img = 'startuplift.jpg';
				break;
			case 'readwriteweb.com' :
				$img = 'readwriteweb.jpg';
				break;
			case 'mamstartup.pl' :
				$img = 'mamstartup.jpg';
				break;
		}
	return $img;
	}
	
	/**
	 * generuje kod html jednego feeda
	 */
	private function htmlGenerateOneFeed($feed){
		global $_CLEAN;
		global $rootNoSlash;
		$page = ($_CLEAN['_page'] == NULL ? '' : $_CLEAN['_page']);
//		$link_fb = $_CLEAN['_url'].'/'.$page;
		$link_fb = $rootNoSlash.ModRewrite('f',$_CLEAN['_iddep'],$_CLEAN['_dep'],null,$feed['id'],$feed['it_title']);

		$img = $this->ImgAgr($feed['namewww']);
	
		
		$html = '<div class="feed">
				 <a name="'.$feed['id'].'"></a>
					<div class="title">
						<div class="name"><a href="'.ModRewrite('f',$_CLEAN['_iddep'],$_CLEAN['_dep'],null,$feed['id'],$feed['it_title']).'">'.$feed['it_title'].'</a></div> <div class="see"><a target="_blank" href="'.$feed['it_link'].'" rel="nofollow">&nbsp;</a></div>
					</div>

					<div></div>
					<div class="body"><img style="float: left; margin: 5px 10px 5px 0; border: 2px solid #DDDDDD;" src="/img/layout/avatars/'.$img.'" /> '.str_replace ("</pre>", "</p>", str_replace ("<pre>", "<p>", html_entity_decode($feed['it_description']))).'</div>
					<div class="bottom">
						<div class="site">'.$feed['namewww'].'</div>
						<div style="width:330px; float: left; margin-left: 22px;"><iframe src="http://www.facebook.com/plugins/like.php?href='.$link_fb.'&amp;layout=button_count&amp;show_faces=false&amp;width=330&amp;action=like&amp;font=verdana&amp;colorscheme=light&amp;height=25" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:330px; height:25px;" allowTransparency="true"></iframe></div>
						<div class="pubdate">'.$feed['pubdate'].'</div>					
					</div>
				</div>';

	return $html;
	}

	/**
	 * generuje kod calej podstrony feedow
	 */
	private function htmlGenerateFeeds($arrFeeds){

		foreach($arrFeeds as $feed){
			$html .= $this->htmlGenerateOneFeed($feed);
		}

	return $html;
	}

	/**
	 * 
	 * wyswietlenie kodu html feedow z danej podstrony
	 * @param array $arrFeeds -- dane listy feedow
	 */
	public function Engine($arrFeeds){

		$html = $this->htmlGenerateFeeds($arrFeeds);
		echo $html;
	}
	
	
	/**
	 * 
	 * wyswietlenie kodu html jenego feeda
	 * @param int $idfeed -- id feeda
	 */
	public function EngineOne($idfeed){
		
		$SQL = "SELECT id, namewww, ch_link, it_title, it_link, it_description, pubdate
				FROM agr
				WHERE id = ".$idfeed;

		$RES = $this->_db->query($SQL);
		DebugSQL($SQL, $RES);

		$row = $RES->fetch_assoc();
			

		
		echo $this->htmlGenerateOneFeed($row);//generowanie html feeda
	}
}
?>
