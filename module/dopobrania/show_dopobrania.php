<?php
/*
 * Created on 2011-01-29 by DCCODE
 *
 */

require(Xpath('class/class.left_menu.php'));
require(Xpath('class/class.file_one.php'));
require(Xpath('class/class.files.php'));
require(Xpath('class/class.pagin.php'));
require(Xpath('class/class.advertisement.php'));


/* -->reklama */
$objAdv = new Advertisement;
/* <--reklama */

/* -->lewe menu */
$objLeftMenu = new LeftMenu;
$objLeftMenu->setIddep($_CLEAN['_iddep']);

$htmlLeftMenu = $objLeftMenu->GenerateHtmlMenu();
/* <--lewe menu */


/* -->objekt plik */
$objFiles = new Files;
/* <--objekt plik */

?>



<div id="body-content-in">
	<div id="left">
	<?php
		echo '<div class="border">';
			echo $htmlLeftMenu;
			echo $objAdv->AdvMenuBook();
		echo '</div>';
	?>
	</div>

	<div id="right">
	<?php
		/*paginacja*/	
		$objPagin = new Pagin;//tworze obiekt
		
		$page			= $objPagin->CheckPage($_CLEAN['_page']);//sprawdzenie czy $page pod wzgledem typu
		$objPagin->parePage = 5;//ustawiam ilosc wyswietlanych wynikow
		$parePage		= $objPagin->parePage;//wyciagamy ile feedow ma byc
		$start			= $objPagin->GetStart($page);//oblicza od ktorego wiersza ma zaczac pokazywac feedy	
	
				
		
		/*REKLAMA*/
		$advertisment = '<div style="border: 0px solid black; height: 300px; width: 200px; float: right;">
						<div class="dep-wrap">
							<div class="title">Sponsor</div>

							<div class="body" style="padding-left: 20px;"> 
								<script type="text/javascript"><!--
								google_ad_client = "ca-pub-5920786410835498";
								/* graf - wieza */
								google_ad_slot = "7828939458";
								google_ad_width = 160;
								google_ad_height = 600;
								//-->
								</script>
								<script type="text/javascript"
								src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
								</script>
							</div>
						</div>
						
					  </div>';
		/*REKLAMA*/
		
		
		switch($_CLEAN['_site']){

			case 'd':
				$s = (isset($_GET['idfile']) ? 'inc/f.php' : 'inc/d.php');
				require($s);
				break;

			case 'c':
				require('inc/c.php');
				break;			
				
			case 'cs':
				require('inc/cs.php');	
				break;
		}
	?>

	</div>

	

</div>
