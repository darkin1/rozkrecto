<?php
/*
 * Created on 2011-01-29 by DCCODE
 *
 */

require_once('class/class.dep.php');


$objdep 	= new Dep;
$arrDeps 	= $objdep->GetDep();

foreach($arrDeps as $dep){
	$url = ModRewrite('d',$dep['id'],$dep['name']);

	$htmlDep  .= '<li><a href="'.$url.'">'.$dep['name'].' <br> <span>'.$dep['name2'].'</span> </a></li>';
}


echo '<ul>'.$htmlDep.'</ul>';
?>

