<?php

//@ Ten file     : ProductCategoriesController.cs ver 1.0 
//@ Ngay tao 	 : 11.09.13 

require_once (MODELS_PATH . 'ProductCategories.php');
require_once (VIEWS_ADMIN_PATH . 'ProductCategoriesView.php');

new ProductCategoriesController ();

class ProductCategoriesController {
    
    private $action;
    
    function ProductCategoriesController() {
        
        $trace = debug_backtrace ();
        
        $actions = array (array ("ViewList", "viewlist" ), array ("ViewPagingList", "viewPaginglist" ), array ("Insert", "insert" ), array ("Update", "update" ), array ("Delete", "delete" ) );
        $this->action = new Action ( $trace [0] ["function"], $actions );
        $this->action->setDefaultAction ( 'viewlist' );
        $this->action->execute ();
    }
    
    function viewlist() {        
        $objHandle = new ProductCategories ();
        ProductCategoriesView::viewList ( $objHandle->getAllProductCategories () );
    }
    function viewPaginglist() {        
        $currentPage = getInput("currentPage");
        $currentPage = $currentPage ? $currentPage : "1";
        $totalDisplay = getInput("totalDisplay");
        $totalDisplay = $totalDisplay ? $totalDisplay :"20";
        $orderby = "CategoryID";
        
        $objHandle = new ProductCategories();
        ProductCategoriesView::viewList ( $objHandle->getProductCategories($totalDisplay, $currentPage, $orderby) );
    }
    
    function insert() {
        
        if (isset ( $_POST ['insert'] )) {
            $ParentID = getFormInput('ParentID');
            $Name = getFormInput('Name');
            $Slug = get_virtual_link($Name);
            
            //if ($BoxTypeName != '') {
            if (true){
                $objHandle = new ProductCategories ();
                $objHandle->set ( $ParentID, $Name, $Slug );
                $objHandle->insert ();
                
                Session::saveMessageSession ( "Danh mục mới đã được thêm vào!", "success" );                
                Session::location ( "ProductCategories", "ViewList" );
            
            } else {
                ProductCategoriesView::detail ( "Vui lòng chọn thông tin!", "error" );
            }
        } else {
            ProductCategoriesView::detail ();
        }
    }
    
    function update() {
        $CategoryID = getInt ( 'CategoryID' );
        
        if ($CategoryID > 0) {
            
            if (isset ( $_POST ['update'] )) {
                $ParentID = getFormInput('ParentID');
                $Name = getFormInput('Name');
                $Slug = get_virtual_link($Name);
                
                //if ($BoxTypeName != '') {
                if (true){
                    
                    $objHandle = new ProductCategories ( $CategoryID );
                    $objHandle->set ( $ParentID, $Name, $Slug );
                    $objHandle->update ();
                    
                    Session::saveMessageSession ( "Danh mục đã được cập nhật!", "success" );                    
                    Session::location ( "ProductCategories", "ViewList" );
                
                } else {
                    ProductCategoriesView::detail ( "Vui lòng chọn thông tin đăng ký!", "error" );
                }
            } else {
                $objHandle = new ProductCategories ();
                
                ProductCategoriesView::detail ( null, null, $objHandle->getProductCategories ( $CategoryID ) );
            }
        } else {
            Session::location ( "ProductCategories", "ViewList" );
        }
    }
    
    function delete() {
		$_GET['CategoryID'];
		getInt('CategoryID');
        $CategoryID = getInt ( 'CategoryID' );
        
        if ($CategoryID > 0) {
            $objHandle = new ProductCategories ( $CategoryID );
            $objHandle->delete ();
            
            Session::saveMessageSession ( "Danh mục đã được xóa thành công !", "success" );            
            Session::location ( "ProductCategories", "ViewList" );
        } else {
            Session::location ( "ProductCategories", "ViewList" );
        }
    }
}

?>

