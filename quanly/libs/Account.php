<?php

class Account {
	var $memberID = 0;
	var $username = "";
	var $password;
	var $remember = false;
	
	function Account($page = "") {
		$bIsReturn = false;
		
		if ($this->checkLogined () == true) {
						
		} else {			
			if ($page == "cp") {				
				$this->LoginHandle ();
				exit();
			}
		}
	}
	
	function LoginHandle() {
		$username = $_POST ['username'];
		$password = $_POST ['password'];
		
		$remember = $_POST ['remember'] ? true : false;
		if (($username != "") && ($password != "")) {
			
			$this->set ( $username, $password, $remember );
			if ($this->login () == true) {
				Session::redirect("index.php");
			} else {
				$messageExist = true;
				$message = "Username và  password sai";
				require_once (VIEWS_COMMON_ADMIN_PATH . 'login.tpl');
			}
		} else {
			$messageExist = false;
			require_once (VIEWS_COMMON_ADMIN_PATH . 'login.tpl');
		}
	}
	
	function checkLogined() {
		if (isset ( $_SESSION ['logged'] )) {			
			return $this->checkSession ();
			
		} else if (isset ( $_COOKIE ['rememberLogin'] )) {
			return $this->checkRemembered ( $_COOKIE ['rememberLogin'] );			
		}
		else{			
			return false;		
		}
	}
	
	function set($username, $password, $remember = false) {
		$this->username = filterFormInput ( $username );
		$this->password = filterFormInput ( md5 ( md5 ( $password ) ) );
		$this->remember = $remember;	
	}
	
	function login() {
		global $db;
		$bIsLogined = false;
		
		$query = $db->query ( "SELECT * FROM member WHERE Username = '$this->username' AND Password = '$this->password'" );
		
		if ($db->numRows ( $query ) > 0) {
			$row = $db->fetchArray ( $query );
			$this->setSession ( $row, $this->remember );
			$bIsLogined = true;
		
		} else {

			$bIsLogined = false;
		}
		
		return $bIsLogined;
	}
	
	function checkRemembered($cookie) {
		global $db;
		list ( $memberID, $cookie ) = @unserialize ( $cookie );
		if (! $memberID or ! $cookie)
			return;
		
		$strQuery = "SELECT * FROM member WHERE (MemberID = $memberID) AND (CookieID = $cookie)";
		$query = $db->query ( $strQuery );
		if ($db->numRows ( $query ) > 0) {
			$values = $db->fetchArray ( $query );
			$this->setSession ( $values, true, true );
		}
		return true;
	}
	
	function emptySession() {
		$_SESSION ['logged'] = null;
		$_SESSION ['memberID'] = 0;
		$_SESSION ['username'] = 0;
		$_SESSION ['groupID'] = 0;
		$_SESSION ['cookie'] = 0;		
	}
	
	function setSession(&$values, $remember, $init = true) {
		global $db;
		
		$this->memberID = $values ['MemberID'];
		$_SESSION ['memberID'] = $this->memberID;
		$_SESSION ['groupID'] = $values ['GroupID'];
		$this->username = $values ['Username'];
		$_SESSION ['username'] = $values ['Username'];
		$_SESSION ['cookie'] = $values ['Cookie'];
		$_SESSION ['logged'] = true;
		
		if ($remember) {
			$this->updateCookie ( $values ['Cookie'], true );
		}
		if ($init) {
			$session = session_id ();
			$ip = $_SERVER ['REMOTE_ADDR'];
			
			$strQuery = "UPDATE member SET SessionID = '$session', IPAddress = '$ip' WHERE " . "MemberID = $this->memberID";
			$db->query ( $strQuery );
		}
	
		//setcookie ( "memberID", SESSION_ID, time () + $this->sessionExpired );
	//setcookie ( "groupID", SESSION_ID, time () + $this->sessionExpired );
	}
	
	function updateCookie($cookie, $save) {
		$_SESSION ['Cookie'] = $cookie;
		if ($save) {
			$cookie = serialize ( array ($_SESSION ['username'], $cookie ) );
			Cookie::set_cookie ( 'rememberLogin', $cookie, true );
		}
	}
	
	function checkSession() {
		global $db;
		
		if (isset ( $_SESSION ['memberID'] )) {
			$memberID = $_SESSION ['memberID'];
			$session = session_id ();
			$ip = $_SERVER ['REMOTE_ADDR'];
			
			$strQuery = "SELECT * FROM member WHERE (MemberID = $memberID) AND (SessionID = '$session') AND (IPAddress = '$ip')";
			
			$query = $db->query ( $strQuery );
			
			if ($db->numRows ( $query ) > 0) {
				$values = $db->fetchArray ( $query );
				$this->setSession ( $values, false, false );
				return true;
			
			} else {
				$this->logout ();
				return false;
			}
		} else {
			return false;
		}
	}
	
	function logout() {
		$this->emptySession ();
	}
}
?>