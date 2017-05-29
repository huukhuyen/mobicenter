<?php


require_once (MODELS_PATH . 'Video.php');
require_once (MODELS_PATH . 'VideoCategories.php');
require_once (VIEWS_PATH . 'VideoView.php');



new VideoController ();

class VideoController {
    
    private $action;
    
    function VideoController() {
        
        $trace = debug_backtrace ();
        
        $actions = array (array ("ViewList", "viewlist" ), array ("Detail", "detail" ) );
        $this->action = new Action ( $trace [0] ["function"], $actions );
        $this->action->setDefaultAction ( 'viewlist' );
        $this->action->execute ();
    }
    
    function viewlist() {
	
		global $head, $url;
		getJS("jquery-ui.min.js");
		getJS("jquery.youtubepopup.min.js");
		getJS("highslide-with-html.js");
	
		$type = "video";
        $currentPage = getInput("currentPage");
        $currentPage = $currentPage ? $currentPage : "1";
        $totalDisplay = getInput("totalDisplay");
        $totalDisplay = $totalDisplay ? $totalDisplay :"10";
        $orderby = "DateUpdated";
        
        $objHandle = new Video ();
		$displayItem = $objHandle->getAllActiveVideo();
		
		$itemCount = count($displayItem); 
        
        //@ Display
        $previousPage = $currentPage - 1;
        $nextPage = $currentPage + 1;
        
        $firstLi = ($currentPage == 1 || $currentPage == 2) ? "" : "<li class='non_page'><a href='{$url['home']}{$type}/trang-1/'>1</a></li>";
        $firstLi .= (($currentPage == 1 || $currentPage == 2) || $currentPage == 3) ? "" : "<li>...</li>";
        $previousLi = ($currentPage == 1) ? "" : "<li class='non_page'><a href='{$url['home']}{$type}/trang-{$previousPage}/'>{$previousPage}</a></li>";
        $lastLi = ($itemCount == $totalDisplay) ? "<li class='non_page'><a href='{$url['home']}{$type}/trang-{$nextPage}/'>{$nextPage}</a></li>" : "";
        
		
		if ($itemCount/$totalDisplay > 1)
		{
        $footer =<<<EOF
		        
        <ul class="list_page">
        	<li style="margin-right:10px;"></li>
        	{$firstLi}
        	{$previousLi}
        	<li class='current_page'><a href='{$url['home']}{$type}/trang-{$previousPage}/'>{$currentPage}</a></li>        	
        	{$lastLi}  
		
EOF;
		}
        VideoView::viewList ( $displayItem, $footer );
        
		
    }
	
	
	function detail() {
	
		global $head;
		getJS("jquery-ui.min.js");
		getJS("jquery.youtubepopup.min.js");
		getJS("highslide-with-html.js");
		
		
		
        $Slug = getInput ( 'Slug' );
        
		$objHandle = new Video ();
		$objHandleCat = new VideoCategories ();
				
		$fields = $objHandle->getVideoByCategory($Slug);
		
        VideoView::detail($fields, $cat);
    }
    
}

?>

