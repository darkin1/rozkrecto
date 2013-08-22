<?php
/*
 * Created on 2011-01-29 by DCCODE
 *
 */

require_once(Xpath('class/class.left_menu.php'));
require_once(Xpath('class/class.agregator_show.php'));
require_once(Xpath('class/class.pagin.php'));




$objLeftMenu = new LeftMenu;
$objLeftMenu->setIddep($_CLEAN['_iddep']);

$htmlLeftMenu = $objLeftMenu->GenerateHtmlMenu();



?>



<div id="body-content-in">
	<div id="left">
	<?php
		echo '<div class="border">';
			echo $htmlLeftMenu;
		echo '</div>';
	?>
	</div>

	<div id="right">
	<div class="border">
	<?php


	$objAgrFeed = new AgrFeed;
	
	
	
	
	/*paginacja*/	
	$objPagin = new Pagin;//tworze obiekt
	
	$page			= $objPagin->CheckPage($_CLEAN['_page']);//sprawdzenie czy $page pod wzgledem typu
	$parePage		= $objPagin->parePage;//wyciagamy ile feedow ma byc
	$start			= $objPagin->GetStart($page);//oblicza od ktorego wiersza ma zaczac pokazywac feedy	
	
	
		/*w zaleznosci od tego co to ma byc tworzymy odpowienie zapytania liczace oraz wyciagajace dane */
		switch($_CLEAN['_site']){

			case 'd':
				if(isset($_GET['idfile'])){
					require ('inc/f.php');
				}else{
					/*liczy ile ma być podstron*/
					$CountPageSQL	= $objPagin->CountPageSQL("SELECT count(id) as ile FROM agr WHERE active = 1;");
					
					$arrFeed = $objAgrFeed->getFeedData($start, $parePage);		
				}

				break;

			case 'c':
				/*liczy ile ma być podstron*/
				$CountPageSQL	= $objPagin->CountPageSQL("SELECT count(agr.id) as ile
															FROM agr
															  JOIN catsub as cs ON cs.id=agr.idwww
															WHERE cs.id_cat = '$_CLEAN[_idcat]';");
				
				$arrFeed = $objAgrFeed->getFeedDataCat($start, $parePage, $_CLEAN['_idcat']);
				break;

			case 'cs':
				/*liczy ile ma być podstron*/
				$CountPageSQL	= $objPagin->CountPageSQL("SELECT count(id) as ile
															FROM agr
															WHERE idwww = '$_CLEAN[_idcatsub]';");
				
				$arrFeed = $objAgrFeed->getFeedDataSubCat($start, $parePage, $_CLEAN['_idcatsub']);
				break;
		}

		/*tworzy wlasciwe stronicowanie*/
		$p=$objPagin->MakePagination($page, $CountPageSQL['site']);


	
	if(!isset($_GET['idfile'])){
		/*generowanie listy feedow*/
		$objAgrFeed->Engine($arrFeed);
	
	
	/*Wyswietlenie paginacji*/
	$typeurl = 'seo';
	echo '<div class="pagin-wrap">';
		$objPagin->ShowPagin($p, $CountPageSQL['site'], $page, $_CLEAN['_url'], $typeurl);
	echo '</div>';	
	}
	?>
	</div>
	</div>
</div>




