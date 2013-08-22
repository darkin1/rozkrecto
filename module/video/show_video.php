<?php
/*
 * Created on 2011-01-29 by DCCODE
 *
 */

require(Xpath('class/class.left_menu.php'));
require(Xpath('class/class.pagin.php'));
require(Xpath('class/class.video.php'));
require(Xpath('class/class.advertisement.php'));


/* -->reklama */
$objAdv = new Advertisement;
/* <--reklama */

/* -->lewe menu */
$objLeftMenu = new LeftMenu;
$objLeftMenu->setIddep($_CLEAN['_iddep']);

$htmlLeftMenu = $objLeftMenu->GenerateHtmlMenu();
/* <--lewe menu */


?>



<div id="body-content-in">
	<div id="left">
	<?php
		echo '<div class="border">';
			echo $objAdv->AdvTextBoxMenu();
			echo $htmlLeftMenu;
		echo '</div>';
	?>
	</div>

	<div id="right">
	<?php
	
				
		
		/*REKLAMA*/
		$advertisment = '<div style="border: 0px solid black; height: 300px; width: 200px; float: right;">
						<div class="dep-wrap">
							<div class="title">Sponsor</div>

							<div class="body"> 
								<script type="text/javascript"><!--
								google_ad_client = "ca-pub-5920786410835498";
								/* text - wiez */
								google_ad_slot = "4857248756";
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
				require('inc/d.php');
				break;
				
			case 'cs':
				require('inc/cs.php');	
				break;
		}
	?>

	</div>

	

</div>