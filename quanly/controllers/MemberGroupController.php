<?php

//@ Tệp file     : MemberGroupController.cs ver 1.0 
//@ Mobile Center

require_once (MODELS_PATH . 'MemberGroup.php');
require_once (VIEWS_ADMIN_PATH . 'MemberGroupView.php');

new MemberGroupController ();

class MemberGroupController {
    
    private $action;
    
    function MemberGroupController() {
        
        $trace = debug_backtrace ();
        
        $actions = array (array ("ViewList", "viewlist" ), array ("ViewPagingList", "viewPaginglist" ), array ("Insert", "insert" ), array ("Update", "update" ), array ("Delete", "delete" ) );
        $this->action = new Action ( $trace [0] ["function"], $actions );
        $this->action->setDefaultAction ( 'viewlist' );
        $this->action->execute ();
    }
    
    function viewlist() {        
        $objHandle = new MemberGroup ();
        MemberGroupView::viewList ( $objHandle->getAllMemberGroup () );
    }
    function viewPaginglist() {        
        $currentPage = getInput("currentPage");
        $currentPage = $currentPage ? $currentPage : "1";
        $totalDisplay = getInput("totalDisplay");
        $totalDisplay = $totalDisplay ? $totalDisplay :"20";
        $orderby = "GroupID";
        
        $objHandle = new MemberGroup ();
        MemberGroupView::viewList ( $objHandle->getPagingMemberGroup($totalDisplay, $currentPage, $orderby) );
    }
    
    function insert() {
        
        if (isset ( $_POST ['insert'] )) {
            $GroupName = getFormInput('GroupName');
            
            //if ($BoxTypeName != '') {
            if (true){
                $objHandle = new MemberGroup ();
                $objHandle->set ( $GroupName );
                $objHandle->insert ();
                
                Session::saveMessageSession ( "Member group mới đã được thêm vào!", "success" );                
                Session::location ( "MemberGroup", "ViewList" );
            
            } else {
                MemberGroupView::detail ( "Vui lòng điền đầy đủ thông tin !", "error" );
            }
        } else {
            MemberGroupView::detail ();
        }
    }
    
    function update() {
        $GroupID = getInt ( 'GroupID' );
        
        if ($GroupID > 0) {
            
            if (isset ( $_POST ['update'] )) {
                $GroupName = getFormInput('GroupName');
                
                //if ($BoxTypeName != '') {
                if (true){
                    
                    $objHandle = new MemberGroup ( $GroupID );
                    $objHandle->set ( $GroupName );
                    $objHandle->update ();
                    
                    Session::saveMessageSession ( "Member group đã được cập nhật vào!", "success" );                    
                    Session::location ( "MemberGroup", "ViewList" );
                
                } else {
                    MemberGroupView::detail ( "Vui lòng điền đầy đủ thông tin !", "error" );
                }
            } else {
                $objHandle = new MemberGroup ();
                
                MemberGroupView::detail ( null, null, $objHandle->getMemberGroup ( $GroupID ) );
            }
        } else {
            Session::location ( "MemberGroup", "ViewList" );
        }
    }
    
    function delete() {
        $GroupID = getInt ( 'GroupID' );
        
        if ($GroupID > 0) {
            $objHandle = new MemberGroup ( $GroupID );
            $objHandle->delete ();
            
            Session::saveMessageSession ( "Member group đã được xóa thành công !", "success" );            
            Session::location ( "MemberGroup", "ViewList" );
        } else {
            Session::location ( "MemberGroup", "ViewList" );
        }
    }
}

?>