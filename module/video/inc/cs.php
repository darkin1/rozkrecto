<?php

	/* --> paginacja*/
			
			$objPagin = new Pagin;//tworze obiekt
		
			$page			= $objPagin->CheckPage($_CLEAN['_page']);//sprawdzenie czy $page pod wzgledem typu
			$objPagin->parePage = 5;//ustawiam ilosc wyswietlanych wynikow
			$parePage		= $objPagin->parePage;//wyciagamy ile feedow ma byc
			$start			= $objPagin->GetStart($page);//oblicza od ktorego wiersza ma zaczac pokazywac feedy	
	
			/*liczy ile ma być podstron*/
			$CountPageSQL	= $objPagin->CountPageSQL("SELECT count(*) as ile FROM video WHERE active = 1 AND id_catsub = ".$_CLEAN['_idcatsub']);
			/*tworzy wlasciwe stronicowanie*/
			$p=$objPagin->MakePagination($page, $CountPageSQL['site']);
	
	/* <-- paginacja*/


/* --> wyswietlenie video*/
$objVideo = new Video;

$objVideo->id_catsub = $_CLEAN['_idcatsub'];
$objVideo->start = $start;

$arrVideos=$objVideo->getVideos();

echo '<div style="width: 555px; float: left;">';
echo '<div class="border">';
	foreach($arrVideos as $video){
		echo $objVideo->htmlVideo($video); 
	}
	
	
	
	/* --> Wyswietlenie paginacji*/
		$typeurl = 'seo';
		echo '<div class="pagin-wrap">';
			$objPagin->ShowPagin($p, $CountPageSQL['site'], $page, $_CLEAN['_url'], $typeurl);
		echo '</div>';		
	/* <-- Wyswietlenie paginacji*/	
	
		
		
echo '</div>';
echo '</div>';
/* <-- wyswietlenie video*/


/* --> REKLAMA*/
$advertisment = '<div style="border: 0px solid black; float: right;">
					<div class="dep-wrap">
						<div class="title">Reklama</div>

						<div class="body" style="padding: 0 15px;"> 
							<script type="text/javascript" src="http://www.skapiec.pl/my/partner/widgets/top_prod_var_img_js.php?s=4&amp;d=12&amp;c=2100&amp;p=55552&amp;type=a"></script>
						</div>
					</div>
						
				</div>';

		
echo $advertisment;	
/* <-- REKLAMA*/
?>