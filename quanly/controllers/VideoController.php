<?php

//@ Tệp file     : VideoController.cs ver 1.0 
//@ Mobile Center

require_once (MODELS_PATH . 'Video.php');
require_once (MODELS_PATH . 'VideoCategories.php');
require_once (LIBS_PATH . 'ImageUploader.php');
require_once (VIEWS_ADMIN_PATH . 'VideoView.php');

new VideoController ();

class VideoController {
    
    private $action;
    
    function VideoController() {
        
        $trace = debug_backtrace ();
        
        $actions = array (array ("ViewList", "viewlist" ), array ("ViewPagingList", "viewPaginglist" ), array ("Insert", "insert" ), array ("Update", "update" ), array ("Delete", "delete" ) );
        $this->action = new Action ( $trace [0] ["function"], $actions );
        $this->action->setDefaultAction ( 'viewPaginglist' );
        $this->action->execute ();
    }
    
    function viewlist() {        
        $objHandle = new Video ();
		$objHandleCat = new VideoCategories ();
        VideoView::viewList ( $objHandle->getAllVideo (), $objHandleCat->getAllVideoCategories(), null );
    }
    function viewPaginglist() {        
		$VideoCategoryID = getInput("VideoCategoryID");
        $currentPage = getInput("currentPage");
        $currentPage = $currentPage ? $currentPage : "1";
        $totalDisplay = getInput("totalDisplay");
		$totalDisplay = $totalDisplay ? $totalDisplay :"20";
        $orderby = "VideoID";
        
		$objHandle = new Video ();        
		$objHandleCat = new VideoCategories ();
		$displayItem = $objHandle->getPagingVideo($totalDisplay, $currentPage, $orderby, null, $VideoCategoryID);
		
		$itemCount = count($displayItem); 
        
        //@ Display
        $previousPage = $currentPage - 1;
        $nextPage = $currentPage + 1;
        
        $firstLi = ($currentPage == 1 || $currentPage == 2) ? "" : "<li class='non_page'><a href='index.php?module=Video&act=ViewPagingList&VideoCategoryID={$VideoCategoryID}&currentPage=1&totalDisplay=$totalDisplay'>1</a></li>";
        $firstLi .= (($currentPage == 1 || $currentPage == 2) || $currentPage == 3) ? "" : "<li>...</li>";
        $previousLi = ($currentPage == 1) ? "" : "<li class='non_page'><a href='index.php?module=Video&act=ViewPagingList&VideoCategoryID={$VideoCategoryID}&currentPage=$previousPage&totalDisplay=$totalDisplay'>$previousPage</a></li>";
        $lastLi = ($itemCount == $totalDisplay) ? "<li class='non_page'><a href='index.php?module=Video&act=ViewPagingList&VideoCategoryID={$VideoCategoryID}&currentPage=$nextPage&totalDisplay=$totalDisplay'>$nextPage</a></li>" : "";
        
        $footer =<<<EOF
		        
        <ul class="list_page">
        	<li style="margin-right:10px;">Trang: </li>
        	{$firstLi}
        	{$previousLi}
        	<li class='current_page'><a href='index.php?module=Video&act=ViewPagingList&currentPage=$previousPage&VideoCategoryID={$VideoCategoryID}&totalDisplay=$totalDisplay'>{$currentPage}</a></li>        	
        	{$lastLi}        
EOF;
        
		
        VideoView::viewList ( $displayItem , $objHandleCat->getAllVideoCategories(), $footer);
    }
    
    function insert() {
        
		
        if (isset ( $_POST ['insert'] )) {
			
            $VideoCategoryID = getFormInput('VideoCategoryID');
			
			
            $Name = getFormInput('Name');
			$Slug = get_virtual_link($Name);
            
			$Video = getFormInput('Video');
			
			parse_str( parse_url( $Video, PHP_URL_QUERY ), $my_array_of_vars );
			$Video = $my_array_of_vars['v']; 

			
			
			
			
			$Description = getFormInput('Description');
			
			
			
			            
            if ($VideoCategoryID == "0"){
				VideoView::detail ( "Vui lòng điền đầy đủ thông tin !", "error" );
			}
			else{
			
				
				
                $objHandle = new Video ();
                $objHandle->set ( $VideoCategoryID, $Slug, $Name, $Video, $Description,$DateUpdated );
                $objHandle->insert ();
                
                Session::saveMessageSession ( "Video mới đã được thêm vào!", "success" );                
                Session::redirect("index.php?module=Video&VideoCategoryID=".getFormInput('VideoCategoryID'));
            
            } 
        } else {
            VideoView::detail ();
        }
    }
    
    function update() {
        $VideoID = getInt ( 'VideoID' );
        
        if ($VideoID > 0) {
            
            if (isset ( $_POST ['update'] )) {
                $VideoCategoryID = getFormInput('VideoCategoryID');
                
                $Name = getFormInput('Name');
				$Slug = get_virtual_link($Name);
                $Video = getFormInput('Video');
								
				$Video = str_replace("http://www.youtube.com/watch?v=", "", $Video);
				
				$Description = getFormInput('Description');
				
				
                
                
                //if ($BoxTypeName != '') {
                if ($VideoCategoryID == "0"){
					VideoView::detail ( "Vui lòng điền đầy đủ thông tin !", "error" );
				}else
				{         
					
				
                    $objHandle = new Video ( $VideoID );
                    $objHandle->set ( $VideoCategoryID, $Slug, $Name, $Video, $Description,$DateUpdated );
                    $objHandle->update ();
                    
                    Session::saveMessageSession ( "Video đã được cập nhật vào!", "success" );                    
                    Session::redirect("index.php?module=Video&VideoCategoryID=".getFormInput('VideoCategoryID'));
                
                }
            } else {
                $objHandle = new Video ();
                
                VideoView::detail ( null, null, $objHandle->getVideo ( $VideoID ) );
            }
        } else {
            Session::redirect("index.php?module=Video&VideoCategoryID=".getFormInput('VideoCategoryID'));
        }
    }
    
    function delete() {
        $VideoID = getInt ( 'VideoID' );
        
        if ($VideoID > 0) {
            $objHandle = new Video ( $VideoID );
            $objHandle->delete ();
            
            Session::saveMessageSession ( "Video đã được xóa thành công !", "success" );            
            Session::redirect("index.php?module=Video&VideoCategoryID=".getFormInput('VideoCategoryID'));
        } else {
            Session::redirect("index.php?module=Video&VideoCategoryID=".getFormInput('VideoCategoryID'));
        }
    }
}

?>

