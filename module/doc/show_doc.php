<?php
require(Xpath('class/class.left_menu.php'));

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
			echo $htmlLeftMenu;
		echo '</div>';
	?>
	</div>

	<div id="right">
		<div>
		<div class="border" style="padding: 10px 20px;">
		<?php 
		
			switch ($_CLEAN['_idcatsub']){
				
				case '46':
					require ('inc/regulamin.php');
					break;
				
				case '47':
					require ('inc/polityka_pryw.php');
					break;

				case '48':
					require ('inc/reklama.php');
					break;

				case '49':
					require ('inc/kontakt.php');
					break;
					
				default:
					echo $Pnazwa.' ma na celu gromadzić najświeższe informajcę na temat startupów oraz pomagać w ich budowaniu.';
					break;	
			}
		
		?>
		</div>
		</div>
	</div>
	
</div>