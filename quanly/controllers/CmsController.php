<?php

//@ Tệp file     : CmsController.cs ver 1.0 
//@ Mobile Center

require_once (MODELS_PATH . 'Cms.php');
require_once (MODELS_PATH . 'CmsCategories.php');
require_once (LIBS_PATH . 'ImageUploader.php');
require_once (VIEWS_ADMIN_PATH . 'CmsView.php');

new CmsController ();

class CmsController {
    
    private $action;
    
    function CmsController() {
        
        $trace = debug_backtrace ();
        
        $actions = array (array ("ViewList", "viewlist" ), array ("ViewPagingList", "viewPaginglist" ), array ("Insert", "insert" ), array ("Update", "update" ), array ("Delete", "delete" ) );
        $this->action = new Action ( $trace [0] ["function"], $actions );
        $this->action->setDefaultAction ( 'viewPaginglist' );
        $this->action->execute ();
    }
    
    function viewlist() {      
		$type = getInput("type");
        $objHandle = new Cms ();
		
        CmsView::viewList ( $objHandle->getAllCms ($type) );
    }
    function viewPaginglist() {        
	
		$type = getInput("type");
        $currentPage = getInput("currentPage");
        $currentPage = $currentPage ? $currentPage : "1";
        $totalDisplay = getInput("totalDisplay");
		$keyword = getInput("keyword");
        $totalDisplay = $totalDisplay ? $totalDisplay :"50";
        $orderby = "DateUpdated";
        
		$objHandle = new Cms ();        
		$objHandleCat = new CmsCategories ();
		//if ($type != null)
		//{
			$displayItem = $objHandle->getPagingCms($totalDisplay, $currentPage, $orderby, "DESC", null, $type, $keyword);
			
		//}
		
		
		$itemCount = count($displayItem); 
        
        //@ Display
        $previousPage = $currentPage - 1;
        $nextPage = $currentPage + 1;
        
        $firstLi = ($currentPage == 1 || $currentPage == 2) ? "" : "<li class='non_page'><a href='index.php?module=Cms&act=ViewPagingList&type=$type&CategoryID={$CategoryID}&currentPage=1&totalDisplay=$totalDisplay'>1</a></li>";
        $firstLi .= (($currentPage == 1 || $currentPage == 2) || $currentPage == 3) ? "" : "<li>...</li>";
        $previousLi = ($currentPage == 1) ? "" : "<li class='non_page'><a href='index.php?module=Cms&act=ViewPagingList&type=$type&CategoryID={$CategoryID}&currentPage=$previousPage&totalDisplay=$totalDisplay'>$previousPage</a></li>";
        $lastLi = ($itemCount == $totalDisplay) ? "<li class='non_page'><a href='index.php?module=Cms&act=ViewPagingList&type=$type&CategoryID={$CategoryID}&currentPage=$nextPage&totalDisplay=$totalDisplay'>$nextPage</a></li>" : "";
        
        $footer =<<<EOF
		        
        <ul class="list_page">
        	<li style="margin-right:10px;">Trang: </li>
        	{$firstLi}
        	{$previousLi}
        	<li class='current_page'><a href='index.php?module=Cms&act=ViewPagingList&currentPage=$previousPage&CategoryID={$CategoryID}&totalDisplay=$totalDisplay'>{$currentPage}</a></li>        	
        	{$lastLi}        
EOF;
		
        CmsView::viewList ( $displayItem , $objHandleCat->getAllCmsCategories(), $footer);
		
		
    }
    
