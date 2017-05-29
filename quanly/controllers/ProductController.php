<?php

//@ Ten file     : ProductController.cs ver 1.0 
//@ Ngay tao 	 : 11.09.13 

require_once (MODELS_PATH . 'Product.php');
require_once (MODELS_PATH . 'ProductCategories.php');
require_once (VIEWS_ADMIN_PATH . 'ProductView.php');
require_once (LIBS_PATH . 'ImageUploader.php');

new ProductController ();

class ProductController {
    
    private $action;
    
    function ProductController() {
        
        $trace = debug_backtrace ();
        
        $actions = array (array ("ViewList", "viewlist" ), array ("ViewPagingList", "viewPaginglist" ), array ("Insert", "insert" ), array ("Update", "update" ), array ("Delete", "delete" ) );
        $this->action = new Action ( $trace [0] ["function"], $actions );
        $this->action->setDefaultAction ( 'viewPaginglist' );
        $this->action->execute ();
    }
    
    function viewlist() {        
        $objHandle = new Product ();
		$objHandleCat = new ProductCategories ();
        ProductView::viewList ( $objHandle->getAllProduct (), $objHandleCat->getAllProductCategories(), null );
    }
    function viewPaginglist() { 
		$CategoryID = getInput("CategoryID");
        $currentPage = getInput("currentPage");
        $currentPage = $currentPage ? $currentPage : "1";
        $totalDisplay = getInput("totalDisplay");
        $totalDisplay = $totalDisplay ? $totalDisplay :"20";
        $orderby = "ProductID";
        
		$objHandle = new Product ();        
		$objHandleCat = new ProductCategories ();
		$displayItem = $objHandle->getPagingProduct($totalDisplay, $currentPage, $orderby, null, $CategoryID);
		
		$itemCount = count($displayItem); 
        
        //@ Display
        $previousPage = $currentPage - 1;
        $nextPage = $currentPage + 1;
        
        $firstLi = ($currentPage == 1 || $currentPage == 2) ? "" : "<li class='non_page'><a href='index.php?module=Product&act=ViewPagingList&CategoryID={$CategoryID}&currentPage=1&totalDisplay=$totalDisplay'>1</a></li>";
        $firstLi .= (($currentPage == 1 || $currentPage == 2) || $currentPage == 3) ? "" : "<li>...</li>";
        $previousLi = ($currentPage == 1) ? "" : "<li class='non_page'><a href='index.php?module=Product&act=ViewPagingList&CategoryID={$CategoryID}&currentPage=$previousPage&totalDisplay=$totalDisplay'>$previousPage</a></li>";
        $lastLi = ($itemCount == $totalDisplay) ? "<li class='non_page'><a href='index.php?module=Product&act=ViewPagingList&CategoryID={$CategoryID}&currentPage=$nextPage&totalDisplay=$totalDisplay'>$nextPage</a></li>" : "";
        
        $footer =<<<EOF
		        
        <ul class="list_page">
        	<li style="margin-right:10px;">Trang: </li>
        	{$firstLi}
        	{$previousLi}
        	<li class='current_page'><a href='index.php?module=Product&act=ViewPagingList&currentPage=$previousPage&CategoryID={$CategoryID}&totalDisplay=$totalDisplay'>{$currentPage}</a></li>        	
        	{$lastLi}        
EOF;
        
		
        ProductView::viewList ( $displayItem , $objHandleCat->getAllProductCategories(), $footer);
        
    }
    
