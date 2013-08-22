<?php
/*
 * Created on 2011-01-29 by DCCODE
 *
 */


global $_CLEAN;
global $root;

//$Pnazwa -- pobierane z pliku config.php

$placeD  = ' <img src="/img/layout/arrow.png" /> <a href="'.ModRewrite('d',$_CLEAN['_iddep'],$_CLEAN['_dep']).'">'.$_CLEAN['_dep_n'].'</a>';
$placeC  = ' <img src="/img/layout/arrow.png" /> <a href="'.ModRewrite('c',$_CLEAN['_idcat'],$_CLEAN['_cat']).'">'.$_CLEAN['_cat_n'].'</a>';
$placeCS = ' <img src="/img/layout/arrow.png" /> <a href="'.ModRewrite('c',$_CLEAN['_idcatsub'],$_CLEAN['_catsub']).'">'.$_CLEAN['_catsub_n'].'</a>';

switch ($_CLEAN['_site']){

	case 'd':
		$Track = $placeD;
		/*------------------------------------*/
		$descripton = $Pnazwa.', '.$_CLEAN['_dep_n'].' - Pliki za darmo, graficzne, ikony, tempaltes, free, szablony, przyciski';
		$keywords 	= $Pnazwa.', '.$_CLEAN['_dep_n'].' - Przyciski, darmowe rzeczy, ikony, graficzki darmowe, newsy, startup, start-up, startup school, anioły biznesu';
		
		$title = $Pnazwa.', '.$_CLEAN['_dep_n'];
		break;
	
	case 'c':
		$Track = $placeD.$placeC;
		/*------------------------------------*/
		$site=(!empty($_CLEAN['_page']) ? 'strona '.$_CLEAN['_page'] : '');
		$descripton = $Pnazwa.', '.$_CLEAN['_cat_n'].', '. $site.', startup, dofinansowanie, unia, groupon, allegro, biznes, pomysł na biznes, google, historia sukcesu, biznes plan';
		$keywords 	= $Pnazwa.', '.$_CLEAN['_cat_n'].', '. $site.' sukces w internecie, fundusze ue, akty prawne, biznes, startup, przyciski, ikony, szablony www, darmowe szablony www';
		
		$title = $Pnazwa.', '.$_CLEAN['_cat_n'];
		break;
			
	case 'cs':
		if($_CLEAN['_iddep'] == 2){/*wyjatek aby byly widoczne kat. w trackerze*/
			$Track = $placeD.$placeC.$placeCS;
		}else{
			$Track = $placeD.$placeCS;
		}
		/*------------------------------------*/
		$site=(!empty($_CLEAN['_page']) ? 'strona '.$_CLEAN['_page'] : '');
		$descripton = $Pnazwa.', '.$_CLEAN['_catsub_n'].', '. $site.', jak zbudować startup, PHP, programowanie, strony www, buduj startup, javascript, jquery, Parp 8.1';
		$keywords 	= $Pnazwa.', '.$_CLEAN['_catsub_n'].', '. $site.', wiadomości, startup, anioły biznesu, dofinansowanie z uni europejskiej, samouczki';
		
		$title = $Pnazwa.', '.$_CLEAN['_catsub_n'];
		break;
		
	default:
		$Track = '';
		
		/*------------------------------------*/
		$descripton = $Pnazwa.' - Buduj z nami swój startup, darmowe ikony, szablony www, templates, psd, darmowe psd, darmowe ikony, darmowe czcionki, startup, strony www';
		$keywords 	= $Pnazwa.' - startup, skrypty, technologia, darmowe pliki, wszystko za darmo, ikony, szablony, templates, free, psd, logo czcionki, przyciski, start-up';
		
		$title = $Pnazwa;
		break;
}


$Track = '<strong><a style="color: #A50000;" href="'.$root.'">'.$Pnazwa.'</a></strong>'.$Track;



?>
