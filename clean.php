<?php
/*
 * Created on 2011-01-29 by DCCODE
 *
 * ustawia zmienna $_CLEAN
 */

require_once('class/class.clean.php');

$objclean = new Clean;
$_CLEAN=$objclean->DriverClean();


?>
