<?php

define('DEBUG_SQL',1);
define('DEBUG_MSG',2);

set_error_handler("Debug_Log::php_error");

class Debug_Log{

	private static $log = array();
	private static $php_errors = array();
	private static $sql_log = array();

	public static function add($msg,$type = DEBUG_MSG){
		switch($type){
			case DEBUG_SQL : self::$sql_log[] = $msg; break;
			case DEBUG_MSG :
				if(is_array($msg) || is_object($msg)) $msg = var_export($msg,true);
				self::$log[] = $msg;
				break;
		}
	}

	public static function php_error($eno,$estr,$efile,$eline){
		switch($eno){
			case E_ERROR		:
			case E_USER_ERROR	: 	$etype = 'FATAL'; $ecol = 'FB8585'; break;
			case E_WARNING		:
			case E_USER_WARNING	:	$etype = 'WARNING'; $ecol = 'EEEC96'; break;
			case E_NOTICE		:
			case E_USER_NOTICE	:	$etype = 'NOTICE'; $ecol = 'A0EE96'; break;
			case E_STRICT		:	$etype = 'STRICT'; $ecol = 'C1F8F9'; break;
			case E_DEPRECATED	:
			case E_USER_DEPRECATED:	$etype = 'DEPRECATED'; break;
			default	:	$etype = $eno; break;
		}
		self::$php_errors[] = sprintf('<span style="background-color:#%s">[ %s ] [ %s :: %d] => %s</span>',$ecol,$etype,$efile,$eline,$estr);
	}

public static function display(){
?>
<script type="text/javascript">
		window.onload = function(){
			$("#debugButton").bind('click',function(){
				switch($("#debugContent").css("display")){
				case 'none' : $("#debugWDW").css({"width":"98%"});$("#debugContent").slideDown("slow"); break;
				case 'block': $("#debugContent").slideUp("slow",function(){$("#debugWDW").css({"width":"130px"})}); break;
				}
			})
		}
		</script>
<style type="text/css">
#debugWDW {
	z-index: 1000;
	position: fixed;
	top: 0;
	background-color: transparent;
	width: 200px;
	margin: 0 auto;
	font-size: 10px;
	font-family: Monaco;
}

#debugContent {
	z-index: 1000;
	overflow: auto;
	height: 440px;
	margin: 0 auto;
	display: none;
	padding: 6px;
	border: 4px #aaa solid;
	background-color: #fff;
	width: 100%;
}

#debugContent pre {
	font-size: 11px
}

#debugButton {
	z-index: 1000;
	position: relative;
	height: 16px;
	text-align: center;
	font-size: 18px;
	width: 100px;
	font-weight: bold;
	margin-left: 8px;
	background-color: #aaa;
	padding: 4px 4px 12px 4px
}
</style>
<div id="debugWDW">
<div id="debugContent"><?php
$qt = 0;
$qt_max = 0;
echo "<h2>Zapytania SQL:</h2>";
$sql_log = '';
foreach(self::$sql_log as $i => $q){
	var_dump($q['error']);
	$qt += $q['time'];
	$q['query'] = htmlentities($q['query']);
	if($q['time'] > $qt_max) { $qt_max = $q['time']; $qt_max_id = $i; }
	if(strpos(strtolower($q['query']),'reset') !== false || strpos(strtolower($q['query']),'delete') !== false || strpos(strtolower($q['query']),'sql_no_cache') !== false)
	$txt_ptrn = "<a name=\"debug_sql_".$i."\">[%02d]</a> (%.3fms) <span style=\"background-color:#FB8585\">%s</span><br/>";
	elseif(strpos(strtolower($q['query']),'update') !== false)
	$txt_ptrn = "<a name=\"debug_sql_".$i."\">[%02d]</a> (%.3fms) <span style=\"background-color:#EEEC96\">%s</span><br/>";
	else
	$txt_ptrn = "<a name=\"debug_sql_".$i."\">[%02d]</a> (%.3fms) <span style=\"background-color:#A0EE96\">%s</span><br/>";
	$sql_log .= sprintf($txt_ptrn,$i, ($q['time']*1000),$q['query']);
	if(isset($q['error'])) $sql_log .= '<p style="color:red">'.$q['error'].'</p>';
}
echo '<span style="font-size:12px">Wykonano <b>'.count(self::$sql_log).'</b> zapytań w <b>'.round($qt*1000,3).'</b> ms. Najdłuższe zapytanie trwało <b>'.round($qt_max*1000,3).'</b> ms ('.round($qt_max*100/$qt,2).'%)</b> [<a href="#debug_sql_'.$qt_max_id.'">'.$qt_max_id.'</a>]</span><br/>';
//var_dump($sql_log);
echo '<h2>ZAPYTANIA SQL</h2>';
foreach(self::$sql_log as $sql_l){
	echo var_dump($sql_l);
}

echo '<h2>Błędy PHP</h2>';
foreach(self::$php_errors as $error){
	echo $error.'<br/>';
}
self::add('Użycie pamięci: <b>'.round(memory_get_usage()/1024,3).'</b> kB<br/>',DEBUG_MSG);
self::add('Includowane pliki:<br/>'.implode('<br/>',get_included_files()),DEBUG_MSG);
echo '<h2>Pozostałe informacje</h2>';
foreach(self::$log as $error){
	echo $error.'<br/>';
}
echo '<h2>$_GET:</h2><pre>';
echo htmlentities(var_export($_GET,true));
echo '</pre><h2>$_POST:</h2><pre>';
echo htmlentities(var_export($_POST,true));
echo '</pre><h2>$_CLEAN:</h2><pre>';
global $_CLEAN;
echo htmlentities(var_export($_CLEAN,true));
echo '</pre><h2>$_SESSION:</h2><pre>';
echo htmlentities(var_export($_SESSION,true));
echo '</pre><h2>$_SERVER:</h2><pre>';
echo htmlentities(var_export($_SERVER,true));
echo '</pre></div><div id="debugButton">debug</div></div>';
	}

}
?>