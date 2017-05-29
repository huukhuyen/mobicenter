<?php

class Session {
	
	function saveMessageSession($message, $type) {
		$_SESSION ['message'] = $message;		
		$_SESSION ['messageType'] = $type;
		
	}
	
	function getMessageSession() {
		$return = array ();
		
		if (Session::checkMessageSession ()) {
			
			$return ['message'] = $_SESSION ['message'];
			$return ['type'] = $_SESSION ['messageType'];
			$_SESSION ['message'] = '';
			$_SESSION ['messageType'] = '';
		}
		
		return $return;
	}
	
	function checkMessageSession() {
		if (isset ( $_SESSION ['message'] ) && isset ( $_SESSION ['messageType'] ) && $_SESSION ['message'] != '') {
			return true;
		} else {
			return false;
		}
	}
	
	function saveSessionRedirect($url) {
		$_SESSION ['redirect'] = $url;
	}
	
	function checkSessionRedirect() {
		if (isset ( $_SESSION ['redirect'] ) && $_SESSION ['redirect'] != '') {
			return true;
		} else {
			false;
		}
	}
	
	function getSessionRedirect() {
		$redirect = '';
		if (isset ( $_SESSION ['redirect'] ) && $_SESSION ['redirect'] != '') {
			$redirect = $_SESSION ['redirect'];
			$_SESSION ['redirect'] = '';
		}
		return $redirect;
	}
	
	function savePOSTIntoSession() {
		$_SESSION ['POST'] = serialize ( $_POST );
	}
	
	function checkPOSTFromSession() {
		if (isset ( $_SESSION ['POST'] ) && $_SESSION ['POST'] != null) {
			return true;
		} else {
			return false;
		}
	}
	
	function setPOSTFromSession() {
		$post = unserialize ( $_SESSION ['POST'] );
		if (sizeof ( $_POST ) > 0) {
			foreach ( $_POST as $key => $value ) {
				$post [$key] = $value;
			}
		}
		
		$_POST = $post;
		
		$_SESSION ['POST'] = null;
	}
	
	function redirect($url) {
		header ( "Location: " . $url );
		exit;
	}
	
	function location($controller, $task) {		
		$url = "?module=" . $controller . "&act=" . $task;
		header ( "Location: " . $url );	
	}

}

?>