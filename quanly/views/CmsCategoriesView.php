<?php

//@ Tệp file     : CmsCategoriesView.cs ver 1.0 

class CmsCategoriesView
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
        <div><input type="button" class="button2" value="Thêm danh mục" style="margin-bottom:10px;"onclick="location.href='index.php?module=CmsCategories&act=Insert';"></div>
        <table class="adminlist">
            <thead>
                <tr>
                                   
                    <th class="title" nowrap="nowrap">Tên danh mục</th>
					<th class="title" nowrap="nowrap">Thứ tự</th>
                    
                        
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
	
		if ($page['ParentID'] != 0)
		{
			$page['Name'] = "|____".$page['Name'];
		}
        $editHref = 'index.php?module=CmsCategories&act=Update&CategoryID='.$page['CategoryID'];
        $removeHref = 'index.php?module=CmsCategories&act=Delete&CategoryID='.$page['CategoryID'];
        
        echo <<<EOF
                <tr>
                    
                    <td><!-- BEGIN Name --><a style="font-size:15px" href=index.php?module=Cms&type={$page['CategoryID']}>{$page['Name']}</a><!-- END Name --></td>                    
					<td><!-- BEGIN Name -->{$page['Index']}<!-- END Name --></td>                    
                    
                    <td width="60"align="center"><a href="$editHref"><img src="images/edit.png" /></a></td>
                    <td width="60"align="center"><a onclick="return confirm('Bạn có chắc chắn muốn xóa không ?');" href="$removeHref"><img src="images/delete.png" /></a></td>
					
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
        require_once(VIEWS_ADMIN_PATH.'CmsCategories.tpl');
        require_once(VIEWS_COMMON_ADMIN_PATH.'footer.tpl');
    }
}

?>

