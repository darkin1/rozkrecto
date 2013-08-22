<div style="width: 555px; float: left;">
<div class="border">
<?php 
$objVideo = new Video;

$arrVideos=$objVideo->getVideosTop();

foreach($arrVideos as $video){
	echo $objVideo->htmlVideo($video); 
}


?>
</div>
</div>

<?php 
echo $advertisment;	
?>
