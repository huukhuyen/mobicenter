<?php

//@ Tệp file     : ProductCategoriesView.cs ver 1.0 

class ProductCategoriesView
{
    function viewList($pages, $footer = null)
    {
        $header = 'Danh mục';
        
        if(Session::checkMessageSession())
        {
            $m = Session::getMessageSession();
            
            $message = $m['message'];
            $messageType = $m['type'];
        }
        
        require_once(VIEWS_COMMON_ADMIN_PATH.'header.tpl');
        require_once(VIEWS_COMMON_ADMIN_PATH.'TabBegin.tpl');
echo <<<EOF
        <div><input type="button" class="button2" value="Thêm Product categories" style="margin-bottom:10px;"onclick="location.href='index.php?module=ProductCategories&act=Insert';">
		
		
		</div>
        
		
		<table class="adminlist">
            <thead>
                <tr>
                    <th width="20">#</th>                    
                    <th class="title" nowrap="nowrap">Tên danh mục</th>
                    <th width="60">Chỉnh sửa</th>
                    <th width="60">Xóa</th>
                </tr>
            </thead>
            
            <tbody>
EOF;
if(is_array($pages) && sizeof($pages) > 0)
{
    foreach ($pages as $page)
    {        
        $editHref = 'index.php?module=ProductCategories&act=Update&CategoryID='.$page['CategoryID'];
        $removeHref = 'index.php?module=ProductCategories&act=Delete&CategoryID='.$page['CategoryID'];
        
        echo <<<EOF
                <tr>
                    <td width="20"align="center"><!-- BEGIN CategoryID -->{$page['CategoryID']}<!-- END CategoryID --></td>                    
                    <td><!-- BEGIN Name -->{$page['Name']}<!-- END Name --></td>                    
                    
                    <td width="60"align="center"><a href="$editHref"><img src="images/edit.png"></a></td>
                    <td width="60"align="center"><a onclick="return confirm('Bạn có chắc chắn muốn xóa không ?');" href="$removeHref"><img src="images/delete.png"></a></td>
                </tr>
EOF;
    }
}

echo <<<EOF
            </tbody>
        </table>
        <div style="margin-left:300px; padding-bottom: 20px;">{$footer}</div>
EOF;
        require_once(VIEWS_COMMON_ADMIN_PATH.'TabEnd.tpl');
        require_once(VIEWS_COMMON_ADMIN_PATH.'footer.tpl');
    }
    
    function detail($message = null, $messageType = null, $fields = null)
    {        
        $header = $fields != null ? 'Chỉnh danh mục' : 'Thêm danh mục';
                
        require_once(VIEWS_COMMON_ADMIN_PATH.'header.tpl');
        require_once(VIEWS_ADMIN_PATH.'ProductCategories.tpl');
        require_once(VIEWS_COMMON_ADMIN_PATH.'footer.tpl');
    }
}

?>

