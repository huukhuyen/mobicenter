<?php

//@ Tệp file     : OptionController.cs ver 1.0 
//@ Mobile Center

require_once (MODELS_PATH . 'Option.php');
require_once (VIEWS_ADMIN_PATH . 'OptionView.php');

new OptionController ();

class OptionController {
    
    private $action;
    
    function OptionController() {
        
        $trace = debug_backtrace ();
        
        $actions = array (array ("ViewList", "viewlist" ), array ("ViewPagingList", "viewPaginglist" ), array ("Insert", "insert" ), array ("Update", "update" ), array ("Delete", "delete" ), array ("EditPassword", "editPassword" ) );
        $this->action = new Action ( $trace [0] ["function"], $actions );
        $this->action->setDefaultAction ( 'viewlist' );
        $this->action->execute ();
    }
    
    function viewlist() {        
        $objHandle = new Option ();
        OptionView::viewList ( $objHandle->getAllOption () );
    }
    function viewPaginglist() {        
        $currentPage = getInput("currentPage");
        $currentPage = $currentPage ? $currentPage : "1";
        $totalDisplay = getInput("totalDisplay");
        $totalDisplay = $totalDisplay ? $totalDisplay :"20";
        $orderby = "DateUpdated";
        
        $objHandle = new Logs ();
        OptionView::viewList ( $objHandle->getPagingLogs($totalDisplay, $currentPage, $orderby) );
    }
    
    function insert() {
        
        if (isset ( $_POST ['insert'] )) {
            $Name = getFormInput('Name');
			
            $Value1 = getFormInput('Value1');
            $Value2 = getFormInput('Value2');
            $Value3 = getFormInput('Value3');
            $Value4 = getFormInput('Value4');
            $Value5 = getFormInput('Value5');
            $DateUpdated = getFormInput('DateUpdated');
            
            //if ($BoxTypeName != '') {
            if (true){
                $objHandle = new Option ();
                $objHandle->set ( $Name, $Value1, $Value2, $Value3, $Value4, $Value5, $DateUpdated );
                $objHandle->insert ();
                
                Session::saveMessageSession ( "Option mới đã được thêm vào!", "success" );                
                Session::location ( "Option", "ViewList" );
            
            } else {
                OptionView::detail ( "Vui lòng điền đầy đủ thông tin !", "error" );
            }
        } else {
            OptionView::detail ();
        }
    }
    
    function update() {
        $OptionID = getInt ( 'OptionID' );
        
        if ($OptionID > 0) {
            
            if (isset ( $_POST ['update'] )) {
				
				$Name = getFormInput('Name');
								
                $Value1 = getFormInput('Value1');
                $Value2 = getFormInput('Value2');
                $Value3 = getFormInput('Value3');
                $Value4 = getFormInput('Value4');
                $Value5 = getFormInput('Value5');
                //if ($BoxTypeName != '') {
                if ($Value1 != "" || $Name != ""){
                    
                    $objHandle = new Option ( $OptionID );
                    $objHandle->set ( $Name, $Value1, $Value2, $Value3, $Value4, $Value5, $DateUpdated );
                    $objHandle->update ();
                    
                    Session::saveMessageSession ( "Option đã được cập nhật vào!", "success" );                    
                    OptionView::detail ( "Option đã được cập nhật vào!", "success", $objHandle->getOption ( $OptionID ) );
                
                } else {
                    OptionView::detail ( "Vui lòng điền đầy đủ thông tin !", "error" );
                }
            } else {
                $objHandle = new Option ();
                
                OptionView::detail ( null, null, $objHandle->getOption ( $OptionID ) );
            }
        } else {
            OptionView::detail ( null, null, $objHandle->getOption ( $OptionID ) );
        }
    }
    
    function delete() {
        $OptionID = getInt ( 'OptionID' );
        
        if ($OptionID > 0) {
            $objHandle = new Option ( $OptionID );
            $objHandle->delete ();
            
            Session::saveMessageSession ( "Option đã được xóa thành công !", "success" );            
            Session::location ( "Option", "ViewList" );
        } else {
            Session::location ( "Option", "ViewList" );
        }
    }
	
	function editPassword()
	{
		if(isset($_POST['edit']))
		{
			$password = getFormInput('password');
			
			if($password != '')
			{
				$option = new Option();

				$option->updatePassword($password);

				Session::saveMessageSession ( "Mật khẩu đã được chỉnh sửa thành công !", "success" );            
				Session::location ( "Option", "ViewList" );				
			}
			else 
			{
				Session::saveMessageSession ( "Chưa nhập mật khẩu !", "error" );            				
				OptionTemplate::displayEditPassword("Vui lòng điền đầy đủ thông tin!", "error", null);
			}
		}
		else 
		{
			
			$option = new Option();
			OptionTemplate::displayEditPassword(null,null,null);
		}	
	}
}

?>

