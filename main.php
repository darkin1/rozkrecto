<?php
	require_once('clean.php');
	require_once('show_tracker.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="description" content="<?php echo $descripton; ?>"/>
	<meta name="keywords" content="<?php echo $keywords; ?>"/>

	<!-- css -->
	<link rel="stylesheet" href="/style.css" type="text/css" media="screen" />
	<link rel="stylesheet" type="text/css" href="/lightbox/jquery.lightbox-0.5.css" media="screen" />
	<!-- css -->

	<!-- jquery js -->
	<script type="text/javascript" src="/jquery-1.4.2.min.js"></script>
	<script type="text/javascript" src="/lightbox/jquery.lightbox-0.5.pack.js"></script>
	<script type="text/javascript" src="/s3Slider.js"></script>
	<!-- jquery js -->

	<title><?php echo $title; ?></title>
	
	
	
	<script type="text/javascript">
	
	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-22351089-1']);
	  _gaq.push(['_trackPageview']);
	
	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();
	
	</script>



	<script type="text/javascript">
	<!--
	$(document).ready(function() {
	
		$(".dep-wrap .body ul li").mouseover(function () {
			$(this).css('background-position', '10px 12px');
		}).mouseout(function(){
		    $(this).css('background-position', '5px 12px');
		  });		

	});
	
	//-->
	</script>
	
	<script type="text/javascript">(function(){var s=document.createElement('script');s.src='http://linkomat.pl/linkomat.js';s.setAttribute('async','true');document.documentElement.firstChild.appendChild(s)})();</script>
</head>

<body>
	<div id="wrap">
		<div id="top-wrap">
			<div id="b_top">
				<div id="top"></div>
			</div>
			<div id="b_header">
				<div id="header"><?php echo '<a href="/"><img src="/img/layout/logo.png" /></a>'; ?></div>
			</div>
			<div id="b_menu">
				<div id="menu"><?php require_once('show_dep_menu.php')?></div>
			</div>
		</div>

		<div id="tracker-wrap">
			<div id="tracker">
				<?php echo $Track; ?>
				
			</div>
		</div>

		<div id="body-wrap">
			<div id="body-content">
			<?php
				/*includowanie departmanentow*/
				switch($_CLEAN['_iddep']){
					
					case '6':
						include_once("module/doc/show_doc.php");
					break;
					
					case '1':
						include_once("module/dopobrania/show_dopobrania.php");
					break;
	
					case '2':
						include_once("module/agregator/show_agregator.php");
					break;
	
					case '3':
						include_once("module/video/show_video.php");
					break;
					
					default:
						include_once("show_main.php");
					break;
				}
			?>
			</div>
		</div>

		<div id="footer-wrap">
			<div id="footer">
				
				<div class="footer_left" style="width: 200px;">
					<h2><?php echo $Pnazwa; ?></h2>
					<ul>
						<li><a href="/cs/46-regulamin">Regulamin</a></li>
						<li><a href="/cs/47-polityka-prywatnosci">Polityka prywatności</a></li>
						<li><a href="/cs/48-reklama">Reklama</a></li>
						<li><a href="/cs/49-kontakt">Kontakt</a></li>
						<li><a href="http://staldetal.pl/o-firmie">elementy kute</a></li>
					</ul>
				</div>
				
				<div class="footer_left" >
				<div id="fb_main">
					<iframe src="http://www.facebook.com/widgets/like.php?href=http://www.rozkrecto.pl&show_faces=true" scrolling="no" frameborder="0" style="border:none; width:410px; height:150px">
					</iframe>
				</div>
				</div>
				
				<div class="footer_left">
					<?php echo  '<div id="copyright">Copyright © 2011  <strong>'.$Pnazwa.'</strong></div>'; ?>
				</div>

			</div>
		</div>
	</div>
</body>
</html>



