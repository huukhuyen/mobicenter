<?php

function getFormInput($name) {
	if (isset ( $_POST [$name] )) {
		return filterFormInput ( $_POST [$name] );
	} else {
		return '';
	}
}
function getQueryStringInput($name) {
	if (isset ( $_GET [$name] )) {
		return filterFormInput ( $_GET [$name] );
	} else {
		return '';
	}
}
function getInput($name) {
	if (isset ( $_GET [$name] )) {
		return filterFormInput ( $_GET [$name] );
	} else {
		if (isset ( $_POST [$name] )) {
			return filterFormInput ( $_POST [$name] );
		} else {
			return null;
		}
	}
}
function getInt($name) 

{
	return intval ( getInput ( $name ) );
}
function filterFormInput($string) {
	if (! get_magic_quotes_gpc ()) {
		
		$string = @addslashes ( $string );
	}
	
	$string = htmlspecialchars ( $string );
	
	return $string;
}
function parsetags($text) {
	// This is used in some blogging applications, can be uncommented for that
	// application
	// $text = str_replace("[more]", "Continued...", $text);
	
	// Lets do some generic checks
	$text = preg_replace ( "(\[b\](.+?)\[\/b\])is", '<span class="bbcode_b">$1</span>', $text ); // Bold
	$text = preg_replace ( "(\[i\](.+?)\[\/i\])is", '<span class="bbcode_i">$1</span>', $text ); // Italics
	$text = preg_replace ( "(\[u\](.+?)\[\/u\])is", '<span class="bbcode_u">$1</span>', $text ); // Underline
	$text = preg_replace ( "(\[s\](.+?)\[\/s\])is", '<span class="bbcode_strikethrough">$1</span>', $text ); // Strike
	                                                                                                      // through
	$text = preg_replace ( "(\[o\](.+?)\[\/o\])is", '<span class="bbcode_overline">$1</span>', $text ); // Overline
	$text = preg_replace ( "(\[font=(.+?)\](.+?)\[\/font\])", '<span style="font-family: $1;">$2</span>', $text ); // Font
	$text = preg_replace ( "(\[color=(.+?)\](.+?)\[\/color\])is", '<span style="color: $1">$2</span>', $text ); // Color
	$text = preg_replace ( "(\[size=(.+?)\](.+?)\[\/size\])is", '<span style="font-size: $1px">$2</span>', $text ); // Font-Size
	$text = preg_replace ( "/\[list\](.+?)\[\/list\]/is", '<ul>$1</ul>', $text ); // List
	$text = str_replace ( "[*]", "<li>", $text ); // List-Item
	                                           
	// Code and Quote Tags
	$text = preg_replace ( "(\[code\](.+?)\[\/code\])is", '<span class="bbcode_code">$1</span>', $text ); // Code
	$text = preg_replace ( "(\[url\](.+?)\[\/url\])is", '<a href="$1">$1</a>', $text ); // Code
	$text = preg_replace ( "(\[quote\](.+?)\[\/quote\])is", '<span class="bbcode_quote">$1</span>', $text ); // Quote
	                                                                                                      
	// Allow images?
	if (isset ( $GLOBALS ['allow_image'] ) && ($GLOBALS ['allow_image'] == 1)) {
		$text = preg_replace ( "/\[img\](.+?)\[\/img\]/", '<img src="$1" class="bbcode_img" />', $text ); // Image
		$text = preg_replace ( "/\[img\=([0-9]*)x([0-9]*)\](.+?)\[\/img\]/", '<img src="$3" class="bbcode_img" height="$2" width="$1" />', $text ); // Image
		                                                                                                                                         // with
		                                                                                                                                         // width
		                                                                                                                                         // and
		                                                                                                                                         // height
	} else {
		$text = preg_replace ( "/\[img\](.+?)\[\/img\]/", 'Admin has not allowed images!', $text ); // Image
		$text = preg_replace ( "/\[img\=([0-9]*)x([0-9]*)\](.+?)\[\/img\]/", 'Admin has not allowed images!', $text ); // Image
		                                                                                                            // with
		                                                                                                            // width
		                                                                                                            // and
		                                                                                                            // height
	}
	
	return $text;
}
function stripslashes_deep($value) 

{
	$value = is_array ( $value ) ? 

	array_map ( 'stripslashes_deep', $value ) : 

	stripslashes ( $value );
	
	return $value;
}
function compact_content($string, $number_line) 

