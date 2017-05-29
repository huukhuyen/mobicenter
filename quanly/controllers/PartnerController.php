<?php

//@ Tệp file     : PartnerController.cs ver 1.0 
//@ Mobile Center

require_once (MODELS_PATH . 'Partner.php');
require_once (LIBS_PATH . 'ImageUploader.php');
require_once (VIEWS_ADMIN_PATH . 'PartnerView.php');

new PartnerController ();

class PartnerController {
    
    private $action;
    
    function PartnerController() {
        
        $trace = debug_backtrace ();
        
        $actions = array (array ("ViewList", "viewlist" ), array ("ViewPagingList", "viewPaginglist" ), array ("Insert", "insert" ), array ("Update", "update" ), array ("Delete", "delete" ) );
        $this->action = new Action ( $trace [0] ["function"], $actions );
        $this->action->setDefaultAction ( 'viewlist' );
        $this->action->execute ();
    }
    
    function viewlist() {        
        $objHandle = new Partner ();
        PartnerView::viewList ( $objHandle->getAllPartner () );
    }
    function viewPaginglist() {        
        $currentPage = getInput("currentPage");
        $currentPage = $currentPage ? $currentPage : "1";
        $totalDisplay = getInput("totalDisplay");
        $totalDisplay = $totalDisplay ? $totalDisplay :"20";
        $orderby = "DateUpdated";
        
        $objHandle = new Logs ();
        PartnerView::viewList ( $objHandle->getPagingLogs($totalDisplay, $currentPage, $orderby) );
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
				PartnerView::detail ("Bạn đã điền thiếu thông tin!", "error", $fields);
			}
			else {
				if ($_FILES['Avatar']['name'] != "")
				{
					
					$imageUploader = new ImageUploader ( $_FILES ['Avatar'] );
					
					//@@ Truong hop loi ko upload dc image				
					if ($imageUploader->checkUploadError () == true) {											
						
						PartnerView::detail ("Có lỗi up ảnh. Vui lòng liên hệ WebMaster!", "error", $fields);						
						return;
					}
					else
					{
					
						if ($imageUploader->processAttach ("link", $Slug )) {
							$Avatar = $imageUploader->getAttachName ( "link" );							
						}
					}
				}
                $objHandle = new Partner ();
                $objHandle->set ( $LinkName, $LinkUrl, $Avatar, $Status, $DateUpdated );
                $objHandle->insert ();
                
				
                Session::saveMessageSession ( "Partner mới đã được thêm vào!", "success" );                
                Session::location ( "Partner", "ViewList" );
            
            }
        } else {
            PartnerView::detail ();
        }
    }
    
    function update() {
        $LinkID = getInt ( 'LinkID' );
        
        if ($LinkID > 0) {
            
            if (isset ( $_POST ['update'] )) {
                $LinkName = getFormInput('LinkName');
                $LinkUrl = getFormInput('LinkUrl');
				$Avatar = getFormInput('AvatarDB');
                $Status = getFormInput('Status') == "0" ? 0 : 1;
                $DateUpdated = getFormInput('DateUpdated');
				$Slug = get_virtual_link($LinkName);
                
                $fields = array("LinkID" => $LinkID, "LinkName" => $LinkName, "LinkUrl" => $LinkUrl, "Status" => $Status);
				
            
				//if ($BoxTypeName != '') {
				if ($LinkName == "" || $LinkUrl == ""){
					PartnerView::detail ("Bạn đã điền thiếu thông tin!", "error", $fields);
				}
				else {
				
					
					if ($_FILES['Avatar']['name'] != "")
					{
						
						$imageUploader = new ImageUploader ( $_FILES ['Avatar'] );
						
						//@@ Truong hop loi ko upload dc image				
						if ($imageUploader->checkUploadError () == true) {											
							
							PartnerView::detail ("Có lỗi up ảnh. Vui lòng liên hệ WebMaster!", "error", $fields);						
							return;
						}
						else
						{
						
							if ($imageUploader->processAttach ("link", $Slug )) {
								$Avatar = $imageUploader->getAttachName ( "link" );							
							}
						}
					}
					
					$objHandle = new Partner ( $LinkID );
					$objHandle->set ( $LinkName, $LinkUrl, $Avatar, $Status, $DateUpdated );
					$objHandle->update ();
					
					Session::saveMessageSession ( "Partner đã được cập nhật vào!", "success" );                    
					Session::location ( "Partner", "ViewList" );
                
                }
            } else {
                $objHandle = new Partner ();
                
                PartnerView::detail ( null, null, $objHandle->getPartner ( $LinkID ) );
            }
        } else {
            Session::location ( "Partner", "ViewList" );
        }
    }
    
    function delete() {
        $LinkID = getInt ( 'LinkID' );
        
        if ($LinkID > 0) {
            $objHandle = new Partner ( $LinkID );
            $objHandle->delete ();
            
            Session::saveMessageSession ( "Partner đã được xóa thành công !", "success" );            
            Session::location ( "Partner", "ViewList" );
        } else {
            Session::location ( "Partner", "ViewList" );
        }
    }
}

?>

