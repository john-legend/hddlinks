#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
$link = $_GET["file"];
$html = file_get_contents($link);
$link = "http://www.sensotv.ro/".str_between($html,"so.addVariable('data','","'");
$html = file_get_contents($link);
$link = str_between($html,'video="','"');
print $link;
?>
