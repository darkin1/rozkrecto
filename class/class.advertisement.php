<?php
class Advertisement {
	
	
	
	public function AdvMenuBook(){
		
		$html = '<div class="dep-wrap">
					<div class="title">Ksiązki</div>
					<div class="body">
						<ul>
							<li><a target="_blank" href="http://www.skapiec.pl/cat/1030-informatyka.html#from55552">Informatyka</a></li>
							<li><a target="_blank" href="http://www.skapiec.pl/szukaj/1030/php#from55552">PHP</a></li>
							<li><a target="_blank" href="http://www.skapiec.pl/cat/1013-ekonomia-biznes.html#from55552">Ekonomia, biznes</a></li>
							<li><a target="_blank" href="http://www.skapiec.pl/cat/1105-nauki-scisle.html#from55552">Nauki ścisłe</a></li>
							<li><a target="_blank" href="http://www.skapiec.pl/site/cat/1101/comp/401836#from55552">Inwestowanie</a></li>
						</ul>
					</div>
				</div>';
	return $html;	
	}
	
	
	public function AdvFilesHorizon(){
		$html = '<script type="text/javascript"><!--
					google_ad_client = "ca-pub-5920786410835498";
					/* text - waz linia */
					google_ad_slot = "5611511485";
					google_ad_width = 728;
					google_ad_height = 15;
					//-->
					</script>
					<script type="text/javascript"
					src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
				</script>';
	return $html;
	}
	
	
	public function AdvTextBoxMenu(){
		$html = '<div class="dep-wrap">
					<div class="title">Video</div>
						<div class="body" style="padding-left: 30px;">
							<script type="text/javascript"><!--
							google_ad_client = "ca-pub-5920786410835498";
							/* text - box menu */
							google_ad_slot = "3883560632";
							google_ad_width = 180;
							google_ad_height = 90;
							//-->
							</script>
							<script type="text/javascript"
							src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
							</script>
						</div>
				</div>';
	return $html;
	}
	
	
	public function AdvTextFilesHorizon(){
		$html= '<script type="text/javascript"><!--
					google_ad_client = "ca-pub-5920786410835498";
					/* text - waz maly */
					google_ad_slot = "3391433024";
					google_ad_width = 468;
					google_ad_height = 15;
					//-->
					</script>
					<script type="text/javascript"
					src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
					</script>';
	return $html;
	}
	
	public function ShopsBox(){
		$html = '<script type="text/javascript"><!--
					google_ad_client = "ca-pub-5920786410835498";
					/* kwadrat -- multimedia */
					google_ad_slot = "4062786344";
					google_ad_width = 250;
					google_ad_height = 250;
					//-->
					</script>
					<script type="text/javascript"
					src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
				</script>';
	return $html;
	}
}

?>