{
	$arr = explode ( ".", $string );
	
	if (sizeof ( $arr ) < $number_line) 

	{
		
		$arr = explode ( "\n", $string );
	}
	
	if (sizeof ( $arr ) < $number_line) 

	{
		
		return $string;
	} 

	else 

	{
		
		$new_string = "";
		
		for($i = 0; $i < $number_line; $i ++) 

		{
			
			$new_string .= $arr [$i] . ".";
		}
		
		return $new_string;
	}
}
function handle_content($content) {
	$content = htmlspecialchars_decode ( $content );
	$content = parsetags ( $content );
	
	// @ REPLACE
	
	$source = array (
			"font: medium 'Times New Roman';",
			"size=\"2\"",
			"font-size: x-small;",
			"font-size: small;",
			"font-size: xx-large",
			"font-size: x-large",
			"font-size: large",
			"style=\"font-size: medium; \"",
			"; font-size: medium;",
			"font-size: medium;",
			"font-size: 30pt",
			"font-size: 29pt",
			"font-size: 28pt",
			"font-size: 27pt",
			"font-size: 26pt",
			"font-size: 25pt",
			"font-size: 24pt",
			"font-size: 23pt",
			"font-size: 22pt",
			"font-size: 21pt",
			"font-size: 20pt",
			"font-size: 19pt",
			"font-size: 17pt",
			"font-size: 16pt",
			"font-size: 15pt",
			"font-size: 14pt",
			"font-size: 13pt",
			"font-size: 12pt",
			"font-family: verdana",
			
			"font-family: times new roman",
			"font-family: tahoma",
			"font-family: 'times new roman'",
			"font-family: Times New Roman",
			"font-family: 'Times New Roman'",
			"<img ",
			"<p>&nbsp;</p>",
			"font-family: Arial;",
			"face=\"Arial\"",
			"style=\"; ",
			"\"../uploads/" 
	);
	$replace = array (
			"",
			"",
			"",
			"",
			"font-weight:bold",
			"font-weight:bold",
			"",
			"",
			"",
			"",
			"",
			"",
			"",
			"",
			"",
			"",
			"",
			"",
			"",
			"",
			"",
			"",
			"",
			"",
			"",
			"",
			"",
			"",
			"font-family: arial",
			"",
			"",
			"",
			"",
			"",
			"<img class=\"rao\"",
			"",
			"",
			"",
			"style=\"",
			"\"" . BASE_URL . "uploads/" 
	);
	
	$content = str_replace ( $source, $replace, $content );
	$content = check_tag_html ( $content );
	
	$content = checkNumberTag ( $content, "table" );
	$content = checkNumberTag ( $content, "div" );
	
	return trim ( $content );
}
function checkNumberTag($content, $tag) {
	$BeginDiv = substr_count ( $content, '<' . $tag . '' );
	$EndDiv = substr_count ( $content, '</' . $tag . '>' );
	
	if ($BeginDiv > $EndDiv) {
		for($i = 0; $i < ($BeginDiv - $EndDiv); $i ++) {
			$content .= "</" . $tag . ">";
		}
	} else if ($BeginDiv < $EndDiv) {
		for($i = 0; $i < ($EndDiv - $BeginDiv); $i ++) {
			$content = "<" . $tag . ">" . $content;
		}
	}
	
	return $content;
}
function check_tag_html($content) {
	return $content;
}
function get_virtual_link($url) {
	$url = htmlspecialchars_decode ( $url );
	
	$url = str_replace ( " - ", "-", $url );
	
	$url = str_replace ( "-", "-", $url );
	$url = str_replace ( "=", "-", $url );
	$url = str_replace ( "(", "", $url );
	$url = str_replace ( ")", "", $url );
	
	$url = str_replace ( "–", "-", $url );
	
	$url = str_replace ( "&", "-", $url );
	$url = str_replace ( "~", "-", $url );
	
	$url = str_replace ( "!", "", $url );
	$url = str_replace ( ";", "", $url );
	
	$url = str_replace ( "@", "", $url );
	
	$url = str_replace ( ":", "", $url );
	
	$url = str_replace ( "+", "", $url );
	
	$url = str_replace ( "'", "-", $url );
	
	$url = str_replace ( " : ", " ", $url );
	
	$url = str_replace ( "  ", " ", $url );
	
	$url = str_replace ( ",", " ", $url );
	
	$url = str_replace ( " ", "-", $url );
	
	$url = str_replace ( "?", "-", $url );
	
	$url = str_replace ( "%", "-", $url );
	
	$url = str_replace ( "#", "-", $url );
	$url = str_replace ( "$", "-", $url );
	$url = str_replace ( ">", "-", $url );
	
	$url = str_replace ( "*", "", $url );
	
	$url = str_replace ( ".", "-", $url );
	$url = str_replace ( "/", "", $url );
	
	$url = str_replace ( "\"", "-", $url );
	
	$url = str_replace ( "►", "", $url );
	$url = str_replace ( "<", "", $url );
	$url = str_replace ( "<", "", $url );
	
	$url = str_replace ( ">", "", $url );
	
	$url = str_replace ( "█", "", $url );
	
	$url = khongdau ( $url );
	$url = strtolower ( $url );
	
	$url = str_replace ( "----", "-", $url );
	$url = str_replace ( "---", "-", $url );
	$url = str_replace ( "--", "-", $url );
	$url = str_replace ( "--", "-", $url );
	$url = str_replace ( "--", "-", $url );
	
	$url = substr ( $url, 0, 1 ) == "-" ? substr ( $url, 1, strlen ( $url ) - 1 ) : $url;
	
	return $url;
}
function khongdau($str) {
	$str = preg_replace ( "/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str );
	
	$str = preg_replace ( "/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str );
	
	$str = preg_replace ( "/(ì|í|ị|ỉ|ĩ|ỉ)/", 'i', $str );
	
	$str = preg_replace ( "/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ|ó)/", 'o', $str );
	
	$str = preg_replace ( "/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str );
	
	$str = preg_replace ( "/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str );
	
	$str = preg_replace ( "/(đ)/", 'd', $str );
	
	$str = preg_replace ( "/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str );
	
	$str = preg_replace ( "/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str );
	
	$str = preg_replace ( "/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str );
	
	$str = preg_replace ( "/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str );
	
	$str = preg_replace ( "/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str );
	
	$str = preg_replace ( "/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str );
	
	$str = preg_replace ( "/(Đ)/", 'D', $str );
	
	return $str;
}
function yahoo_status($id) {
	$file = @file ( "http://opi.yahoo.com/online?u=" . urlencode ( $id ) . "&m=t&t=1" );
	
	if (is_array ( $file )) {
		
		return ( bool ) ($file [0] == "01");
	}
	
	return null;
}
function is_valid_email($email) {
	return preg_match ( '/[.+a-zA-Z0-9_-]+@[a-zA-Z0-9-]+.[a-zA-Z]+/', $email );
}

//
function send_mail($nguoigoi, $nguoinhan, $tieude, $noidung) {
	$header = "From: " . $nguoigoi . "\n";
	$header .= "Content-Type:text/html;";
	$header .= "charset=UTF-8\n";
	$noidung = str_replace ( "\n", "<br>", $noidung );
	$noidung = str_replace ( "  ", "&nbsp; ", $noidung );
	$noidung = str_replace ( "<script>", "&lt;script&gt;", $noidung );
	
	$noidung = $noidung . "<br><hr><font size=2 face='verdana' color=blue>Van Loi Hotel<br>http://vanloihotelhoian.com</font>";
	
	return (@mail ( $nguoinhan, $tieude, "$noidung", "$header" ));
}
function start_page_load() {
	global $start;
	$time = microtime ();
	$time = explode ( " ", $time );
	$time = $time [1] + $time [0];
	$start = $time;
}
function end_page_load() {
	global $start;
	$time = microtime ();
	$time = explode ( " ", $time );
	$time = $time [1] + $time [0];
	$finish = $time;
	$totaltime = ($finish - $start);
	$totaltimeSecond = number_format ( $totaltime, 5, '.', '' ) . " giây";
	return $totaltimeSecond;
}
function check_active($name) {
	if ($name == "") {
		if ($_SERVER ['QUERY_STRING'] == "") {
			echo " class=\"active\"";
		}
	} else {
		$current = $_SERVER ['QUERY_STRING'];
		
		if (strrpos ( $current, "&type=" . $name ) != "") {
			echo " class=\"active\"";
		}
	}
}
function check_active2($name) {
	$current = $_SERVER ['QUERY_STRING'];
	
	if (strrpos ( $current, $name ) != "") {
		echo " class=\"active\"";
	}
	
	if (strrpos ( $current, "Picture" ) != "") {
		echo " class=\"active\"";
	}
	
	if (strrpos ( $current, "Video" ) != "") {
		echo " class=\"active\"";
	}
	
	if (strrpos ( $current, "Books" ) != "") {
		echo " class=\"active\"";
	}
}
function check_lienhe() {
	$current = $_SERVER ['QUERY_STRING'];
	
	if (strrpos ( $current, 'lien-he' ) != "") {
		echo " class=\"active\"";
	}
}
function getJS($url) {
	global $head;
	$result = "";
	if (is_array ( $url ) && count ( $url ) > 0) {
		foreach ( $url as $link ) {
			$result .= "<script type=\"text/javascript\" src=\"" . JS_URL . $link . "\"></script>\n\t\t";
		}
	} else {
		$result .= "<script type=\"text/javascript\" src=\"" . JS_URL . $url . "\"></script>\n\t\t";
	}
	
	$head ['HEADER_JS'] .= $result;
}
function getCSS($url) {
	global $head;
	$result = "";
	if (is_array ( $url ) && count ( $url ) > 0) {
		foreach ( $url as $link ) {
			$result .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"" . CSS_URL . $link . "\"  media=\"screen\" />\n\t\t";
		}
	} else {
		$result .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"" . CSS_URL . $url . "\"  media=\"screen\" />\n\t\t";
	}
	
	$head ['HEADER_CSS'] .= $result;
}
function showCounter($counter, $url) {
	$show = "";
	
	$count_number = ( string ) ($counter);
	
	while ( strlen ( $count_number ) < 7 ) {
		$count_number = "0" . $count_number;
	}
	
	$len = strlen ( $count_number );
	while ( $len != $i && $len != 0 ) {
		$show .= "<img src=" . $url . "images/counter/" . $count_number [$i] . ".png>";
		$i ++;
	}
	return $show;
}
function pingSE($url) {
	@file_get_contents ( "http://www.google.com/webmasters/tools/ping?sitemap=" . $url );
	@file_get_contents ( "http://search.yahooapis.com/SiteExplorerService/V1/updateNotification?appid=YahooDemo&url=" . $url );
	@file_get_contents ( "http://www.bing.com/webmaster/ping.aspx?siteMap=" . $url );
	@file_get_contents ( "http://submissions.ask.com/ping?sitemap=" . $url );
}
function pingGoogleSitemaps($url_xml) {
	$status = 0;
	$google = 'www.google.com';
	if ($fp = @fsockopen ( $google, 80 )) {
		$req = 'GET /webmasters/sitemaps/ping?sitemap=' . urlencode ( $url_xml ) . " HTTP/1.1\r\n" . "Host: $google\r\n" . "User-Agent: Mozilla/5.0 (compatible; " . PHP_OS . ") PHP/" . PHP_VERSION . "\r\n" . "Connection: Close\r\n\r\n";
		fwrite ( $fp, $req );
		while ( ! feof ( $fp ) ) {
			if (@preg_match ( '~^HTTP/\d\.\d (\d+)~i', fgets ( $fp, 128 ), $m )) {
				$status = intval ( $m [1] );
				break;
			}
		}
		fclose ( $fp );
	}
	return ($status);
}
function title_style($strInput) {
	
	// $strInput = mb_strtolower($strInput, 'UTF-8');
	// $strInput = mb_ucasefirst($strInput);
	return $strInput;
}
function mb_ucasefirst($str) {
	$str [0] = mb_strtoupper ( $str [0] );
	return $str;
}
function detect_mobile() {
	if (preg_match ( '/(alcatel|amoi|android|avantgo|blackberry|benq|cell|cricket|docomo|elaine|htc|iemobile|iphone|ipad|ipaq|ipod|j2me|java|midp|mini|mmp|mobi|motorola|nec-|nokia|palm|panasonic|philips|phone|sagem|sharp|sie-|smartphone|sony|symbian|t-mobile|telus|up\.browser|up\.link|vodafone|wap|webos|wireless|xda|xoom|zte)/i', $_SERVER ['HTTP_USER_AGENT'] ))
		return true;
	
	else
		return false;
}
function checkWorkshopPermission($fields, $PermissionID) {
	// var_dump($fields);
	$bIsReturn = false;
	if (count ( $fields ) > 0) {
		foreach ( $fields as $url ) {
			if ($url ['WorkshopPermissionID'] == $PermissionID) {
				
				$bIsReturn = true;
				break;
			}
		}
	}
	
	return $bIsReturn;
}


function extract_email_address ($string) {
    
    $string = strip_tags(html_entity_decode($string));
    
    $emails = explode("\n", html_entity_decode($string));
    
    return $emails;
}
?>