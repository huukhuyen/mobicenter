<?php


new HomeController ();

class HomeController {
	
	function HomeController() {
		global $head;
		
		$head['HEADER_TITLE'] = "Website";
		
		require_once(MODELS_PATH."Cms.php");
		require_once(MODELS_PATH."Picture.php");
		$url['home'] = BASE_URL;
		
		require_once (VIEWS_COMMON_PATH . 'header.tpl');
		require_once (VIEWS_PATH . 'home.tpl');
		require_once (VIEWS_COMMON_PATH . 'footer.tpl');
	}
}

?>