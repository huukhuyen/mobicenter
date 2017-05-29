<?php

$domain = trim($_GET['domain']);

if($domain != "")
{
	$handle = fopen("http://pavietnam.vn/vn/whois.php?domain=".$domain."&cmd=getwhois", "rb");
	
	$content = stream_get_contents($handle);
	
	fclose($handle);
	
	echo trim($content);
}


?>