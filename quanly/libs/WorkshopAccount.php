<?php

class WorkshopAccount {
	var $WorkshopmemberID = 0;
	var $Workshopusername = "";
	var $Workshoppassword;
	var $remember = false;
	
	function WorkshopAccount($page = "") {
	
	
		$bIsReturn = false;
		
	}
	
	function LoginHandle() {
		$Workshopusername = $_POST ['Workshopusername'];
		$Workshoppassword = $_POST ['Workshoppassword'];
		
		$remember = $_POST ['remember'] ? true : false;
		if (($Workshopusername != "") && ($Workshoppassword != "")) {
			
			$this->set ( $Workshopusername, $Workshoppassword, $remember );
			if ($this->login () == true) {
				Session::redirect("index.php");
			} else {
				$messageExist = true;
				$message = "WorkshopUsername và  Workshoppassword sai";
				require_once (VIEWS_COMMON_ADMIN_PATH . 'login.tpl');
			}
		} else {
			$messageExist = false;
			require_once (VIEWS_COMMON_ADMIN_PATH . 'login.tpl');
		}
	}
	
	function checkLogined() {
		
		
		if (isset ( $_SESSION ['Workshoplogged'] )) {
						
			return $this->checkSession ();
			
		} else if (isset ( $_COOKIE ['rememberLogin'] )) {
			
			return $this->checkRemembered ( $_COOKIE ['rememberLogin'] );			
		}
		else{			
			return false;		
		}
	}
	
	function set($Workshopusername, $Workshoppassword, $remember = false) {
		$this->Workshopusername = filterFormInput ( $Workshopusername );
		$this->Workshoppassword = filterFormInput ( $Workshoppassword ) ;
		$this->remember = $remember;
	
	}
	
	function login() {
		global $db;
		$bIsLogined = false;
		
		$strQuery = "SELECT * FROM workshop_member WHERE WorkshopUsername = '$this->Workshopusername' AND WorkshopPassword = '$this->Workshoppassword'";
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
		list ( $WorkshopmemberID, $cookie ) = @unserialize ( $cookie );
		if (! $WorkshopmemberID or ! $cookie)
			return;
		
		$strQuery = "SELECT * FROM member WHERE (WorkshopMemberID = $WorkshopmemberID)";
		$query = $db->query ( $strQuery );
		if ($db->numRows ( $query ) > 0) {
		
			$values = $db->fetchArray ( $query );
			$this->setSession ( $values, true, true );
		}
		return true;
	}
	
	function emptySession() {
		$_SESSION ['Workshoplogged'] = null;
		$_SESSION ['WorkshopmemberID'] = 0;
		$_SESSION ['Workshopusername'] = 0;
		
	}
	
	function setSession(&$values, $remember, $init = true) {
		global $db;
		
		$this->WorkshopmemberID = $values ['WorkshopMemberID'];
		$_SESSION ['WorkshopmemberID'] = $this->WorkshopmemberID;
		
		$this->Workshopusername = $values ['WorkshopUsername'];
		$_SESSION ['Workshopusername'] = $values ['WorkshopUsername'];
		
		$_SESSION ['Workshoplogged'] = true;
		
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
			$cookie = serialize ( array ($_SESSION ['Workshopusername'], $cookie ) );
			Cookie::set_cookie ( 'rememberLogin', $cookie, true );
		}
	}
	
	function checkSession() {
		global $db;
		
		//var_dump($_SESSION );
		//die();
		if (isset ( $_SESSION ['WorkshopmemberID'] )) {
			
			$WorkshopmemberID = $_SESSION ['WorkshopmemberID'];
			
			$session = session_id ();
			$ip = $_SERVER ['REMOTE_ADDR'];
			
			$strQuery = "SELECT * FROM workshop_member WHERE (WorkshopMemberID = $WorkshopmemberID)";
			
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