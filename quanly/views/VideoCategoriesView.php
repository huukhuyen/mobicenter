<?php

//@ Tệp file     : VideoCategoriesView.cs ver 1.0 
//@ Mobile Center

class VideoCategoriesView
{
    function viewList($pages)
    {
        $header = 'Video categories';
        
        if(Session::checkMessageSession())
        {
            $m = Session::getMessageSession();
            
            $message = $m['message'];
            $messageType = $m['type'];
        }
        
        require_once(VIEWS_COMMON_ADMIN_PATH.'header.tpl');
        require_once(VIEWS_COMMON_ADMIN_PATH.'TabBegin.tpl');
echo <<<EOF
        <div><input type="button" class="button2" value="Thêm danh mục" style="margin-bottom:10px;"onclick="location.href='index.php?module=VideoCategories&act=Insert';"></div>
        <table class="adminlist">
            <thead>
                <tr>
                    <th width="20">Type ID</th>
                    <th class="title" nowrap="nowrap">Name</th>
                    <th class="title" nowrap="nowrap">Status</th>
					<th class="title" nowrap="nowrap">Year</th>
                        
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
        $editHref = 'index.php?module=VideoCategories&act=Update&VideoCategoryID='.$page['VideoCategoryID'];
        $removeHref = 'index.php?module=VideoCategories&act=Delete&VideoCategoryID='.$page['VideoCategoryID'];
        
        echo <<<EOF
                <tr>
                    <td width="20"align="center"><!-- BEGIN VideoCategoryID -->{$page['VideoCategoryID']}<!-- END VideoCategoryID --></td>
                    <td><!-- BEGIN Name -->{$page['Name']}<!-- END Name --></td>
					<td><!-- BEGIN Name -->{$page['Status']}<!-- END Name --></td>
					<td><!-- BEGIN Name -->{$page['Year']}<!-- END Name --></td>
                    
                    
                    <td width="60"align="center"><a href="$editHref"><img src="images/edit.png" /></a></td>
	                <td width="60"align="center"><a onclick="return confirm('Bạn có chắc chắn muốn xóa không ?');" href="$removeHref"><img src="images/delete.png" /></a></td>                    
                </tr>
EOF;
    }
}

echo <<<EOF
            </tbody>
        </table>
EOF;
        require_once(VIEWS_COMMON_ADMIN_PATH.'TabEnd.tpl');
        require_once(VIEWS_COMMON_ADMIN_PATH.'footer.tpl');
    }
    
    function detail($message = null, $messageType = null, $fields = null)
    {        
        $header = $fields != null ? 'Chỉnh "Danh mục"' : 'Thêm "Danh mục"';
                
        require_once(VIEWS_COMMON_ADMIN_PATH.'header.tpl');
        require_once(VIEWS_ADMIN_PATH.'VideoCategories.tpl');
        require_once(VIEWS_COMMON_ADMIN_PATH.'footer.tpl');
    }
}

?>

