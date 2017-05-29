<?php

//@ Tệp file     : LinksController.cs ver 1.0 
//@ Mobile Center

require_once (MODELS_PATH . 'Links.php');
require_once (LIBS_PATH . 'ImageUploader.php');
require_once (VIEWS_ADMIN_PATH . 'LinksView.php');

new LinksController ();

class LinksController {
    
    private $action;
    
    function LinksController() {
        
        $trace = debug_backtrace ();
        
        $actions = array (array ("ViewList", "viewlist" ), array ("ViewPagingList", "viewPaginglist" ), array ("Insert", "insert" ), array ("Update", "update" ), array ("Delete", "delete" ) );
        $this->action = new Action ( $trace [0] ["function"], $actions );
        $this->action->setDefaultAction ( 'viewlist' );
        $this->action->execute ();
    }
    
    function viewlist() {        
        
        $Slug = getInput("type");
        
        $objHandle = new Links ();
        LinksView::viewList ( $objHandle->getAllLinks (null, $Slug) );
    }
    function viewPaginglist() {        
        $currentPage = getInput("currentPage");
        $currentPage = $currentPage ? $currentPage : "1";
        $totalDisplay = getInput("totalDisplay");
        $totalDisplay = $totalDisplay ? $totalDisplay :"20";
        $orderby = "DateUpdated";
        
        $objHandle = new Logs ();
        LinksView::viewList ( $objHandle->getPagingLogs($totalDisplay, $currentPage, $orderby) );
    }
    
    function insert() {
        
        if (isset ( $_POST ['insert'] )) {
            $LinkName = getFormInput('LinkName');
			$Slug = get_virtual_link($LinkName);
            $LinkUrl = getFormInput('LinkUrl');			
            $Status = getFormInput('Status') == "0" ? 0 : 1;
            $DateUpdated = getFormInput('DateUpdated');
			
			$fields = array("LinkName" => $LinkName, "LinkUrl" => $LinkUrl, "Status" => $Status);
				
            
            //if ($BoxTypeName != '') {
            if ($LinkName == "" || $LinkUrl == ""){
				LinksView::detail ("Bạn đã điền thiếu thông tin!", "error", $fields);
			}
			else {
				
				if ($_FILES['Avatar']['name'] != "")
				{
					
					$imageUploader = new ImageUploader ( $_FILES ['Avatar'] );
					
					//@@ Truong hop loi ko upload dc image				
					if ($imageUploader->checkUploadError () == true) {											
						
						LinksView::detail ("Có lỗi up ảnh. Vui lòng liên hệ WebMaster!", "error", $fields);						
						return;
					}
					else
					{
					
						if ($imageUploader->processAttach ("link", $Slug )) {
							$Avatar = $imageUploader->getAttachName ( "link" );							
						}
					}
				}
				else
				{
					
				}
                $objHandle = new Links ();
                $objHandle->set ( $LinkName, $LinkUrl, $Avatar, $Status, $DateUpdated );
                $objHandle->insert ();
                
				
                Session::saveMessageSession ( "Links mới đã được thêm vào!", "success" );                
                Session::location ( "Links", "ViewList" );
            
            }
        } else {
            LinksView::detail ();
        }
    }
    
    function update() {
        $LinkID = getInt ( 'LinkID' );
        
        if ($LinkID > 0) {
            
            if (isset ( $_POST ['update'] )) {
                $LinkName = getFormInput('LinkName');
                $LinkUrl = getFormInput('LinkUrl');
                $Status = getFormInput('Status') == "0" ? 0 : 1;
				$Avatar = getFormInput('AvatarDB');
                $DateUpdated = getFormInput('DateUpdated');
				$Slug = get_virtual_link($LinkName);
                
                $fields = array("LinkID" => $LinkID, "LinkName" => $LinkName, "LinkUrl" => $LinkUrl, "Status" => $Status);
				
            
				//if ($BoxTypeName != '') {
				if ($LinkName == "" || $LinkUrl == ""){
					LinksView::detail ("Bạn đã điền thiếu thông tin!", "error", $fields);
				}
				else {
					
					if ($_FILES['Avatar']['name'] != "")
					{
						
						$imageUploader = new ImageUploader ( $_FILES ['Avatar'] );
						
						//@@ Truong hop loi ko upload dc image				
						if ($imageUploader->checkUploadError () == true) {											
							
							LinksView::detail ("Có lỗi up ảnh. Vui lòng liên hệ WebMaster!", "error", $fields);						
							return;
						}
						else
						{
						
							if ($imageUploader->processAttach ("link", $Slug )) {
								$Avatar = $imageUploader->getAttachName ( "link" );							
							}
						}
					}
					
					$objHandle = new Links ( $LinkID );
					$objHandle->set ( $LinkName, $LinkUrl, $Avatar, $Status, $DateUpdated );
					$objHandle->update ();
					
					Session::saveMessageSession ( "Links đã được cập nhật vào!", "success" );                    
					Session::location ( "Links", "ViewList" );
                
                }
            } else {
                $objHandle = new Links ();
                
                LinksView::detail ( null, null, $objHandle->getLinks ( $LinkID ) );
            }
        } else {
            Session::location ( "Links", "ViewList" );
        }
    }
    
    function delete() {
        $LinkID = getInt ( 'LinkID' );
        
        if ($LinkID > 0) {
            $objHandle = new Links ( $LinkID );
            $objHandle->delete ();
            
            Session::saveMessageSession ( "Links đã được xóa thành công !", "success" );            
            Session::location ( "Links", "ViewList" );
        } else {
            Session::location ( "Links", "ViewList" );
        }
    }
}

?>

