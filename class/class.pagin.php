<?php
/*
 * Created on 2010-03-04
 *
 *
 */

class Pagin{

 private $_db;
 public $parePage=10;//Ta część odpowiada za ilość wyświetlanych wyników (ile na jednej stronie)
 public $start;//od ktorego wierwsza zaczac (od)


	function __construct(){
		global $db;

		$this->_db = $db;
	}
	
	
	
	/**
 	 * oblicza od ktorego wiersza ma zaczac pokazywac produkty
 	 */
	 public function GetStart($page){
	
		$start = ($page -1) * $this->parePage;
	
	 return $start;
	 }

	 
 	/**
 	 * sprawdzenie czy $page pod wzgledem typu
 	 *
 	 * Ta część odpowiada za odebranie numeru strony.
 	 * Jeżeli nie ma nic, to znaczy, że jest 1. jesli jest poniżej 1,
 	 * to też jest 1. To tak dosyć łopatologicznie
 	 */	 
	 public function CheckPage($page){
	
		if (is_numeric($page)) {//sprawdza czy $page jest liczba
			$page = (int) $page;//zamienia na inta
			if ($page < 1) {//jezeli $page jest zmniejsze od 1 to przypisz 1
				$page = 1;
			}
		}
		else {
			$page = 1;//jezeli nie jest liczba to przypisz $page pierwsza strone
		}
	 return $page;
	 }

	 
 	/*
 	 * liczy ile ma być podstron
 	 * w zapytaniu zawsze trzeba podac 'count() AS ile'
 	 * @param $HowMuch [tablica] -- ilosci produktow $HowMuch['products'] oraz podstron $HowMuch['site']
 	 */	 
	 public function CountPageSQL($SQL){
	
	
		$RES = $this->_db->query($SQL);
		$VER = $RES->fetch_assoc();
		$HowMuch['products'] = $VER['ile'];//liczy ile jest produktow
	
		$MuchSite = $HowMuch['products']/$this->parePage;
		$HowMuch['site'] = ceil($MuchSite);//liczy ile jest podstron na podstawie ilosci produktow
	
	 return $HowMuch;
	 }

	 
	 
	 public function CountPageSQL_search ($ile){
	
	 	$HowMuch['products'] = $ile;//liczy ile jest produktow
	
		$MuchSite = $HowMuch['products']/$this->parePage;
		$HowMuch['site'] = ceil($MuchSite);//liczy ile jest podstron na podstawie ilosci produktow
	
	 return $HowMuch;
	 }

	 
	 
 	/*
 	 * liczy ile ma być podstron po przez podanie ilosci produktow jako liczbe
 	 */	 
	  public function CountPageCount($ile){
		
		$MuchSite = $ile/$this->parePage;
		$MuchSite = ceil($MuchSite);
	
	 return $MuchSite;
	 }

	 
	/**
	* tworzenie linku do stronicowania
	* @param $urlCat [string] -- link do strony kategorii (brany z trakera '$urlCat'
	* @param $page [int] -- id podstrony ktora chcemy wpadkowac do linku
	* @param $typeurl [string] -- okresla jak link ma wygladac (seo-linki seo, normal-normalne linki)
	*/	 
	 public function URLPaging($urlCat,$page,$typeurl){
	
	
		switch ($typeurl){
	
			case 'seo':
				$urlpagin = $urlCat."/".$page;
			break;
	
	
			case 'normal':
				$urlpagin = $urlCat."&page=".$page;
			break;
		}
	
	
	 return $urlpagin;
	 }

	 
	 
