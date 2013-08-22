<?php
/*
 * Created on 2011-01-30 by DCCODE
 *
 */
require_once(Xpath('class/class.main.php'));

$path='/module/dopobrania/files/img/580/';
$objMain = new Main;



/* --> agregator ------------------------------------*/
$arrFeeds = $objMain->getNewFeeds();
foreach($arrFeeds as $k=>$feed){
	$style = ($k==0 ? 'style="font-weight: bold; color: #A50000; font-size: 14px;"' : '');
	$htmlFeeds .= '<li><a '.$style.' href="d/2-agregator#'.$feed['id'].'">'.htmlspecialchars($feed['it_title']).'</a></li>';
	
}




/* <-- agregator ------------------------------------*/
	$html = '<div class="body" style="float: left; margin: 0 12px;">
				 		<div class="img" style="margin: 0 auto;">
				 			<a href=""><img src="" border="0" /></a>
				 		</div>
			</div>';
?>
<script type="text/javascript">
    $(document).ready(function() {
        $('#slider1').s3Slider({
            timeOut: 3000 
        });

        
        $('#file a').mouseover(function(){
			$(this).children('span.bottom').slideUp("normal");
        }).mouseout(function(){
        	$(this).children('span.bottom').slideDown("fast");
        });

        
        $('#agregator a').mouseover(function(){
			$(this).children('img').css('border', '2px solid #C24646');
        }).mouseout(function(){
        	$(this).children('img').css('border', '2px solid #AEC4D3');
        });

        
        $('#video a').mouseover(function(){
			$(this).children('img').css('opacity', '0.8');
        }).mouseout(function(){
        	$(this).children('img').css('opacity', '1');
        });
        
    });
</script>	


<div id="body-content-in">
	


	
	

	<div id="main_left" style="width: 600px;">
	
	
	    <div id="slider1">
	        <ul id="slider1Content">
	            <li class="slider1Image">
	                <a href="cs/27-psd-part--1/4#226"><img src="<?php echo $path; ?>226.jpg" alt="Second Free PSDs Icon Pack" border="0" /></a>
	                <span class="top"><strong>Second Free PSDs Icon Pack</strong></span>
	            </li>
	            <li class="slider1Image">
	                <a href="cs/23-biale/2#157"><img src="<?php echo $path; ?>157.jpg" alt="White psd template #7" border="0" /></a>
	                <span class="top"><strong>White psd template #7</strong></span>
	            </li>            
	            <li class="slider1Image">
	                <a href="cs/27-psd-part--1/2#217"><img src="<?php echo $path; ?>217.jpg" alt="Radium Neue PSDs" border="0" /></a>
	                <span class="top"><strong>Radium Neue PSDs</strong></span>
	            </li>
	            <li class="slider1Image">
	                <a href="cs/19-szare/2#120"><img src="<?php echo $path; ?>120.jpg" alt="Gray Template #10" border="0" /></a>
	                <span class="top"><strong>Gray Template #10</strong></span>
	            </li>
	        	<li class="slider1Image">
	                <a href="cs/23-biale/2#159"><img src="<?php echo $path; ?>159.jpg" alt="White psd template #9" border="0" /></a>
	                <span class="top"><strong>White psd template #9</strong></span>
	            </li>	            
			<div class="clear slider1Image"></div>
	        </ul>
	         
	    </div>
	    
	    
	    <div id="agregator" class="border">
	    <div class="title_main">Agregator</div>
	    	<div class="box_left">
	    		<ul>
	    			<?php echo $htmlFeeds; ?>
	    		</ul>
	    	</div>
	    	
	    	<div class="box_right">
	    		<a href="cs/1-antyweb-pl"><img src="/img/layout/avatars/antyweb.jpg" /></a>
	    		<a href="cs/2-wystartowali-pl"><img src="/img/layout/avatars/wystartowali.jpg" /></a>
	    		<a href="cs/3-startups-pl"><img src="/img/layout/avatars/startups.jpg" /></a>
	    		<a href="cs/4-mambiznes-pl"><img src="/img/layout/avatars/mambiznes.jpg" /></a>
	    		<a href="cs/7-startopia-pl"><img src="/img/layout/avatars/startopia.jpg" /></a>
	    		<a href="cs/8-startupy-com-pl"><img src="/img/layout/avatars/startupycom.jpg" /></a>
	    		<a href="cs/10-inwestycje-pl"><img src="/img/layout/avatars/inwestycje.jpg" /></a>
	    		<a href="cs/5-killerstartups-com"><img src="/img/layout/avatars/killerstartups.jpg" /></a>
	    		<a href="cs/6-startuplift-com"><img src="/img/layout/avatars/startuplift.jpg" /></a>
	    		<a href="cs/9-readwriteweb-com"><img src="/img/layout/avatars/readwriteweb.jpg" /></a>		    		
	    	</div>
	    </div>
	    <div id="file" class="border">
	    <div class="title_main">Do pobrania</div>
		    <div style="margin-top: 15px;">
			    <div class="border box">
			    	<a href="cs/14-technika">
			    		<img src="/module/dopobrania/files/img/195/5.jpg" />
			    		<span class="bottom"><strong>Szablony WWW</strong></span>
			    	</a> 	
			    </div>
			    
			    <div class="border box">
			    	<a href="cs/17-technika">
				    	<img src="/module/dopobrania/files/img/195/93.jpg" />
				    	<span class="bottom"><strong>Szablony PSD</strong></span>
			    	</a>
			    </div>
			    
			    <div class="border box">
			    	<a href="cs/26-part-">
			    		<img src="/module/dopobrania/files/img/195/206.jpg" />
			    		<span class="bottom"><strong>Przyciski PSD</strong></span>
			    	</a>
			    </div>
		    </div>
		    <div>
			    <div class="border box">
			    	<a href="cs/28-img-part-">
			    		<img src="/module/dopobrania/files/img/195/233.jpg" />
			    		<span class="bottom"><strong>Ikony</strong></span>
			    	</a>
			    </div>
			    <div class="border box">
			    	<a href="cs/29-part-">
			    		<img src="/module/dopobrania/files/img/195/269.jpg" />
			    		<span class="bottom"><strong>Logo PSD</strong></span>
			    	</a>
			   	</div>
			    <div class="border box">
			    	<a href="">
			    		<img src="/module/dopobrania/files/img/195/6.jpg" />
			    		<span class="bottom"><strong>Czcionki</strong></span>
			    	</a>
			    </div>
		    </div>
	    </div>

	</div>
	
	<div id="main_right">
	
		<div id="video">
			<div class="boxv">
				<div class="bodyv">
					<a href="cs/32-kominek--blog-#1"><img src="/img/graf/1.jpg" /></a>
				</div>
				<div class="titlev">
					<a href="cs/32-kominek--blog-#1">Startup School</a>
				</div>
			</div>
	
			<div class="boxv">
				<div class="bodyv">
					<a href="cs/42-konferencja#58"><img src="/img/graf/2.jpg" /></a>
				</div>
				<div class="titlev">
				<a href="cs/42-konferencja#58">Miliarderzy z przypadku</a>
				</div>
			</div>	
	
			<div class="boxv">
				<div class="bodyv">
					<a href="cs/43-rafal-agnieszczak#63"><img src="/img/graf/3.jpg" /></a>
				</div>
				<div class="titlev">
				Wywiady
				</div>
			</div>	
		</div>
	</div>
	
	


</div>