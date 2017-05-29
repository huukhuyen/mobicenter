<?php

//@ Tệp file     : SupportController.cs ver 1.0 
//@ Mobile Center

require_once (MODELS_PATH . 'Support.php');
require_once (VIEWS_ADMIN_PATH . 'SupportView.php');

new SupportController ();

class SupportController {
    
    private $action;
    
    function SupportController() {
        
        $trace = debug_backtrace ();
        
        $actions = array (array ("ViewList", "viewlist" ), array ("ViewPagingList", "viewPaginglist" ), array ("Insert", "insert" ), array ("Update", "update" ), array ("Delete", "delete" ) );
        $this->action = new Action ( $trace [0] ["function"], $actions );
        $this->action->setDefaultAction ( 'viewlist' );
        $this->action->execute ();
    }
    
    function viewlist() {        
        $objHandle = new Support ();
        SupportView::viewList ( $objHandle->getAllSupport () );
    }
    function viewPaginglist() {        
        $currentPage = getInput("currentPage");
        $currentPage = $currentPage ? $currentPage : "1";
        $totalDisplay = getInput("totalDisplay");
        $totalDisplay = $totalDisplay ? $totalDisplay :"20";
        $orderby = "DateUpdated";
        
        $objHandle = new Logs ();
        SupportView::viewList ( $objHandle->getPagingLogs($totalDisplay, $currentPage, $orderby) );
    }
    
    function insert() {
        
        if (isset ( $_POST ['insert'] )) {
            $YM = getFormInput('YM');
            $Skype = getFormInput('Skype');
            $FullName = getFormInput('FullName');
            $Phone = getFormInput('Phone');
            $Message = getFormInput('Message');
            $DateUpdated = getFormInput('DateUpdated');
            
            //if ($BoxTypeName != '') {
            if (true){
                $objHandle = new Support ();
                $objHandle->set ( $YM, $Skype, $FullName, $Phone, $Message, $DateUpdated );
                $objHandle->insert ();
                
                Session::saveMessageSession ( "Support mới đã được thêm vào!", "success" );                
                Session::location ( "Support", "ViewList" );
            
            } else {
                SupportView::detail ( "Vui lòng điền đầy đủ thông tin !", "error" );
            }
        } else {
            SupportView::detail ();
        }
    }
    
    function update() {
        $SupportID = getInt ( 'SupportID' );
        
        if ($SupportID > 0) {
            
            if (isset ( $_POST ['update'] )) {
                $YM = getFormInput('YM');
                $Skype = getFormInput('Skype');
                $FullName = getFormInput('FullName');
                $Phone = getFormInput('Phone');
                $Message = getFormInput('Message');
                $DateUpdated = getFormInput('DateUpdated');
                
                //if ($BoxTypeName != '') {
                if (true){
                    
                    $objHandle = new Support ( $SupportID );
                    $objHandle->set ( $YM, $Skype, $FullName, $Phone, $Message, $DateUpdated );
                    $objHandle->update ();
                    
                    Session::saveMessageSession ( "Support đã được cập nhật vào!", "success" );                    
                    Session::location ( "Support", "ViewList" );
                
                } else {
                    SupportView::detail ( "Vui lòng điền đầy đủ thông tin !", "error" );
                }
            } else {
                $objHandle = new Support ();
                
                SupportView::detail ( null, null, $objHandle->getSupport ( $SupportID ) );
            }
        } else {
            Session::location ( "Support", "ViewList" );
        }
    }
    
    function delete() {
        $SupportID = getInt ( 'SupportID' );
        
        if ($SupportID > 0) {
            $objHandle = new Support ( $SupportID );
            $objHandle->delete ();
            
            Session::saveMessageSession ( "Support đã được xóa thành công !", "success" );            
            Session::location ( "Support", "ViewList" );
        } else {
            Session::location ( "Support", "ViewList" );
        }
    }
}

?>

