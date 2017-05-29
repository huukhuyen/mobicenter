<?php

//@ Tệp file     : Products.cs ver 1.0 
//@ Mobile Center

require_once (MODELS_PATH . 'Cms.php');
require_once (LIBS_PATH . 'ImageUploader.php');
require_once (VIEWS_ADMIN_PATH . 'ProductsView.php');

new Products ();

class Products {
    
    private $action;
    
    function Products() {
        
        $trace = debug_backtrace ();
        
        $actions = array (array ("ViewList", "viewlist" ), array ("ViewPagingList", "viewPaginglist" ), array ("Insert", "insert" ), array ("Update", "update" ), array ("Delete", "delete" ) );
        $this->action = new Action ( $trace [0] ["function"], $actions );
        $this->action->setDefaultAction ( 'viewlist' );
        $this->action->execute ();
    }
    
    function viewlist() {      
		$type = getInput("type");
        $objHandle = new Cms ();
		
        ProductsView::viewList ( $objHandle->getAllCms ($type) );
    }
    function viewPaginglist() {        
        $currentPage = getInput("currentPage");
        $currentPage = $currentPage ? $currentPage : "1";
        $totalDisplay = getInput("totalDisplay");
        $totalDisplay = $totalDisplay ? $totalDisplay :"20";
        $orderby = "DateUpdated";
        
        $objHandle = new Logs ();
        ProductsView::viewList ( $objHandle->getPagingLogs($totalDisplay, $currentPage, $orderby) );
    }
    
    function insert() {
        
        if (isset ( $_POST ['insert'] )) {
			
            $Module = getInput('type');
            $MetaTitle = getFormInput('MetaTitle');
            $MetaDescription = getFormInput('MetaDescription');
            $MetaKeyword = getFormInput('MetaKeyword');
            
            $Title = getFormInput('Title');
			$Slug = get_virtual_link($Title);
            
            $SimpleContent = getFormInput('SimpleContent');
            $Content = getFormInput('Content');
			
            $Status = getFormInput('Status') == "0" ? 0 : 1;
            $ViewedCount = getFormInput('ViewedCount') ? getFormInput('ViewedCount') : 0;
            
            
			$fields = array("MetaTitle" => $MetaTitle, "MetaDescription" => $MetaDescription, "MetaKeyword" => $MetaKeyword, 
				"Title" => $Title, "Avatar" => $Avatar,"SimpleContent" => $SimpleContent, "Content" => $Content);
            
			
            //if ($BoxTypeName != '') {
			
			
            if ($Module == "")
			{
				Session::redirect("index.php");
			}
			else if ($Title == "" || $Content == ""){				
				 ProductsView::detail ("Bạn đã điền thiếu thông tin!", "error", $fields);
			}
			else
			{
				
				if ($_FILES['Avatar']["name"] != "")
				{				
					$imageUploader = new ImageUploader ( $_FILES ['Avatar'] );
					
					//@@ Truong hop loi ko upload dc image				
					if ($imageUploader->checkUploadError () == true) {					
						ProductsView::detail ("Có lỗi up ảnh. Vui lòng liên hệ WebMaster!", "error", $fields);						
					}
					else
					{
						if ($imageUploader->processAttach ( $Module, $Slug )) {
							$Avatar = $imageUploader->getAttachName ( $Module );							
						}
					}
				}
				
			
				$objHandle = new Cms ();
				$objHandle->set ( $Module, $MetaTitle, $MetaDescription, $MetaKeyword, $Slug, $Title, $Avatar, $SimpleContent, $Content, $Status, $ViewedCount, $DateUpdated );
				$objHandle->insert ();
				
				Session::saveMessageSession ( "Product mới đã được thêm vào!", "success" );                
				Session::redirect("index.php?module=Products&act=ViewList&type=".$Module);
				            
            }
        } else {
            ProductsView::detail ();
        }
    }
    
    function update() {
        $CmsID = getInt ( 'CmsID' );
        
        if ($CmsID > 0) {
            
            if (isset ( $_POST ['update'] )) {
                $Module = getInput('type');
                $MetaTitle = getFormInput('MetaTitle');
                $MetaDescription = getFormInput('MetaDescription');
                $MetaKeyword = getFormInput('MetaKeyword');
                
                $Title = getFormInput('Title');
				$Slug = get_virtual_link($Title);
                
                $SimpleContent = getFormInput('SimpleContent');
                $Content = getFormInput('Content');
				
                $Status = getFormInput('Status') == "0" ? 0 : 1;
				
				$ViewedCount = getFormInput('ViewedCount') ? getFormInput('ViewedCount') : 0;
                
                $fields = array("CmsID" => $CmsID, "MetaTitle" => $MetaTitle, "MetaDescription" => $MetaDescription, "MetaKeyword" => $MetaKeyword, 
				"Title" => $Title, "Avatar" => $Avatar,"SimpleContent" => $SimpleContent, "Content" => $Content);
				
				
				if ($Module == "")
				{
					Session::redirect("index.php");
				}
				else if ($Title == "" || $Content == ""){				
					 ProductsView::detail ("Bạn đã điền thiếu thông tin!", "error", $fields);
				}
                else{
					
					if ($_FILES['Avatar']["name"] != "")
					{						
						$imageUploader = new ImageUploader ( $_FILES ['Avatar'] );
						
						//@@ Truong hop loi ko upload dc image				
						if ($imageUploader->checkUploadError () == true) {											
							
							ProductsView::detail ("Có lỗi up ảnh. Vui lòng liên hệ WebMaster!", "error", $fields);						
							return;
						}
						else
						{
						
							if ($imageUploader->processAttach ( $Module, $Slug )) {
								$Avatar = $imageUploader->getAttachName ( $Module );							
							}
						}
					}
					else
					{
						$objHandle = new Cms ();
						$fields = $objHandle->getCms ( $CmsID );
						$Avatar = $fields['Avatar'];
					}
					
					$objHandle = new Cms ( $CmsID );
										
					$objHandle->set ( $Module, $MetaTitle, $MetaDescription, $MetaKeyword, $Slug, $Title, $Avatar, $SimpleContent, $Content, $Status, $ViewedCount, $DateUpdated );
					$objHandle->update (true);
					
					Session::saveMessageSession ( "Products đã được cập nhật vào!", "success" );                    
					Session::redirect("index.php?module=Products&act=ViewList&type=".$Module);					
                
                }
            } else {
                $objHandle = new Cms ();
                
                ProductsView::detail (null, null, $objHandle->getCms ( $CmsID ) );
            }
        } else {
            Session::redirect("index.php?module=Products&act=ViewList&type=".$Module);
        }
    }
    
    function delete() {
        $CmsID = getInt ( 'CmsID' );
		$Module = getInput('type');
        
        if ($CmsID > 0) {
            $objHandle = new Cms ( $CmsID );
            $objHandle->delete ();
            
            Session::saveMessageSession ( "Products đã được xóa thành công !", "success" );            
            Session::redirect("index.php?module=Products&act=ViewList&type=".$Module);
        } else {
            Session::redirect("index.php?module=Products&act=ViewList&type=".$Module);
        }
    }
}

?>