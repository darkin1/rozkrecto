<?php
/*
 * Created on 2011-02-01 by DCCODE
 *
 * pobiera feedy ze strony i zapisuje je do bazy danych
 *
 * - zapis do bazy
 * - sprawdzanie czy sa juz takie wpisy
 */
set_time_limit(0);
require_once('../../functions.php');
require_once("../../config.php");
require_once("../../debug.php");
require_once(Xpath("class/class.db.php"));
require_once(Xpath('class/class.agregator.php'));

$objDB 	= new ClassDB;
$db		= $objDB->ConnectDB();







$siteRss = array('http://feeds.feedburner.com/Antyweb?format=xml',
				 'http://feeds.feedburner.com/wystartowali?format=xml',
				 'http://startups.pl/rss,startups',
				 'http://mambiznes.pl/rss',
				 'http://feeds.feedburner.com/killerstartups',
				 'http://feeds.feedburner.com/startuplift?format=xml',
				 'http://www.startopia.pl/rss',
				 'http://www.startupy.com.pl/feed/',
				 'http://feeds.feedburner.com/readwritestart?format=xml',
				 'http://www.inwestycje.pl/rss/?mode=section&id=26555',
				 'http://www.mamstartup.pl/rss');



/*Antyweb ----------------------------------------------------------*/
$idwww=1;
$objRssAntyweb = new Agregator($siteRss[0]);


$objRssAntyweb->setIdWww($idwww); //id strony
$objRssAntyweb->setNameWww('antyweb.pl'); //nazwa strony

$objRssAntyweb->Engine($idwww);


/*Wystartowali ----------------------------------------------------------*/
$idwww=2;
$objRssWystartowali = new Agregator($siteRss[1]);


$objRssWystartowali->setIdWww($idwww); //id strony
$objRssWystartowali->setNameWww('wystartowali.pl'); //nazwa strony

$objRssWystartowali->Engine($idwww);


/*Startups ----------------------------------------------------------*/
$idwww=3;
$objRssStartups = new Agregator($siteRss[2]);
$objRssStartups->setIdWww($idwww); //id strony
$objRssStartups->setNameWww('startups.pl'); //nazwa strony

$objRssStartups->Engine($idwww);

/*MamBiznes ----------------------------------------------------------*/
$idwww=4;
$objRssStartups = new Agregator($siteRss[3]);
$objRssStartups->setIdWww($idwww); //id strony
$objRssStartups->setNameWww('mambiznes.pl'); //nazwa strony

$objRssStartups->Engine($idwww);

/*Killerstartups ----------------------------------------------------------*/
$idwww=5;
$objRssKiller = new Agregator($siteRss[4]);
$objRssKiller->setIdWww($idwww); //id strony
$objRssKiller->setNameWww('killerstartups.com'); //nazwa strony

$objRssKiller->Engine($idwww);

/*startuplift.com ----------------------------------------------------------*/
$idwww=6;
$objRssKiller = new Agregator($siteRss[5]);
$objRssKiller->setIdWww($idwww); //id strony
$objRssKiller->setNameWww('startuplift.com'); //nazwa strony

$objRssKiller->Engine($idwww);

/*startopia.pl ----------------------------------------------------------*/
/*
$idwww=7;
$objRssKiller = new Agregator($siteRss[6]);
$objRssKiller->setIdWww($idwww); //id strony
$objRssKiller->setNameWww('startopia.pl'); //nazwa strony

$objRssKiller->Engine($idwww);
*/
/*startupy.com.pl ----------------------------------------------------------*/
$idwww=8;
$objRssKiller = new Agregator($siteRss[7]);
$objRssKiller->setIdWww($idwww); //id strony
$objRssKiller->setNameWww('startupy.com.pl'); //nazwa strony

$objRssKiller->Engine($idwww);

/*readwriteweb.com ----------------------------------------------------------*/
$idwww=9;
$objRssKiller = new Agregator($siteRss[8]);
$objRssKiller->setIdWww($idwww); //id strony
$objRssKiller->setNameWww('readwriteweb.com'); //nazwa strony

$objRssKiller->Engine($idwww);

/*inwestycje.pl ----------------------------------------------------------*/
$idwww=10;
$objRssKiller = new Agregator($siteRss[9]);
$objRssKiller->setIdWww($idwww); //id strony
$objRssKiller->setNameWww('inwestycje.pl'); //nazwa strony

$objRssKiller->Engine($idwww);

/*mamstartup.pl ----------------------------------------------------------*/
$idwww=50;
$objRssKiller = new Agregator($siteRss[10]);
$objRssKiller->setIdWww($idwww); //id strony
$objRssKiller->setNameWww('mamstartup.pl'); //nazwa strony

$objRssKiller->Engine($idwww);
?>


