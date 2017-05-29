<?php

$domain = trim($_GET['domain']);

if($domain != "")
{
	$handle = fopen("http://www.pavietnam.vn/vn/whois.php?domain=".$domain, "rb");
	
	$content = stream_get_contents($handle);
	
	fclose($handle);
	
	echo trim($content);
}


?>