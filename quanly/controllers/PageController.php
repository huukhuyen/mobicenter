<?php

//@ Tệp file     : PageController.cs ver 1.0 
//@ Mobile Center

require_once (MODELS_PATH . 'Page.php');
require_once (LIBS_PATH . 'ImageUploader.php');
require_once (VIEWS_ADMIN_PATH . 'PageView.php');

new PageController ();

class PageController {
    
    private $action;
    
    function PageController() {
        
        $trace = debug_backtrace ();
        
        $actions = array (array ("ViewList", "viewlist" ), array ("ViewPagingList", "viewPaginglist" ), array ("Insert", "insert" ), array ("Update", "update" ), array ("Delete", "delete" ) );
        $this->action = new Action ( $trace [0] ["function"], $actions );
        $this->action->setDefaultAction ( 'viewlist' );
        $this->action->execute ();
    }
    
    function viewlist() {        
        $objHandle = new Page ();
        PageView::viewList ( $objHandle->getAllPage () );
    }
    function viewPaginglist() {        
        $currentPage = getInput("currentPage");
        $currentPage = $currentPage ? $currentPage : "1";
        $totalDisplay = getInput("totalDisplay");
        $totalDisplay = $totalDisplay ? $totalDisplay :"20";
        $orderby = "DateUpdated";
        
        $objHandle = new Logs ();
        PageView::viewList ( $objHandle->getPagingLogs($totalDisplay, $currentPage, $orderby) );
    }
    
    function insert() {
        
        if (isset ( $_POST ['insert'] )) {
            
            $Name = getFormInput('Name');
			$Slug = get_virtual_link($Name);
            $Content = getFormInput('Content');
            $Status = getFormInput('Status') == "0" ? 0 : 1;
            $DateUpdated = getFormInput('DateUpdated');
            
            //if ($BoxTypeName != '') {
            if (true){
                $objHandle = new Page ();
                $objHandle->set ( $Slug, $Name, $Content, $Status, $DateUpdated );
                $objHandle->insert ();
                
                Session::saveMessageSession ( "Page mới đã được thêm vào!", "success" );                
                Session::location ( "Page", "ViewList" );
            
            } else {
                PageView::detail ( "Vui lòng điền đầy đủ thông tin !", "error" );
            }
        } else {
            PageView::detail ();
        }
    }
    
    function update() {
        $PageID = getInt ( 'PageID' );
        
        if ($PageID > 0) {
            
            if (isset ( $_POST ['update'] )) {
                
                $Name = getFormInput('Name');
				$Slug = get_virtual_link($Name);
                $Content = getFormInput('Content');
                $Status = getFormInput('Status') == "0" ? 0 : 1;
                $DateUpdated = getFormInput('DateUpdated');
                
                //if ($BoxTypeName != '') {
                if (true){
                    
                    $objHandle = new Page ( $PageID );
                    $objHandle->set ( $Slug, $Name, $Content, $Status, $DateUpdated );
                    $objHandle->update ();
                    
                    Session::saveMessageSession ( "Page đã được cập nhật vào!", "success" );                    
                    Session::location ( "Page", "ViewList" );
                
                } else {
                    PageView::detail ( "Vui lòng điền đầy đủ thông tin !", "error" );
                }
            } else {
                $objHandle = new Page ();
                
                PageView::detail ( null, null, $objHandle->getPage ( $PageID ) );
            }
        } else {
            Session::location ( "Page", "ViewList" );
        }
    }
    
    function delete() {
        $PageID = getInt ( 'PageID' );
        
        if ($PageID > 0) {
            $objHandle = new Page ( $PageID );
            $objHandle->delete ();
            
            Session::saveMessageSession ( "Page đã được xóa thành công !", "success" );            
            Session::location ( "Page", "ViewList" );
        } else {
            Session::location ( "Page", "ViewList" );
        }
    }
}

?>

