<?php

class Cookie {
	
	function set_cookie($name, $value = "", $remember = 1) {
		global $CMS;
		
		if ($remember == 1) {
			$expires = time () + 60 * 60 * 24 * 365;
		}
		
		$name = $CMS->vars ['cookie_id'] . $name;
		
		@setcookie ( $name, $value, $expires, "/", "" );
	}
	
	function get_cookie($name) {
		global $CMS;
		
		if (isset ( $_COOKIE [$name] )) {
			return urldecode ( $_COOKIE [$name] );
		} else {
			return FALSE;
		}
	
	}
}

?>