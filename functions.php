<?php
/*
 * Created on 2010-01-17
 *
 *
 */

	function deb($val){
		echo '<pre>'; echo var_dump($val); echo '</pre>';
	}

	function getmicrotime(){
	/**
	 * pomiar czasu strony
	 */
		list($usec, $sec) = explode(" ",microtime());
	return ((float)$usec + (float)$sec);
	}

	/**
	 * funkcja zamieniajaca znaki specjalne oraz polskie znaki na alternatywne
	 * jako ze funkcaj jest niedoskonala przestac jej uzywac !!!!
	 */
	function CharChange($text){

//	$text = strtolower($text); // Zamiana na małe litery
	$text = mb_strtolower($text, 'UTF-8');// na localu nie dzialaly poslskie znaki dla tego zamiana na ta funkcje (dziala od php 4.5)
	$text = html_entity_decode($text);
	$szukaj = array(
		' ',
		'.',
		'!',
		'–',
		'#',
		':',
		'?',
		'”',
		'„',
		'/',
		',',
		'\'',
		'\\',
		'[',
		']',
		'"',
		'&',
		'%',
		'ć',
		'ś',
		'ą',
		'ż',
		'ó',
		'ł',
		'ż',
		'ź',
		'ń',
		'ę',
		'Ć',
		'Ś',
		'Ą',
		'Ż',
		'Ó',
		'Ł',
		'ż',
		'ź',
		'ń',
		'ę',
	);
	$zamieniaj = array(
		'-',
		'-',
		'-',
		'-',
		'-',
		'-',
		'-',
		'-',
		'-',
		'-',
		'-',
		'-',
		'-',
		'-',
		'-',
		'-',
		'and',
		'procent',
		'c',
		's',
		'a',
		'z',
		'o',
		'l',
		'z',
		'z',
		'n',
		'e',
		'C',
		'S',
		'A',
		'Z',
		'O',
		'L',
		'Z',
		'Z',
		'N',
		'E',
	);
	//$text = strtolower($text); // Zamiana na małe litery
	$text = str_replace($szukaj, $zamieniaj, $text); // Zamiana znaków z tablic
	return $text;
	}

	/**
	 * 
	 * funkcja pomocnicza do zamiany liter na odpowiednie kodowanie
	 * @param unknown_type $tekst
	 */
	function _no_pl($tekst){
	   $tabela = Array(
	   //WIN
	    "\xb9" => "a", "\xa5" => "A", "\xe6" => "c", "\xc6" => "C",
	    "\xea" => "e", "\xca" => "E", "\xb3" => "l", "\xa3" => "L",
	    "\xf3" => "o", "\xd3" => "O", "\x9c" => "s", "\x8c" => "S",
	    "\x9f" => "z", "\xaf" => "Z", "\xbf" => "z", "\xac" => "Z",
	    "\xf1" => "n", "\xd1" => "N",
	   //UTF
	    "\xc4\x85" => "a", "\xc4\x84" => "A", "\xc4\x87" => "c", "\xc4\x86" => "C",
	    "\xc4\x99" => "e", "\xc4\x98" => "E", "\xc5\x82" => "l", "\xc5\x81" => "L",
	    "\xc3\xb3" => "o", "\xc3\x93" => "O", "\xc5\x9b" => "s", "\xc5\x9a" => "S",
	    "\xc5\xbc" => "z", "\xc5\xbb" => "Z", "\xc5\xba" => "z", "\xc5\xb9" => "Z",
	    "\xc5\x84" => "n", "\xc5\x83" => "N",
	   //ISO
	    "\xb1" => "a", "\xa1" => "A", "\xe6" => "c", "\xc6" => "C",
	    "\xea" => "e", "\xca" => "E", "\xb3" => "l", "\xa3" => "L",
	    "\xf3" => "o", "\xd3" => "O", "\xb6" => "s", "\xa6" => "S",
	    "\xbc" => "z", "\xac" => "Z", "\xbf" => "z", "\xaf" => "Z",
	    "\xf1" => "n", "\xd1" => "N");
	
	   return strtr($tekst,$tabela);
	}
	
	/**
	 * 
	 * zamiana wszystkich znakow specjalnych na -
	 * @param unknown_type $string
	 */
	function seostring($string){
		$string = _no_pl($string);
		$string = strtolower($string);
		$string = strtr($string, 'ĘÓĄŚŁŻŹĆŃęóąśłżźćń', 'EOASLZZCNeoaslzzcn');
		$string = preg_replace('/[^A-Za-z0-9\s\-_]/s','',$string);
		$string = preg_replace('/[\s_]/s','-',$string);
		$string = preg_replace('/-{2,}/s','-',$string);		
		return $string;
	}

	/**
	 * zamienia zwyczajne linki na linki SEO
	 * @site -- okresla jaka to strona (dział, kategoria)
	 * @id -- określa id dzialu, kategorii, firmy
	 * @name -- okresla tytul dla seo
	 * @page -- okresla podstrone
	 *
	 * @return stringa @url
	 */
	function ModRewrite($site=NULL, $id=NULL, $name=NULL, $page=NULL, $f_id=NULL, $f_name=NULL){

		$name 	= seostring($name);//zamiana polskich liter
		$f_name = seostring($f_name);//zamiana polskich liter

		switch($site){

			case 'd':

				$url = '/d/'.$id.'-'.$name;

			return $url;
			break;

			case 'c':

				$url = '/c/'.$id.'-'.$name;

			return $url;
			break;

			case 'cs':

				$url = '/cs/'.$id.'-'.$name;

			return $url;
			break;

			case 'f':

				$url = '/d/'.$id.'-'.$name.'/f/'.$f_id.'-'.$f_name;

			return $url;
			break;
			
			default:
				$url = '/';

			return $url;
			break;
		}





	}

	function CheckId($id){
		/**
		 * funkcja sprawdza czy id jest liczba jezeli nie to zwaraca id = 1
		 */

		if(is_numeric($id)){
			$id = (int)$id;
		}
		else{
			$id = 1;
		}

	return $id;
	}



	function CheckEmail($email) {
		/**
		 * sprawdza poprawnosc adresu email
		 * @param $email [string] -- adres email
		 */
	 if (!preg_match('#^([a-zA-Z0-9_.-]*)\@([a-zA-Z0-9_.-]*)$#' , $email)) {
	  return false;
	 }
	 return true;
	}

	function CheckLenght($min, $max, $string){
		/**
		 * sprawdza dlugosc stringa, jezeli sie miesci w przedziale zwraca true
		 *
		 * @param $min [int] -- dolny brzeg przedzialu
		 * @param $max [int] -- gorny brzeg przedzialy
		 * @param $string [string] -- tekst do sprawdzenia
		 */
		if($max == 0){//jesli max jest = 0 sprawdzaj tylko min
			if(strlen($string)>=$min) {
				return true;
			}
			else{
				return false;
			}
		}
		else {//jesli max <> sprawdzaj min i max
			if(strlen($string)<=$max && strlen($string)>=$min) {
				return true;
			}
			else{
				return false;
			}
		}
	}


	function IsFoto($idfirm, $type){
	/**
	 * sprawdza czy jest fotka dla danej firmy
	 *
	 * @param $idfirm [int] -- id firmy
	 * @param $type [string] -- s - mała fotka, b - duza fotka
	 *
	 * @param $url [string] -- zwraca url do fotki
	 */

		if($type == 's'){
			$t = 's';
			$s = '120x60';
		}
		elseif($type == 'b'){
			$t = 'b';
			$s = '200x100';
		}


		$url = 'FirmsLogo/'.$s.'/'.$idfirm.'_'.$t.'.jpg';

		if (file_exists($url)) {
	  		return $url;
		} else {
			$url = 'FirmsLogo/'.$s.'/'.'x'.'_'.$t.'.jpg';
	    	return $url;
		}
	}

	/**
	 * liczy procent
	 * @param $max int -- maksymalna wartosc
	 * @param $akt int -- aktualna wartosc
	 */
	function procent($akt, $max){
		$w=($akt*100/$max);
		$w=round($w,1);
	return $w;
	}


	function DebugSQL($sql, $res=null){
		$msg=$sql;

		Debug_Log::add($msg,DEBUG_SQL);
//		Debug_Log::display();
	}


	/**
	 * funkcja sluzy do podawania sciezki absolutnej do pliku
	 */
	function Xpath($dir){
		if (DIRECTORY_SEPARATOR=='/')
			$absolute_path = dirname(__FILE__).'/';
		else
			$absolute_path = str_replace('\\', '/', dirname(__FILE__)).'/';

	return $absolute_path.$dir;
	}

//	function Raport($filename, $text){
//		$date = date("Y-m-d H:i:s");
//		$data = $date.'\n';
//		$data .= '----------------------\n';
//		$data .=
//
//		file_put_content($filename, $data, FILE_APPEND);
//	}
/* ADMIN    ############################################################################################*/
?>
