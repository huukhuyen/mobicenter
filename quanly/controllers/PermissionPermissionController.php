<?php

//@ Tệp file     : WorkshopPermissionController.cs ver 1.0 
//@ Mobile Center

require_once (MODELS_PATH . 'PracticePermission.php');
require_once (VIEWS_ADMIN_PATH . 'PracticePermissionView.php');


new PracticePermissionController ();

class PracticePermissionController {
    
    private $action;

    function PracticePermissionController() {
        
        $trace = debug_backtrace ();
        
        $actions = array (array ("ViewList", "viewlist" ), array ("ViewPagingList", "viewPaginglist" ), array ("Insert", "insert" ), array ("Update", "update" ), array ("Delete", "delete" ) );
        $this->action = new Action ( $trace [0] ["function"], $actions );
        $this->action->setDefaultAction ( 'viewlist' );
        $this->action->execute ();
    }
    
    function viewlist() {        
        $objHandle = new PracticePermission ();
        PracticePermissionView::viewList ( $objHandle->getAllPracticePermission () );
    }
    function viewPaginglist() {        
        $currentPage = getInput("currentPage");
        $currentPage = $currentPage ? $currentPage : "1";
        $totalDisplay = getInput("totalDisplay");
        $totalDisplay = $totalDisplay ? $totalDisplay :"20";
        $orderby = "Time";
        
        $objHandle = new Logs ();
        PracticePermissionView::viewList ( $objHandle->getPagingLogs($totalDisplay, $currentPage, $orderby) );
    }
    
    function insert() {
        
        if (isset ( $_POST ['insert'] )) {
            $PracticePermissionName = getFormInput('PracticePermissionName');
            $Slug = getFormInput('Slug');
            
            //if ($BoxTypeName != '') {
            if (true){
                $objHandle = new PracticePermission ();
                $objHandle->set ( $PracticePermissionName, $Slug );
                $objHandle->insert ();
                
                Session::saveMessageSession ( "Practice permission mới đã được thêm vào!", "success" );                
                Session::location ( "PracticePermission", "ViewList" );
            
            } else {
                PracticePermissionView::detail ( "Vui lòng điền đầy đủ thông tin !", "error" );
            }
        } else {
            PracticePermissionView::detail ();
        }
    }
    
    function update() {
        $PracticePermissionID = getInt ( 'PracticePermissionID' );
        
        if ($PracticePermissionID > 0) {
            
            if (isset ( $_POST ['update'] )) {
                $PracticePermissionName = getFormInput('PracticePermissionName');
                $Slug = getFormInput('Slug');
                
                //if ($BoxTypeName != '') {
                if (true){
                    
                    $objHandle = new PracticePermission ( $PracticePermissionID );
                    $objHandle->set ( $PracticePermissionName, $Slug );
                    $objHandle->update ();
                    
                    Session::saveMessageSession ( "Practice permission đã được cập nhật vào!", "success" );                    
                    Session::location ( "PracticePermission", "ViewList" );
                
                } else {
                    PracticePermissionView::detail ( "Vui lòng điền đầy đủ thông tin !", "error" );
                }
            } else {
                $objHandle = new PracticePermission ();
                
                PracticePermissionView::detail ( null, null, $objHandle->getPracticePermission ( $PracticePermissionID ) );
            }
        } else {
            Session::location ( "PracticePermission", "ViewList" );
        }
    }
    
    function delete() {
        $PracticePermissionID = getInt ( 'PracticePermissionID' );
        
        if ($PracticePermissionID > 0) {
            $objHandle = new PracticePermission ( $PracticePermissionID );
            $objHandle->delete ();
            
            Session::saveMessageSession ( "Practice permission đã được xóa thành công !", "success" );            
            Session::location ( "PracticePermission", "ViewList" );
        } else {
            Session::location ( "PracticePermission", "ViewList" );
        }
    }
}

?>

