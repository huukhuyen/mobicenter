<?php

class PracticeCompanyAccount {
	var $PracticeCompanyID = 0;
	var $PracticeCompanyEmail = "";
	var $Password;
	var $remember = false;
	
	function PracticeCompanyAccount($page = "") {
	
	
		$bIsReturn = false;
		
	}
	
	function LoginHandle() {
		$Email = $_POST ['Email'];
		$Password = $_POST ['Password'];
		
		$remember = $_POST ['remember'] ? true : false;
		if (($Email != "") && ($Password != "")) {
			
			$this->set ( $Email, $Password, $remember );
			if ($this->login () == true) {
				Session::redirect("index.php");
			} else {
				$messageExist = true;
				$message = "Email và  mật khẩu sai";
				require_once (VIEWS_COMMON_ADMIN_PATH . 'login.tpl');
			}
		} else {
			$messageExist = false;
			require_once (VIEWS_COMMON_ADMIN_PATH . 'login.tpl');
		}
	}
	
	function checkLogined() {
		

		if (isset ( $_SESSION ['PracticeCompanylogged'] )) {
						
			return $this->checkSession ();
			
		} else if (isset ( $_COOKIE ['rememberLogin'] )) {
			
			return $this->checkRemembered ( $_COOKIE ['rememberLogin'] );			
		}
		else{			
			return false;		
		}
	}
	
	function set($Email, $Password, $remember = false) {
		$this->Email = filterFormInput ( $Email );
		$this->Password = filterFormInput ( $Password ) ;
		$this->remember = $remember;
	
	}
	
	function login() {
		global $db;
		$bIsLogined = false;
		
		$strQuery = "SELECT * FROM practice_company WHERE (Email = '$this->Email' OR EmailContact = '$this->EmailContact') AND Password = '$this->Password'";
		//die($strQuery);
		$query = $db->query ( $strQuery );

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
		list ( $PracticeCompanyID, $cookie ) = @unserialize ( $cookie );
		if (! $PracticeCompanyID or ! $cookie)
			return;
		
		$strQuery = "SELECT * FROM member WHERE (PracticeCompanyID = $PracticeCompanyID)";
		$query = $db->query ( $strQuery );
		if ($db->numRows ( $query ) > 0) {
		
			$values = $db->fetchArray ( $query );
			$this->setSession ( $values, true, true );
		}
		return true;
	}
	
	function emptySession() {
		$_SESSION ['PracticeCompanylogged'] = null;
		$_SESSION ['PracticeCompanyID'] = 0;
		$_SESSION ['PracticeCompanyEmail'] = 0;
		
	}
	
	function setSession(&$values, $remember, $init = true) {
		global $db;
		
		$this->PracticeCompanyID = $values ['PracticeCompanyID'];
		$_SESSION ['PracticeCompanyID'] = $this->PracticeCompanyID;
		
		$this->PracticeCompanyEmail = $values ['Email'];
		$_SESSION ['PracticeCompanyEmail'] = $values ['Email'];
		
		$_SESSION ['PracticeCompanylogged'] = true;
		
		if ($remember) {
			$this->updateCookie ( $values ['Cookie'], true );
		}
		if ($init) {
			$session = session_id ();
			$ip = $_SERVER ['REMOTE_ADDR'];
			
			
			//$db->query ( $strQuery );
		}
	
		//setcookie ( "memberID", SESSION_ID, time () + $this->sessionExpired );
	//setcookie ( "groupID", SESSION_ID, time () + $this->sessionExpired );
	}
	
	function updateCookie($cookie, $save) {
		$_SESSION ['Cookie'] = $cookie;
		if ($save) {
			$cookie = serialize ( array ($_SESSION ['PracticeCompanyEmail'], $cookie ) );
			Cookie::set_cookie ( 'rememberLogin', $cookie, true );
		}
	}
	
	function checkSession() {
		global $db;
		
		//var_dump($_SESSION );
		//die();
		if (isset ( $_SESSION ['PracticeCompanyID'] )) {
			
			$PracticeCompanyID = $_SESSION ['PracticeCompanyID'];
			
			$session = session_id ();
			$ip = $_SERVER ['REMOTE_ADDR'];
			
			$strQuery = "SELECT * FROM practice_company WHERE (PracticeCompanyID = $PracticeCompanyID)";
			
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