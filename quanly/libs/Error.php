<?php

class Error {
	var $messageType;	
	var $messageContent;
	
	function Error($messageType = null, $messageContent = null) {
		$this->messageType = $messageType;		
		$this->messageContent = $messageContent;
	}
	
	function show() {
		if ($this->messageType == "404") {
			require_once (VIEWS_PATH . 'error/Error404Page.tpl');
		}
		
		else if ($this->messageType == "db") {
			require_once (VIEWS_PATH . 'error/ErrorDB.tpl');
		}
		else {
			require_once (VIEWS_PATH . 'error/ErrorCode.tpl');
		}
		
		exit();
	}
	
}
?>