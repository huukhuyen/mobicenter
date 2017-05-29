<?php

class PracticeAccount {
	var $PracticememberID = 0;
	var $Practiceusername = "";
	var $Practicepassword;
	var $remember = false;
	
	function PracticeAccount($page = "") {
	
	
		$bIsReturn = false;
		
	}
	
	function LoginHandle() {
		$Practiceusername = $_POST ['Practiceusername'];
		$Practicepassword = $_POST ['Practicepassword'];
		
		$remember = $_POST ['remember'] ? true : false;
		if (($Practiceusername != "") && ($Practicepassword != "")) {
			
			$this->set ( $Practiceusername, $Practicepassword, $remember );
			if ($this->login () == true) {
				Session::redirect("index.php");
			} else {
				$messageExist = true;
				$message = "PracticeUsername và  Practicepassword sai";
				require_once (VIEWS_COMMON_ADMIN_PATH . 'login.tpl');
			}
		} else {
			$messageExist = false;
			require_once (VIEWS_COMMON_ADMIN_PATH . 'login.tpl');
		}
	}
	
	function checkLogined() {
		

		if (isset ( $_SESSION ['Practicelogged'] )) {
						
			return $this->checkSession ();
			
		} else if (isset ( $_COOKIE ['rememberLogin'] )) {
			
			return $this->checkRemembered ( $_COOKIE ['rememberLogin'] );			
		}
		else{			
			return false;		
		}
	}
	
	function set($Practiceusername, $Practicepassword, $remember = false) {
		$this->Practiceusername = filterFormInput ( $Practiceusername );
		$this->Practicepassword = filterFormInput ( $Practicepassword ) ;
		$this->remember = $remember;
	
	}
	
	function login() {
		global $db;
		$bIsLogined = false;
		
		$strQuery = "SELECT * FROM practice_member WHERE PracticeUsername = '$this->Practiceusername' AND PracticePassword = '$this->Practicepassword'";
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
		list ( $PracticememberID, $cookie ) = @unserialize ( $cookie );
		if (! $PracticememberID or ! $cookie)
			return;
		
		$strQuery = "SELECT * FROM member WHERE (PracticeMemberID = $PracticememberID)";
		$query = $db->query ( $strQuery );
		if ($db->numRows ( $query ) > 0) {
		
			$values = $db->fetchArray ( $query );
			$this->setSession ( $values, true, true );
		}
		return true;
	}
	
	function emptySession() {
		$_SESSION ['Practicelogged'] = null;
		$_SESSION ['PracticememberID'] = 0;
		$_SESSION ['Practiceusername'] = 0;
		
	}
	
	function setSession(&$values, $remember, $init = true) {
		global $db;
		
		$this->PracticememberID = $values ['PracticeMemberID'];
		$_SESSION ['PracticememberID'] = $this->PracticememberID;
		
		$this->Practiceusername = $values ['PracticeUsername'];
		$_SESSION ['Practiceusername'] = $values ['PracticeUsername'];
		
		$_SESSION ['Practicelogged'] = true;
		
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
			$cookie = serialize ( array ($_SESSION ['Practiceusername'], $cookie ) );
			Cookie::set_cookie ( 'rememberLogin', $cookie, true );
		}
	}
	
	function checkSession() {
		global $db;
		
		//var_dump($_SESSION );
		//die();
		if (isset ( $_SESSION ['PracticememberID'] )) {
			
			$PracticememberID = $_SESSION ['PracticememberID'];
			
			$session = session_id ();
			$ip = $_SERVER ['REMOTE_ADDR'];
			
			$strQuery = "SELECT * FROM practice_member WHERE (PracticeMemberID = $PracticememberID)";
			
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