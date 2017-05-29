<?php

//@ Tệp file     : DirectPosterController.cs ver 1.0 
//@ Mobile Center


new LoginController ();

class LoginController {
	
	function LoginController(){
		$trace = debug_backtrace ();
        
        $actions = array (array ("CheckLogin", "checkLogin" ), array ("Logout", "logout" ) );
        $this->action = new Action ( $trace [0] ["function"], $actions );
        $this->action->setDefaultAction ( 'Login' );
        $this->action->execute ();
	}
	
	function Login() {
		global $account;
		
		$bIsReturn = false;
		
		if ($account->checkSession () == true) {
			$bIsReturn = true;
			Session::redirect("index.php");
		} else {
			LoginController::LoginHandle ();
		}
			
	}
	
	function logout($goLoginPage = false) {
		global $account;
		
		$account->logout();
		
		if ($goLoginPage == true)
		{
			Session::location("Login", "Login");
		}
		else
		{
			Session::redirect("index.php");
		}
	}
	
	function LoginHandle() {
		global $account;
		$username = $_POST ['username'];
		$password = md5(md5($_POST ['password']));
				
		$remember = $_POST ['remember'] ? true : false;
		if (($username != "") && ($password != "")) {
			
		
			$account->set ( $username, $password, $remember );
			if ($account->login () == true) {
				
				Session::redirect("index.php");
			} else {
				$messageExist = true;
				$message = "Username và password không đúng. Vui lòng kiểm tra lại.";
				require_once (VIEWS_COMMON_PATH . 'login.tpl');
			}
		} else {
			$messageExist = false;
			require_once (VIEWS_COMMON_PATH . 'login.tpl');
		}
	}
}

?>