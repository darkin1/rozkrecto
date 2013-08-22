<?php
//require(Xpath('class/class.agregator_show.php')); -- jest juz zadeklarowane wczesniej
require(Xpath('class/class.advertisement.php'));

$objAgrFeedOne = new AgrFeed;
$objAgrFeedOne->EngineOne($_CLEAN['_idfile']);

$objAdv = new Advertisement;

echo '<div style="margin: 0 auto; width: 550px; overflow: hidden;">';
	echo '<div style="float: left; margin-right: 30px;">';
	echo $objAdv->ShopsBox();
	echo '</div>';
	
	echo '<div style="float: left;">';
	echo $objAdv->ShopsBox();
	echo '</div>';
echo '</div>';
echo '<div style="clear: left;"></div>';
?>