	/**
	 * tworzy wlasciwe stronicowanie
	 * @param $page [int] -- bierzaca podstrona
	 * @param $MuchSite [int] -- ilosc podstron
	 * @param $max [int] -- maxymalna ilosc wyswietlanych linkow dla podstron(nie dokonca dziala)
	 *
	 * @param $p [tablica] -- wyplowa podstrony dla strony
	 */ 
	 public function MakePagination($page, $MuchSite){
	
		$max = 5;
		//$MuchSite=100;
	
	
		if($page<1 && $page>$MuchSite){//sprawdza czy page znajduje sie w przedziale od 1-ilosci stron (0--metoda CheckPage zamienia 0 na 1)
			echo "blad";
			$page = $MuchSite;
		}
	
		//echo "<p>stron={$page}</p>";
	
		if($MuchSite>=1 && $MuchSite<=$max+5){//jezeli podstron jest mniej niz 6
		//echo '<p>typ 1</p>';
		$page=1;
			$p['min'] = null;
			if($MuchSite==1){
				$p['normal'] = array($page);
			}
			elseif($MuchSite==2){
				$p['normal'] = array($page, $page+1);
			}
			elseif($MuchSite==3){
				$p['normal'] = array($page, $page+1, $page+2);
			}
			elseif($MuchSite==4){
				$p['normal'] = array($page, $page+1, $page+2, $page+3);
			}
			elseif($MuchSite==5){
				$p['normal'] = array($page, $page+1, $page+2, $page+3, $page+4);
			}
			elseif($MuchSite==6){
				$p['normal'] = array($page, $page+1, $page+2, $page+3, $page+4, $page+5);
			}
			elseif($MuchSite==7){
				$p['normal'] = array($page, $page+1, $page+2, $page+3, $page+4, $page+5, $page+6);
			}
			elseif($MuchSite==8){
				$p['normal'] = array($page, $page+1, $page+2, $page+3, $page+4, $page+5, $page+6, $page+7);
			}
			elseif($MuchSite==9){
				$p['normal'] = array($page, $page+1, $page+2, $page+3, $page+4, $page+5, $page+6, $page+7, $page+8);
			}
			elseif($MuchSite==10){
				$p['normal'] = array($page, $page+1, $page+2, $page+3, $page+4, $page+5, $page+6, $page+7, $page+8, $page+9);
			}
			$p['max'] = null;
		}
		else{
			if($page>=1 && $page<=$max){//1--5
			//echo '<p>typ 2</p>';
				$p['min'] = ($page==1 ? null : $p['min']=1);
				$p['normal'] = array($page, $page+1, $page+2, $page+3, $page+4);
				$p['max'] = $MuchSite;
			}
	
			elseif($page>$max && $page<$MuchSite-4){//6--ost-5
			//echo '<p>typ 3</p>';
				$p['min'] = 1;
				$p['normal'] = array($page-2, $page-1, $page, $page+1, $page+2);
				$p['max'] = $MuchSite;
			}
	
			elseif($page>=$MuchSite-4 && $page<=$MuchSite){//ost-4--ost
			//echo '<p>typ 4</p>';
				$p['min'] = 1;
				$p['normal'] = array($page-4, $page-3, $page-2, $page-1, $page);
				$p['max'] = ($page==$MuchSite ? null : $p['max']=$MuchSite);
			}
		}
	
	 return $p;	
	 }

		/**
		 * wyswietla paginacje
		 *
		 * @param $p [tablica] -- tablica z paginacja (wygenerowana przez metode MakePagination)
		 * @param $MuchSite [int] -- ilosc podstron
		 * @param $page [int] -- obecna podstrona
		 * @param $urlCat [string] -- link do strony kategorii (brany z trakera '$urlCat'
		 * @param $typeurl [string] -- okresla jak link ma wygladac (seo-linki seo, normal-normalne linki)
		 */
	public function ShowPagin($p, $MuchSite, $page, $urlCat, $typeurl){
	
	
		if($MuchSite <> 0){
			$OBJPagin = new Pagin;
	
	
			echo "<div class=\"pagin\">";
	
				if($page !== 1){
					$prev = $page-1;
					$UrlPrev = $OBJPagin->URLPaging($urlCat, $prev, $typeurl);
					echo '<a href="'.$UrlPrev.'"> <img src="/img/layout/pagin/left.png"> Poprzednia </a>';
				}
	
				$UrlMin = $OBJPagin->URLPaging($urlCat, $p['min'], $typeurl);
				$first = ($p['min'] == null ? $first = null : $first = '<a href="'.$UrlMin.'">'.$p['min'].'</a> ... ');
				echo $first;
	
	
				foreach ($p['normal'] as $normal){
					if($normal == $page){
						$UrlNormal = $OBJPagin->URLPaging($urlCat, $normal, $typeurl);
						echo '<a style="color: red" href="'.$UrlNormal.'">'.$normal.'</a>';
					}
					else{
						$UrlNormal = $OBJPagin->URLPaging($urlCat, $normal, $typeurl);
						echo '<a href="'.$UrlNormal.'">'.$normal.'</a>';
					}
				}
	
				$UrlMax = $OBJPagin->URLPaging($urlCat, $p['max'], $typeurl);
				$last = ($p['max'] == null ? $last = null : $last = ' ... <a href="'.$UrlMax.'">'.$p['max'].'</a>');
				echo $last;
	
				if($page < $MuchSite){
					$next=$page+1;
					$UrlNext = $OBJPagin->URLPaging($urlCat, $next, $typeurl);
					echo '<a href="'.$UrlNext.'"> Następna <img src="/img/layout/pagin/right.png"> </a>';
				}
			echo "</div>";
		}
	}

}
?>