    function insert() {
        
        if (isset ( $_POST ['insert'] )) {
            $CategoryID = getFormInput('CategoryID');
			
            
            $Name = getFormInput('Name');
			$Slug = get_virtual_link($Name);
            $ShortDescription = getFormInput('ShortDescription');
            $FullDescription = getFormInput('FullDescription');
            
            $Price = getFormInput('Price');
            $Promotion = getFormInput('Promotion');
            $Warranty = getFormInput('Warranty');
            $Status = getFormInput('Status');
            $Order = getFormInput('Order') ? "1" : 0;
            $Featured = getFormInput('Featured') == "1" ? "1" : "0";
			$FeaturedDate = $Featured == "1" ? time() : "0";
			
			
			$fields = array("CategoryID" => $CategoryID, "Name" => $Name, "ShortDescription" => $ShortDescription, "FullDescription" => $FullDescription, 
				"Price" => $Price, "Promotion" => $Promotion,"Warranty" => $Warranty, "Status" => $Status,  "Order" => $Order,  "Featured" => $Featured);
            
			if ($CategoryID == "" || $Name == "" || $FullDescription == "" || $Price == "")
			{
				ProductView::detail ( "Vui lòng điền đầy đủ thông tin !", "error", $fields);
			}else
			{
				$imageUploader = new ImageUploader ( $_FILES ['Image'] );
				
				if($imageUploader != null)
				{
					//@@ Truong hop loi ko upload dc image				
					if ($imageUploader->checkUploadError () == true) {					
						ProductView::detail ("Có lỗi up ảnh. Vui lòng liên hệ WebMaster!", "error", $fields);						
					}
					else
					{
						if ($imageUploader->processAttach ( "products", substr($Slug, 0, 10) )) {
							$Image = $imageUploader->getAttachName ( "products" );							
						}
					}
				}
				
                $objHandle = new Product ();
                $objHandle->set ( $CategoryID, $Slug, $Name, $ShortDescription, $FullDescription, $Image, $Price, $Promotion, $Warranty, $Status, $Order, $Featured, $FeaturedDate, $DateAdded, $DateUpdated );
                $objHandle->insert ();
                
                Session::saveMessageSession ( "Sản phẩm mới đã được thêm vào!", "success" );                
                Session::location ( "Product", "ViewPagingList" );
            
            } 
        } else {
            ProductView::detail ();
        }
    }
    
    function update() {
        $ProductID = getInt ( 'ProductID' );
        
        if ($ProductID > 0) {
            
            if (isset ( $_POST ['update'] )) {
                $CategoryID = getFormInput('CategoryID');
			            
				$Name = getFormInput('Name');
				
				$Slug = get_virtual_link($Name);
				$ShortDescription = getFormInput('ShortDescription');
				$FullDescription = getFormInput('FullDescription');
				
				$Price = getFormInput('Price');
				$Promotion = getFormInput('Promotion');
				$Warranty = getFormInput('Warranty');
				$Status = getFormInput('Status');
				$Order = getFormInput('Order') ? "1" : 0;
				$Featured = getFormInput('Featured') == "1" ? "1" : "0";
				$FeaturedDate = $Featured == "1" ? time() : "0";
                
                $fields = array("ProductID" => $ProductID, "CategoryID" => $CategoryID, "Name" => $Name, "ShortDescription" => $ShortDescription, "FullDescription" => $FullDescription, 
				"Price" => $Price, "Promotion" => $Promotion,"Warranty" => $Warranty, "Status" => $Status,  "Order" => $Order,  "Featured" => $Featured);
            
				if ($CategoryID == "" || $Name == "" || $FullDescription == "" || $Price == "")
				{
					ProductView::detail ( "Vui lòng điền đầy đủ thông tin !", "error", $fields );
				}else
				{
                    $imageUploader = new ImageUploader ( $_FILES ['Image'] );
					
					//@@ Truong hop loi ko upload dc image				
					if ($imageUploader != "")
					{
						if ($imageUploader->checkUploadError () == true) {					
							ProductView::detail ("Có lỗi up ảnh. Vui lòng liên hệ WebMaster!", "error", $fields);						
						}
						else
						{
							if ($imageUploader->processAttach ( "products", substr($Slug, 0, 10) )) {
								$Image = $imageUploader->getAttachName ( "products" );							
							}
						}
					}
					else
					{
						$Image = getFormInput('ImageBk');
					}
					
					$objHandle = new Product ( $ProductID );
					$objHandle->set ( $CategoryID, $Slug, $Name, $ShortDescription, $FullDescription, $Image, $Price, $Promotion, $Warranty, $Status, $Order, $Featured, $FeaturedDate, $DateAdded, $DateUpdated );
					$objHandle->update ();
					
					
					Session::saveMessageSession ( "Sản phẩm đã được cập nhật vào!", "success" );                    
					Session::location ( "Product", "ViewPagingList" );
					
				}				           
			} else {
                $objHandle = new Product ();
                
                ProductView::detail ( null, null, $objHandle->getProduct ( $ProductID ) );
            }
        } else {
            Session::location ( "Product", "ViewPagingList" );
        }
    }
    
    function delete() {
        $ProductID = getInt ( 'ProductID' );
        
        if ($ProductID > 0) {
            $objHandle = new Product ( $ProductID );
            $objHandle->delete ();
            
            Session::saveMessageSession ( "Sản phẩm đã được xóa thành công !", "success" );            
            Session::location ( "Product", "ViewPagingList" );
        } else {
            Session::location ( "Product", "ViewPagingList" );
        }
    }
}

?>