    function insert() {
        
		
		
        if (isset ( $_POST ['insert'] )) {
			
			
			
			
			
            $Module = getInput('type') ? getInput('type') : $_POST['type'];
			
			$Module = getInput('ParentID') == "0" || getInput('ParentID') == "" ? $Module : getInput('ParentID');
			
			
            $MetaTitle = getFormInput('MetaTitle') ? getFormInput('MetaTitle') : getFormInput('Title');
            $MetaDescription = getFormInput('MetaDescription') ? getFormInput('MetaDescription') : getFormInput('Title');
            $MetaKeyword = getFormInput('MetaKeyword') ? getFormInput('MetaKeyword') : getFormInput('Title');
            
            $Title = getFormInput('Title');
			$Slug = get_virtual_link($Title);
            
            $SimpleContent = getFormInput('SimpleContent');
            $Content = getFormInput('Content');
			
			
            $Status = getFormInput('Status') == "1" ? 1 : 0;
			$Star = getFormInput('Star') == "1" ? 1 : 0;
			$Event = getFormInput('Event') == "1" ? 1 : 0;
            $ViewedCount = getFormInput('ViewedCount') ? getFormInput('ViewedCount') : 0;
			
			$MemberID = $_SESSION['memberID'];
            
            
			$fields = array( "ParentID" => $ParentID, "MetaTitle" => $MetaTitle, "MetaDescription" => $MetaDescription, "MetaKeyword" => $MetaKeyword, 
				"Title" => $Title, "Avatar" => $Avatar,"SimpleContent" => $SimpleContent, "Content" => $Content);
            
			
            //if ($BoxTypeName != '') {
			
			
            if ($Module == "")
			{
				CmsView::detail ("Bạn đã chưa chọn danh mục!", "error", $fields);
			}
			else if ($Title == ""){				
				 CmsView::detail ("Bạn đã điền thiếu thông tin!", "error", $fields);
			}
			else
			{
				$objCmsCategories = new CmsCategories();
				
				$objCat = $objCmsCategories->getCmsCategories($Module, null);
				
				if ($objCat != null && $objCat["CategoryID"] != "")
				{
				
					
					if ($_FILES['Avatar']["name"] != "")
					{				
						$imageUploader = new ImageUploader ( $_FILES ['Avatar'] );
						
						//@@ Truong hop loi ko upload dc image				
						if ($imageUploader->checkUploadError () == true) {					
							CmsView::detail ("Có lỗi up ảnh. Vui lòng liên hệ WebMaster!", "error", $fields);						
						}
						else
						{
							if ($imageUploader->processAttach ( $objCat["Slug"], substr($Slug, 0, 10) )) {
								$Avatar = $imageUploader->getAttachName ( $objCat["Slug"] );							
							}
						}
					}
				
				
				//die(var_dump($objCat));
				
					$objHandle = new Cms ();
					$objHandle->set ( $objCat["CategoryID"], $MetaTitle, $MetaDescription, $MetaKeyword, $Slug, $Title, $Avatar, $SimpleContent, $Content, $Status, $Star, $Event, $ViewedCount, $DateUpdated, $MemberID );
					$objHandle->insert ();
					
					Session::saveMessageSession ( "Lệnh thực hiện tạo mới đã được thêm vào!", "success" );                
					Session::redirect("index.php?module=Cms&type=".$Module);
				}
				else
				{
					CmsView::detail ("Danh mục chưa cho phép active!", "error", $fields);
				}
				            
            }
        } else {
            CmsView::detail ();
        }
    }
    
