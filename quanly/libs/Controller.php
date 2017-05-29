<?php

class Controller {
	var $controller;
	var $defaultController;
	var $controllerPath;
	
	function Controller($controllers) {
		
		foreach ( $controllers as $object ) {
			$this->registerController ( $object );
		}
		
		unset ( $object );
	}
	
	function setDefaultController($controllerName) {
		$this->defaultController = $controllerName;
	}
	
	function registerController($controllerName) {
		$this->controller [] = $controllerName;
	}
	
	function execute($admin = null) {
		
		$currentController = getInput ( 'module' );
		
		if ($currentController != '') {
			foreach ( $this->controller as $controller ) {
				if ($controller == $currentController) {
					if ($admin == null) {
						$this->loadController ( $controller );
					} else {
						$this->loadController ( $controller, 'admin' );
					}
					
					break;
				}
			}
		} else {
			if ($admin == null) {
				$this->loadController ( $this->defaultController );
			} else {
				$this->loadController ( $this->defaultController, 'admin' );
			}
		
		}
	}
	
	function loadController($controllerName, $admin = null) {
		
		$path = ($admin == null) ? CONTROLLERS_PATH : CONTROLLERS_ADMIN_PATH;
		
		if (file_exists ( $path . $controllerName . 'Controller.php' )) {
			require_once ($path . $controllerName . 'Controller.php');
		} else {
			
			$error = new Error ( null, "Đã có lỗi xảy ra về CODE, vui lòng liên hệ với Webmaster để khắc phục sự cố" );
			$error->show ();
		}
	}
}

?>