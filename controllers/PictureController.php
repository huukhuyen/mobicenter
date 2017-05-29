<?php


require_once (MODELS_PATH . 'Picture.php');
require_once (MODELS_PATH . 'PictureCategories.php');
require_once (VIEWS_PATH . 'PictureView.php');

new PictureController ();

class PictureController {
    
    private $action;
    
    function PictureController() {
        
        $trace = debug_backtrace ();
        
        $actions = array (array ("ViewList", "viewlist" ), array ("Detail", "detail" ) );
        $this->action = new Action ( $trace [0] ["function"], $actions );
        $this->action->setDefaultAction ( 'viewlist' );
        $this->action->execute ();
    }
    
    function viewlist() {
    	global $url;
		$type = "hinh-anh";
        $currentPage = getInput("currentPage");
        $currentPage = $currentPage ? $currentPage : "1";
        $totalDisplay = getInput("totalDisplay");
        $totalDisplay = $totalDisplay ? $totalDisplay :"10";
        $orderby = "DateUpdated";
        
        $objHandle = new PictureCategories ();
		$displayItem = $objHandle->getPagingPictureCategory($totalDisplay, $currentPage, $orderby, "DESC");
		
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
        PictureView::viewList ( $displayItem, $footer );
        
    	
    	
    	
		
    }
	
    
    function detail() {
        $Slug = getInput ( 'Slug' );
        
		$objHandle = new Picture ();
		$objHandleCat = new PictureCategories ();
		
		$cat = $objHandleCat->getAllPictureCategoriesFront();		
		$fields = $objHandle->getPictureByCategory($Slug);
		
        PictureView::detail($fields, $cat);
    }
}

?>

