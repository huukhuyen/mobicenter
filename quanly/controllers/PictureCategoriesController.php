<?php

//@ Tệp file     : PictureCategoriesController.cs ver 1.0 
//@ Mobile Center

require_once (MODELS_PATH . 'PictureCategories.php');
require_once (VIEWS_ADMIN_PATH . 'PictureCategoriesView.php');

new PictureCategoriesController ();

class PictureCategoriesController {
    
    private $action;
    
    function PictureCategoriesController() {
        
        $trace = debug_backtrace ();
        
        $actions = array (array ("ViewList", "viewlist" ), array ("ViewPagingList", "viewPaginglist" ), array ("Insert", "insert" ), array ("Update", "update" ), array ("Delete", "delete" ) );
        $this->action = new Action ( $trace [0] ["function"], $actions );
        $this->action->setDefaultAction ( 'viewlist' );
        $this->action->execute ();
    }
    
    function viewlist() {        
        $objHandle = new PictureCategories ();
        PictureCategoriesView::viewList ( $objHandle->getAllPictureCategories () );
    }
    function viewPaginglist() {        
        $currentPage = getInput("currentPage");
        $currentPage = $currentPage ? $currentPage : "1";
        $totalDisplay = getInput("totalDisplay");
        $totalDisplay = $totalDisplay ? $totalDisplay :"20";
        $orderby = "DateUpdated";
        
        $objHandle = new Logs ();
        PictureCategoriesView::viewList ( $objHandle->getPagingLogs($totalDisplay, $currentPage, $orderby) );
    }
    
    function insert() {
        
        if (isset ( $_POST ['insert'] )) {
            $Name = getFormInput('Name');
			$Status = getFormInput('Status');
			$Year = getFormInput('Year');
			//die($Status);
            $Slug = getFormInput('Slug') ? getFormInput('Slug') : get_virtual_link($Name);
            
            //if ($BoxTypeName != '') {
            if ($Name == "" ){
				PictureCategoriesView::detail ( "Vui lòng điền đầy đủ thông tin !", "error" );
			}
			else{
                $objHandle = new PictureCategories ();
                $objHandle->set ( $Name, $Slug, $Status, $Year );
                $objHandle->insert ();
                
                Session::saveMessageSession ( "Danh mục ảnh mới đã được thêm vào!", "success" );                
                Session::location ( "PictureCategories", "ViewList" );
            
            }
        } else {
            PictureCategoriesView::detail ();
        }
    }
    
    function update() {
        $PictureCategoryID = getInt ( 'PictureCategoryID' );
        
        if ($PictureCategoryID > 0) {
            
            if (isset ( $_POST ['update'] )) {
                $Name = getFormInput('Name');
				$Status = getFormInput('Status');
				$Year = getFormInput('Year');
                $Slug = getFormInput('Slug') ? getFormInput('Slug') : get_virtual_link($Name);
				
                
                //if ($BoxTypeName != '') {
                if ($Name == "" ){
					PictureCategoriesView::detail ( "Vui lòng điền đầy đủ thông tin !", "error" );
				}
				else{
                    
                    $objHandle = new PictureCategories ( $PictureCategoryID );
                    $objHandle->set ( $Name, $Slug, $Status, $Year );
                    $objHandle->update ();
                    
                    Session::saveMessageSession ( "Danh mục ảnh đã được cập nhật vào!", "success" );                    
                    Session::location ( "PictureCategories", "ViewList" );
                
                }
            } else {
                $objHandle = new PictureCategories ();
                
                PictureCategoriesView::detail ( null, null, $objHandle->getPictureCategories ( $PictureCategoryID ) );
            }
        } else {
            Session::location ( "PictureCategories", "ViewList" );
        }
    }
    
    function delete() {
        $PictureCategoryID = getInt ( 'PictureCategoryID' );
        
        if ($PictureCategoryID > 0) {
            $objHandle = new PictureCategories ( $PictureCategoryID );
            $objHandle->delete ();
            
            Session::saveMessageSession ( "Danh mục ảnh đã được xóa thành công !", "success" );            
            Session::location ( "PictureCategories", "ViewList" );
        } else {
            Session::location ( "PictureCategories", "ViewList" );
        }
    }
}

?>

