<?php

//@ Ten file     : CmsCategoriesController.cs ver 1.0 
//@ Ngay tao 	 : 11.09.13 

require_once (MODELS_PATH . 'CmsCategories.php');
require_once (VIEWS_ADMIN_PATH . 'CmsCategoriesView.php');

new CmsCategoriesController ();

class CmsCategoriesController {
    
    private $action;
    
    function CmsCategoriesController() {
        
        $trace = debug_backtrace ();
        
        $actions = array (array ("ViewList", "viewlist" ), array ("ViewPagingList", "viewPaginglist" ), array ("Insert", "insert" ), array ("Update", "update" ), array ("Delete", "delete" ) );
        $this->action = new Action ( $trace [0] ["function"], $actions );
        $this->action->setDefaultAction ( 'viewlist' );
        $this->action->execute ();
    }
    
    function viewlist() {        
        
		$category = new CmsCategories();
		$cat_parent = $category->getAllCmsCategoriesByParent();	
		
		$cat = $category->getAllCmsCategoriesByGroup($cat_parent);	
		
        CmsCategoriesView::viewList ( $cat );
    }
    function viewPaginglist() {        
        $currentPage = getInput("currentPage");
        $currentPage = $currentPage ? $currentPage : "1";
        $totalDisplay = getInput("totalDisplay");
        $totalDisplay = $totalDisplay ? $totalDisplay :"20";
        $orderby = "CategoryID";
        
        $objHandle = new CmsCategories();
		
		
        CmsCategoriesView::viewList ( $objHandle->getCmsCategories($totalDisplay, $currentPage, $orderby) );
    }
    
    function insert() {
        
        if (isset ( $_POST ['insert'] )) {
            $ParentID = getFormInput('ParentID');
            $Name = getFormInput('Name');
            $Slug = get_virtual_link($Name);
			$Index = getFormInput('Index');
            
            //if ($BoxTypeName != '') {
            if (true){
                $objHandle = new CmsCategories ();
                $objHandle->set ( $ParentID, $Name, $Slug, $Index );
                $objHandle->insert ();
                
                Session::saveMessageSession ( "Danh mục mới đã được thêm vào!", "success" );                
                Session::location ( "CmsCategories", "ViewList" );
            
            } else {
                CmsCategoriesView::detail ( "Vui lòng chọn thông tin!", "error" );
            }
        } else {
            CmsCategoriesView::detail ();
        }
    }
    
    function update() {
        $CategoryID = getInt ( 'CategoryID' );
        
        if ($CategoryID > 0) {
            
            if (isset ( $_POST ['update'] )) {
                $ParentID = getFormInput('ParentID');
                $Name = getFormInput('Name');
                $Slug = get_virtual_link($Name);
				$Index = getFormInput('Index');
                
                //if ($BoxTypeName != '') {
                if (true){
                    
                    $objHandle = new CmsCategories ( $CategoryID );
                    $objHandle->set ( $ParentID, $Name, $Slug, $Index );
                    $objHandle->update ();
                    
                    Session::saveMessageSession ( "Danh mục đã được cập nhật!", "success" );                    
                    Session::location ( "CmsCategories", "ViewList" );
                
                } else {
                    CmsCategoriesView::detail ( "Vui lòng chọn thông tin đăng ký!", "error" );
                }
            } else {
                $objHandle = new CmsCategories ();
                
                CmsCategoriesView::detail ( null, null, $objHandle->getCmsCategories ( $CategoryID ) );
            }
        } else {
            Session::location ( "CmsCategories", "ViewList" );
        }
    }
    
    function delete() {
        $CategoryID = getInt ( 'CategoryID' );
        
        if ($CategoryID > 0) {
            $objHandle = new CmsCategories ( $CategoryID );
            $objHandle->delete ();
            
            Session::saveMessageSession ( "Danh mục đã được xóa thành công !", "success" );            
            Session::location ( "CmsCategories", "ViewList" );
        } else {
            Session::location ( "CmsCategories", "ViewList" );
        }
    }
}

?>

