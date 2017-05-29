<?php

//@ Tệp file     : PictureController.cs ver 1.0 
//@ Mobile Center

require_once (MODELS_PATH . 'Picture.php');
require_once (MODELS_PATH . 'PictureCategories.php');
require_once (LIBS_PATH . 'ImageUploader.php');
require_once (VIEWS_ADMIN_PATH . 'PictureView.php');

new PictureController ();

class PictureController {
    
    private $action;
    
    function PictureController() {
        
        $trace = debug_backtrace ();
        
        $actions = array (array ("ViewList", "viewlist" ), array ("ViewPagingList", "viewPaginglist" ), array ("Insert", "insert" ), array ("Update", "update" ), array ("Delete", "delete" ) );
        $this->action = new Action ( $trace [0] ["function"], $actions );
        $this->action->setDefaultAction ( 'viewPaginglist' );
        $this->action->execute ();
    }
    
    function viewlist() {        
        $objHandle = new Picture ();
		$objHandleCat = new PictureCategories ();
        PictureView::viewList ( $objHandle->getAllPicture (), $objHandleCat->getAllPictureCategories(), null );
    }
    function viewPaginglist() {        
		$PictureCategoryID = getInput("PictureCategoryID");
        $currentPage = getInput("currentPage");
        $currentPage = $currentPage ? $currentPage : "1";
        $totalDisplay = getInput("totalDisplay");
		$totalDisplay = $totalDisplay ? $totalDisplay :"20";
        $orderby = "PictureID";
        
		$objHandle = new Picture ();        
		$objHandleCat = new PictureCategories ();
		$displayItem = $objHandle->getPagingPicture($totalDisplay, $currentPage, $orderby, null, $PictureCategoryID);
		
		$itemCount = count($displayItem); 
        
        //@ Display
        $previousPage = $currentPage - 1;
        $nextPage = $currentPage + 1;
        
        $firstLi = ($currentPage == 1 || $currentPage == 2) ? "" : "<li class='non_page'><a href='index.php?module=Picture&act=ViewPagingList&PictureCategoryID={$PictureCategoryID}&currentPage=1&totalDisplay=$totalDisplay'>1</a></li>";
        $firstLi .= (($currentPage == 1 || $currentPage == 2) || $currentPage == 3) ? "" : "<li>...</li>";
        $previousLi = ($currentPage == 1) ? "" : "<li class='non_page'><a href='index.php?module=Picture&act=ViewPagingList&PictureCategoryID={$PictureCategoryID}&currentPage=$previousPage&totalDisplay=$totalDisplay'>$previousPage</a></li>";
        $lastLi = ($itemCount == $totalDisplay) ? "<li class='non_page'><a href='index.php?module=Picture&act=ViewPagingList&PictureCategoryID={$PictureCategoryID}&currentPage=$nextPage&totalDisplay=$totalDisplay'>$nextPage</a></li>" : "";
        
        $footer =<<<EOF
		        
        <ul class="list_page">
        	<li style="margin-right:10px;">Trang: </li>
        	{$firstLi}
        	{$previousLi}
        	<li class='current_page'><a href='index.php?module=Picture&act=ViewPagingList&currentPage=$previousPage&PictureCategoryID={$PictureCategoryID}&totalDisplay=$totalDisplay'>{$currentPage}</a></li>        	
        	{$lastLi}        
EOF;
        
		
        PictureView::viewList ( $displayItem , $objHandleCat->getAllPictureCategories(), $footer);
    }
    
    function insert() {
        
		
        if (isset ( $_POST ['insert'] )) {
			
            $PictureCategoryID = getFormInput('PictureCategoryID');
			
			
            $Name = getFormInput('Name');
			$Slug = get_virtual_link($Name);
            
			$Description = getFormInput('Description');
			
			
            
            if ($PictureCategoryID == "0" || $_FILES ['Image'] == null){
				PictureView::detail ( "Vui lòng điền đầy đủ thông tin !", "error" );
			}
			else{
			
					$imageUploader = new ImageUploader ( $_FILES ['Image'] );
					
					
					//@@ Truong hop loi ko upload dc image				
					if ($imageUploader->checkUploadError () == true) {					
						PictureView::detail ("Có lỗi up ảnh. Vui lòng liên hệ WebMaster!", "error", $fields);						
						
					}
					else
					{
						
						if ($imageUploader->processAttach ( "picture", substr($Slug, 0, 10) )) {
							$Image = $imageUploader->getAttachName ( "picture" );							
						}
					}
				
				
                $objHandle = new Picture ();
                $objHandle->set ( $PictureCategoryID, $Slug, $Name, $Image, $Description,$DateUpdated );
                $objHandle->insert ();
                
                Session::saveMessageSession ( "Picture mới đã được thêm vào!", "success" );                
                Session::redirect("index.php?module=Picture&PictureCategoryID=".getFormInput('PictureCategoryID'));
            
            } 
        } else {
            PictureView::detail ();
        }
    }
    
    function update() {
        $PictureID = getInt ( 'PictureID' );
        
        if ($PictureID > 0) {
            
            if (isset ( $_POST ['update'] )) {
                $PictureCategoryID = getFormInput('PictureCategoryID');
                
                $Name = getFormInput('Name');
				$Slug = get_virtual_link($Name);
                $Image = getFormInput('Image2');
				$Description = getFormInput('Description');
                
                
                //if ($BoxTypeName != '') {
                if ($PictureCategoryID == "0" || $_FILES ['Image'] == null){
					PictureView::detail ( "Vui lòng điền đầy đủ thông tin !", "error" );
				}else
				{         
					$imageUploader = new ImageUploader ( $_FILES ['Image'] );
					
					//@@ Truong hop loi ko upload dc image				
					if ($imageUploader->checkUploadError () == true) {					
						PictureView::detail ("Có lỗi up ảnh. Vui lòng liên hệ WebMaster!", "error", $fields);						
					}
					else
					{
						if ($imageUploader->processAttach ( "picture", substr($Slug, 0, 10) )) {
							$Image = $imageUploader->getAttachName ( "picture" );							
						}
					}
				
                    $objHandle = new Picture ( $PictureID );
                    $objHandle->set ( $PictureCategoryID, $Slug, $Name, $Image, $Description,$DateUpdated );
                    $objHandle->update ();
                    
                    Session::saveMessageSession ( "Picture đã được cập nhật vào!", "success" );                    
                    Session::redirect("index.php?module=Picture&PictureCategoryID=".getFormInput('PictureCategoryID'));
                
                }
            } else {
                $objHandle = new Picture ();
                
                PictureView::detail ( null, null, $objHandle->getPicture ( $PictureID ) );
            }
        } else {
            Session::location ( "Picture", "ViewList" );
        }
    }
    
    function delete() {
        $PictureID = getInt ( 'PictureID' );
        
        if ($PictureID > 0) {
            $objHandle = new Picture ( $PictureID );
            $objHandle->delete ();
            
            Session::saveMessageSession ( "Picture đã được xóa thành công !", "success" );            
            Session::location ( "Picture", "ViewList" );
        } else {
            Session::redirect("index.php?module=Picture&PictureCategoryID=".getFormInput('PictureCategoryID'));
        }
    }
}

?>

