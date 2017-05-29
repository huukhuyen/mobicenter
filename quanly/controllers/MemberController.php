<?php

//@ Tệp file     : MemberController.cs ver 1.0 
//@ Mobile Center

require_once (MODELS_PATH . 'Member.php');
require_once (VIEWS_ADMIN_PATH . 'MemberView.php');

new MemberController ();

class MemberController {
    
    private $action;
    
    function MemberController() {
        
        $trace = debug_backtrace ();
        
        $actions = array (array ("ViewList", "viewlist" ), array ("ViewPagingList", "viewPaginglist" ), array ("Insert", "insert" ), array ("Update", "update" ), array ("Delete", "delete" ), array ("Reset", "reset" ), array ("Password", "password" ) );
        $this->action = new Action ( $trace [0] ["function"], $actions );
        $this->action->setDefaultAction ( 'viewlist' );
        $this->action->execute ();
    }
    
	
	function reset() {
		$objHandle = new Member ();
		$objResult = $objHandle->getMember(1);
		if ($objResult == null)
		{
			$objHandle->reset(true);
		}
		else
		{
			$objHandle->reset();
		}
	}
	
    function viewlist() {        
        $objHandle = new Member ();
        MemberView::viewList ( $objHandle->getAllMember () );
    }
    function viewPaginglist() {        
        $currentPage = getInput("currentPage");
        $currentPage = $currentPage ? $currentPage : "1";
        $totalDisplay = getInput("totalDisplay");
        $totalDisplay = $totalDisplay ? $totalDisplay :"20";
        $orderby = "MemberID";
        
        $objHandle = new Member ();
        MemberView::viewList ( $objHandle->getPagingMember($totalDisplay, $currentPage, $orderby) );
    }
    
    function insert() {
        
        if (isset ( $_POST ['insert'] )) {
            $GroupID = getFormInput('GroupID');
            $Username = getFormInput('Username');
            $RealName = getFormInput('RealName');
            $Email = getFormInput('Email');
            $Password = md5(md5(getFormInput('Password')));
			$Pwd = getFormInput('Password');
            $IM = getFormInput('IM');
            $Phone = getFormInput('Phone');
            $Description = getFormInput('Description');
            $JoinedDate = time();
            $LastActivityDate = time();
            $CookieID = 0;
			$SessionID = 0;
            $IPAddress = $_SERVER['SERVER_ADDR'];
            $UserDeleted = 0;
            
            //if ($BoxTypeName != '') {
            if (true){
                $objHandle = new Member ();
                $objHandle->set ( $GroupID, $Username, $RealName, $Email, $Password, $Pwd, $IM, $Phone, $Description, $JoinedDate, $LastActivityDate, $CookieID, $SessionID, $IPAddress, $UserDeleted );
                $objHandle->insert ();
                
                Session::saveMessageSession ( "Member mới đã được thêm vào!", "success" );                
                Session::location ( "Member", "ViewList" );
            
            } else {
                MemberView::detail ( "Vui lòng điền đầy đủ thông tin !", "error" );
            }
        } else {
            MemberView::detail ();
        }
    }
    
    function update() {
        $MemberID = getInt ( 'MemberID' );
        
        if ($MemberID > 0) {
            
            if (isset ( $_POST ['update'] )) {
                $GroupID = getFormInput('GroupID');
                $Username = getFormInput('Username');
                $RealName = getFormInput('RealName');
                $Email = getFormInput('Email');
				if (getFormInput('Password') != "")
				{
					$Password = md5(md5(getFormInput('Password')));
					$Pwd = getFormInput('Password');				
				}
                $IM = getFormInput('IM');
                $Phone = getFormInput('Phone');
                $Description = getFormInput('Description');
                $JoinedDate = time();
				$LastActivityDate = time();
				$CookieID = 0;
				$SessionID = 0;
				$IPAddress = $_SERVER['SERVER_ADDR'];
				$UserDeleted = 0;
                
                //if ($BoxTypeName != '') {
                if (true){
                    
                    $objHandle = new Member ( $MemberID );
                    $objHandle->set ( $GroupID, $Username, $RealName, $Email, $Password, $Pwd, $IM, $Phone, $Description, $JoinedDate, $LastActivityDate, $CookieID, $SessionID, $IPAddress, $UserDeleted );
                    $objHandle->update ();
                    
                    Session::saveMessageSession ( "Member đã được cập nhật vào!", "success" );                    
                    Session::location ( "Member", "ViewList" );
                
                } else {
                    MemberView::detail ( "Vui lòng điền đầy đủ thông tin !", "error" );
                }
            } else {
                $objHandle = new Member ();
                
                MemberView::detail ( null, null, $objHandle->getMember ( $MemberID ) );
            }
        } else {
            Session::location ( "Member", "ViewList" );
        }
    }
    
	
	function password() {
        
            $objHandle = new Member ();
		if (isset ( $_POST ['update'] )) {
			
			$OldPassword = getFormInput('OldPassword');
			$NewPassword = getFormInput('NewPassword');
			$ConfirmPassword = getFormInput('ConfirmPassword');
			
			//CHECK
			if ($objHandle->checkPassword($_SESSION['memberID'], $OldPassword) == false)
			{
				Session::saveMessageSession ( "Mật khẩu cũ không chính xác, vui lòng nhập lại !", "error" );            
				Session::redirect("index.php?module=Member&act=Password");
			}
			
			//KHONG DUNG
			if ($NewPassword != $ConfirmPassword){
				Session::saveMessageSession ( "Mật khẩu mới đúng, vui lòng nhập lại !", "error" );            
				Session::redirect("index.php?module=Member&act=Password");
			}
			
			$Password = md5(md5(getFormInput('Password')));
			$Pwd = getFormInput('Password');				
			$objHandle = new Member ( $_SESSION['memberID'] );
			
			$objHandle->updatePassword ($_SESSION['memberID'], $Password, $Pwd);
			
			Session::saveMessageSession ( "Mật khẩu đã được thay đổi !", "success" );            
			Session::redirect("index.php");
		
		
		} else {
			
			MemberView::changePassword ($objHandle->getMember ( $_SESSION['memberID'] ) );
		}
	
    }
	
    function delete() {
        $MemberID = getInt ( 'MemberID' );
        
        if ($MemberID > 0) {
            $objHandle = new Member ( $MemberID );
            $objHandle->delete ();
            
            Session::saveMessageSession ( "Member đã được xóa thành công !", "success" );            
            Session::location ( "Member", "ViewList" );
        } else {
            Session::location ( "Member", "ViewList" );
        }
    }
}

?>