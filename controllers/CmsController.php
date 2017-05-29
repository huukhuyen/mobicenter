<?php


require_once (MODELS_PATH . 'Cms.php');
require_once (VIEWS_PATH . 'CmsView.php');


new CmsController ();

class CmsController {
    
    private $action;
    
    function CmsController() {
        
		global $head;
		
		
		
        $trace = debug_backtrace ();
        
        $actions = array (array ("ViewList", "viewlist" ), array ("ViewPagingList", "viewPaginglist" ), array ("Detail", "detail" ), array ("ListParent", "listParent" ) );
        $this->action = new Action ( $trace [0] ["function"], $actions );
        $this->action->setDefaultAction ( 'viewPaginglist' );
        $this->action->execute ();
    }
    
    function viewlist() {      
		
        
    }
    function viewPaginglist() {   
	
		
		
		global $url;
		
		
		
		
		$type = getInput("type");		
		
		if ($type == 'nganh-nghe-dao-tao')
		{
			include_once(ROOT_PATH."tintuc.php");
			die();
		}
		
		if ($type == 'gioi-thieu')
		{
			Session::redirect(BASE_URL."gioi-thieu/gioi-thieu-chung.html");
		}
		
        $currentPage = getInput("currentPage");
        $currentPage = $currentPage ? $currentPage : "1";
        $totalDisplay = getInput("totalDisplay");
        $totalDisplay = $totalDisplay ? $totalDisplay :"7";
        $orderby = "DateUpdated";
        
        $objHandle = new Cms ();
		$displayItem = $objHandle->getPagingCms($totalDisplay, $currentPage, $orderby, "DESC", $type);
		//die(var_dump($displayItem));
		$itemCount = count($displayItem); 
		
		
        
        //@ Display
        $previousPage = $currentPage - 1;
        $nextPage = ($itemCount == $totalDisplay) ? $currentPage + 1 : "";
		//$firstsecond = ($currentPage == 1 || $currentPage == 2) ? "<li class='non_page'><a href='{$url['home']}{$type}/trang-{$nextPage}/'>Trang cuối</a></li>" : "";
        
        $firstLi = ($currentPage == 1 || $currentPage == 2) ? "" : "<li class='non_page'><a href='{$url['home']}{$type}/trang-1/'>1</a></li>";
        $firstLi .= (($currentPage == 1 || $currentPage == 2) || $currentPage == 3) ? "" : "<li>...</li>";
        $previousLi = ($currentPage == 1) ? "" : "<li class='non_page'><a href='{$url['home']}{$type}/trang-{$previousPage}/'>{$previousPage}</a></li>";
        $lastLi = ($itemCount == $totalDisplay) ? "<li class='non_page'><a href='{$url['home']}{$type}/trang-{$nextPage}/'>{$nextPage}</a></li>{$firstsecond}" : "";
        
        $footer =<<<EOF
		        
        <ul class="list_page">
			<li style="margin:5px 10px 0px 0px">Trang</li>
        	<li style="margin-right:10px;"></li>
        	{$firstLi}
        	{$previousLi}
        	<li class='current_page'><a href='{$url['home']}{$type}/trang-{$previousPage}/'>{$currentPage}</a></li>        	
        	{$lastLi}        
EOF;
        CmsView::viewList ( $displayItem, $footer );
    }
	
	function listParent() {   
		
		global $url;
		
		
		$type = getInput("type");		
		$slug2 = getInput("slug2");
        $currentPage = getInput("currentPage");
        $currentPage = $currentPage ? $currentPage : "1";
        $totalDisplay = getInput("totalDisplay");
		
		if ($slug2 == "cac-cau-hoi-thuong-gap")
		{
			$totalDisplay = $totalDisplay ? $totalDisplay :"40";
		}
		else
		{
			$totalDisplay = $totalDisplay ? $totalDisplay :"10";
		}
        $orderby = "DateUpdated";
        
        $objHandle = new Cms ();
		$displayItem = $objHandle->getPagingCmsParent($totalDisplay, $currentPage, $orderby, "DESC", $type, $slug2);
		
		$itemCount = count($displayItem); 
		
		
        
        //@ Display
        $previousPage = $currentPage - 1;
        $nextPage = ($itemCount == $totalDisplay) ? $currentPage + 1 : "Trang cuối";
        
        $firstLi = ($currentPage == 1 || $currentPage == 2) ? "" : "<li class='non_page'><a href='{$url['home']}{$type}/{$slug2}/trang-1/'>1</a></li>";
        $firstLi .= (($currentPage == 1 || $currentPage == 2) || $currentPage == 3) ? "" : "<li>...</li>";
        $previousLi = ($currentPage == 1) ? "" : "<li class='non_page'><a href='{$url['home']}{$type}/{$slug2}/trang-{$previousPage}/'>{$previousPage}</a></li>";
        $lastLi = ($itemCount == $totalDisplay) ? "<li class='non_page'><a href='{$url['home']}{$type}/{$slug2}/trang-{$nextPage}/'>{$nextPage}</a></li>" : "";
        
        $footer =<<<EOF
		        
        <ul class="list_page">
			<li style="margin:5px 10px 0px 0px">Trang</li>
        	<li style="margin-right:10px;"></li>
        	{$firstLi}
        	{$previousLi}
        	<li class='current_page'><a href='{$url['home']}{$type}/{$slug2}/trang-{$previousPage}/'>{$currentPage}</a></li>        	
        	{$lastLi}        
EOF;
        CmsView::viewList ( $displayItem, $footer );
    }
    
    function detail() {
	
		//getJS("jquery-ui.min.js");
		
		
		$type = getInput ( 'type' );
		$slug2 = getInput ( 'slug2' );
		$slug = getInput ( 'slug' );
		
		
			
		$objHandle = new Cms ();
		$fields = $objHandle->getCmsFront($type, $slug);
		
		
		$Title = title_style($fields['Title']);
		
		if ($fields != null)
		{
			
			//@++ Count
			$objHandle->increaseView($fields['CmsID']);
			
			if ($slug2 == "")
			{
				//$anotherNews = $objHandle->getAnotherCms($type, $fields['CmsID']);
			}
			else
			{
			
				if ($slug2 == "cac-cau-hoi-thuong-gap")
				{
					$anotherNews = $objHandle->getAnotherCms($slug2, $fields['CmsID'], 100);
				}
				else
				{
					$anotherNews = $objHandle->getAnotherCms($slug2, $fields['CmsID']);
				}
			}
			//die(var_dump($type));
		}	
	
		CmsView::detail ($fields, $anotherNews, $echo);        
		
		
    }    
}

?>