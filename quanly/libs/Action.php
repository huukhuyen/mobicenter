<?php

class Action {
	var $className;
	var $action;
	var $defaultAction;
	
	function Action($className, $action) {
		
		$this->className = $className;
		foreach ( $action as $objArray ) {			
			$this->registerAction ( $objArray [0], $objArray [1] );		
		}
		unset ( $objArray );
	
	}
	
	function setDefaultAction($name) {
		$this->defaultAction = $name;
	}
	
	function registerAction($name, $func) {
		$this->action [$name] = $func;
	}
	
	function execute() {
		
		$currentAction = getInput ( 'act' );
		
		if ($currentAction != '' && is_array ( $this->action )) {
			$actionExist = false;
			
			foreach ( $this->action as $actionName => $actionFunc ) {
				if ($actionName == $currentAction) {
					$this->executeAction ( $actionFunc );
					$actionExist = true;
					break;
				}
			}
			
			if (! $actionExist) {
				$error = new Error ( null, "Controller không có" );
				$error->show ();
			}
		} else {
			$this->executeAction ( $this->defaultAction );
		}
	}
	
	function executeAction($name) {
		if (method_exists ( $this->className, $name ) == true) {
			call_user_func ( array ($this->className, $name ) );
		}
	}
}
?>