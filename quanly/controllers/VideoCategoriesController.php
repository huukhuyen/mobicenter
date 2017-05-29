<?php

//@ Tệp file     : VideoCategoriesController.cs ver 1.0 
//@ Mobile Center

require_once (MODELS_PATH . 'VideoCategories.php');

require_once (VIEWS_ADMIN_PATH . 'VideoCategoriesView.php');

new VideoCategoriesController ();

class VideoCategoriesController {
    
    private $action;
    
    function VideoCategoriesController() {
        
        $trace = debug_backtrace ();
        
        $actions = array (array ("ViewList", "viewlist" ), array ("ViewPagingList", "viewPaginglist" ), array ("Insert", "insert" ), array ("Update", "update" ), array ("Delete", "delete" ) );
        $this->action = new Action ( $trace [0] ["function"], $actions );
        $this->action->setDefaultAction ( 'viewlist' );
        $this->action->execute ();
    }
    
    function viewlist() {        
        $objHandle = new VideoCategories ();
        VideoCategoriesView::viewList ( $objHandle->getAllVideoCategories () );
    }
    function viewPaginglist() {        
        $currentPage = getInput("currentPage");
        $currentPage = $currentPage ? $currentPage : "1";
        $totalDisplay = getInput("totalDisplay");
        $totalDisplay = $totalDisplay ? $totalDisplay :"20";
        $orderby = "DateUpdated";
        
        $objHandle = new Logs ();
        VideoCategoriesView::viewList ( $objHandle->getPagingLogs($totalDisplay, $currentPage, $orderby) );
    }
    
    function insert() {
        
        if (isset ( $_POST ['insert'] )) {
            $Name = getFormInput('Name');
			$Status = getFormInput('Status');
			$Year = getFormInput('Year');
			//die($Status);
            $Slug = getFormInput('Slug') ? getFormInput('Slug') : get_virtual_link($Name);
            
            //if ($BoxTypeName != '') {
            if ($Name == "" ){
				VideoCategoriesView::detail ( "Vui lòng điền đầy đủ thông tin !", "error" );
			}
			else{
                $objHandle = new VideoCategories ();
                $objHandle->set ( $Name, $Slug, $Status, $Year );
                $objHandle->insert ();
                
                Session::saveMessageSession ( "Danh mục ảnh mới đã được thêm vào!", "success" );                
                Session::location ( "VideoCategories", "ViewList" );
            
            }
        } else {
            VideoCategoriesView::detail ();
        }
    }
    
    function update() {
        $VideoCategoryID = getInt ( 'VideoCategoryID' );
        
        if ($VideoCategoryID > 0) {
            
            if (isset ( $_POST ['update'] )) {
                $Name = getFormInput('Name');
				$Status = getFormInput('Status');
				$Year = getFormInput('Year');
                $Slug = getFormInput('Slug') ? getFormInput('Slug') : get_virtual_link($Name);
				
                
                //if ($BoxTypeName != '') {
                if ($Name == "" ){
					VideoCategoriesView::detail ( "Vui lòng điền đầy đủ thông tin !", "error" );
				}
				else{
                    
                    $objHandle = new VideoCategories ( $VideoCategoryID );
                    $objHandle->set ( $Name, $Slug, $Status, $Year );
                    $objHandle->update ();
                    
                    Session::saveMessageSession ( "Danh mục ảnh đã được cập nhật vào!", "success" );                    
                    Session::location ( "VideoCategories", "ViewList" );
                
                }
            } else {
                $objHandle = new VideoCategories ();
                
                VideoCategoriesView::detail ( null, null, $objHandle->getVideoCategories ( $VideoCategoryID ) );
            }
        } else {
            Session::location ( "VideoCategories", "ViewList" );
        }
    }
    
    function delete() {
        $VideoCategoryID = getInt ( 'VideoCategoryID' );
        
        if ($VideoCategoryID > 0) {
            $objHandle = new VideoCategories ( $VideoCategoryID );
            $objHandle->delete ();
            
            Session::saveMessageSession ( "Danh mục ảnh đã được xóa thành công !", "success" );            
            Session::location ( "VideoCategories", "ViewList" );
        } else {
            Session::location ( "VideoCategories", "ViewList" );
        }
    }
}

?>

