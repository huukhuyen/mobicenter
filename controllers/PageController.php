<?php


require_once (MODELS_PATH . 'Page.php');
require_once (VIEWS_PATH . 'PageView.php');

new PageController ();

class PageController {
    
    private $action;
    
    function PageController() {
        
        $trace = debug_backtrace ();
        
        $actions = array ( array ("Detail", "detail" ) );
        $this->action = new Action ( $trace [0] ["function"], $actions );
        $this->action->setDefaultAction ( 'detail' );
        $this->action->execute ();
    }
    
    function detail() {		
		$slug = getInput ( 'slug' );
		
		
        $objHandle = new Page ();
		$fields = $objHandle->getPageSlug($slug);
		
				
		
		PageView::detail ($fields);        
		
		
    }    
}

?>