    function update() {
        $CmsID = getInt ( 'CmsID' );
        
        if ($CmsID > 0) {
            
			
            if (isset ( $_POST ['update'] )) {
						
                $Module = getInput('type') ? getInput('type') : $_POST['type'];
				
				$Module = getInput('ParentID') == "0" || getInput('ParentID') == "" ? $Module : getInput('ParentID');
				
                $MetaTitle = getFormInput('MetaTitle') ? getFormInput('MetaTitle') : getFormInput('Title');
				$MetaDescription = getFormInput('MetaDescription') ? getFormInput('MetaDescription') : getFormInput('Title');
				$MetaKeyword = getFormInput('MetaKeyword') ? getFormInput('MetaKeyword') : getFormInput('Title');
                
                $Title = getFormInput('Title');
				$Slug = get_virtual_link($Title);
                
                $SimpleContent = getFormInput('SimpleContent');
                $Content = getFormInput('Content');
				
				
				//die($Content);
				//$Content = str_replace($str1, , $Content);
				//die($Content);
				
				
                $Status = getFormInput('Status') == "1" ? 1 : 0;
				$Star = getFormInput('Star') == "1" ? 1 : 0;
				$Event = getFormInput('Event') == "1" ? 1 : 0;
				$DateUpdated = getFormInput('DateUpdated') == "" ? false : true;
				
				$today = date('Y-m-d');				
				$_dateIn = getInput('_dateIn') ? getInput('_dateIn') : "";				
				
				$ManualTime = strtotime($_dateIn);
				
				
				$ViewedCount = getFormInput('ViewedCount') ? getFormInput('ViewedCount') : 0;
				$MemberID = $_SESSION['memberID'];
			
                $fields = array("CmsID" => $CmsID, "MetaTitle" => $MetaTitle, "MetaDescription" => $MetaDescription, "MetaKeyword" => $MetaKeyword, 
				"Title" => $Title, "Avatar" => $Avatar,"SimpleContent" => $SimpleContent, "Content" => $Content);
				
				
				if ($Module == "")
				{
					CmsView::detail ("Bạn đã chưa chọn danh mục!", "error", $fields);
				}
				else if ($Title == "" || $Content == ""){				
					 CmsView::detail ("Bạn đã điền thiếu thông tin!", "error", $fields);
				}
                else{
					
					$objCmsCategories = new CmsCategories();
				
					$objCat = $objCmsCategories->getCmsCategories($Module, null);
					
					if ($objCat != null && $objCat["CategoryID"] != "")
					{
						
						if ($_FILES['Avatar']["name"] != "")
						{						
							$imageUploader = new ImageUploader ( $_FILES ['Avatar'] );
							
							//@@ Truong hop loi ko upload dc image				
							if ($imageUploader->checkUploadError () == true) {											
								
								CmsView::detail ("Có lỗi up ảnh. Vui lòng liên hệ WebMaster!", "error", $fields);						
								return;
							}
							else
							{
							
								if ($imageUploader->processAttach ( $objCat["Slug"], substr($Slug, 0, 10) )) {
									$Avatar = $imageUploader->getAttachName ( $objCat["Slug"] );							
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
											
						$objHandle->set ( $objCat['CategoryID'], $MetaTitle, $MetaDescription, $MetaKeyword, $Slug, $Title, $Avatar, $SimpleContent, $Content, $Status, $Star, $Event, $ViewedCount, $DateUpdated, $MemberID );
						
						if ($DateUpdated == true)
						{
							//die("123");
							
							$objHandle->update (true, $ManualTime);
						}
						else
						{
							$objHandle->update ();
						}
						
						Session::saveMessageSession ( "Lệnh thực hiện đã được cập nhật vào!", "success" );                    
						Session::redirect("index.php?module=Cms&type=".$Module);					
					}
					else
					{
						CmsView::detail ("Danh mục chưa cho phép active!", "error", $fields);
					}
                
                }
            } else {
                $objHandle = new Cms ();
                
                CmsView::detail (null, null, $objHandle->getCms ( $CmsID ) );
            }
        } else {
            Session::redirect("index.php?module=Cms&type=".$Module);
        }
    }
    
    function delete() {
        $CmsID = getInt ( 'CmsID' );
		$Module = getInput('type');
        
        if ($CmsID > 0) {
            $objHandle = new Cms ( $CmsID );
            $objHandle->delete ();
            
            Session::saveMessageSession ( "Lệnh thực hiện đã được xóa thành công !", "success" );            
            Session::redirect("index.php?module=Cms&type=".$Module);
        } else {
            Session::redirect("index.php?module=Cms&type=".$Module);
        }
    }
}

?>