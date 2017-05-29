<?php

class PageView
{
    function viewList($pages)
    {
        $header = 'List Page';
        
        if(Session::checkMessageSession())
        {
            $m = Session::getMessageSession();
            
            $message = $m['message'];
            $messageType = $m['type'];
        }
        
        require_once(VIEWS_COMMON_ADMIN_PATH.'header.tpl');
        require_once(VIEWS_COMMON_ADMIN_PATH.'TabBegin.tpl');
echo <<<EOF
        <!--<div><input type="button" class="button2" value="Thêm Page" style="margin-bottom:10px;"onclick="location.href='index.php?module=Page&act=Insert';"></div>-->
        <table class="adminlist">
            <thead>
                <tr>
                    <th width="20">Type ID</th>
                    <th class="title" nowrap="nowrap">Slug</th>
                    <th class="title" nowrap="nowrap">Name</th>
                    <th class="title" nowrap="nowrap">Content</th>
                    <th class="title" nowrap="nowrap">Status</th>
                    <th class="title" nowrap="nowrap">DateUpdated</th>
                        
                    <th width="60">Chỉnh sửa</th>
                    <!--<th width="60">Xóa</th>-->
                </tr>
            </thead>
            
            <tbody>
EOF;
if(is_array($pages) && sizeof($pages) > 0)
{
    foreach ($pages as $page)
    {        
        $editHref = 'index.php?module=Page&act=Update&PageID='.$page['PageID'];
        $removeHref = 'index.php?module=Page&act=Delete&PageID='.$page['PageID'];
        $Content = htmlspecialchars_decode($page['SimpleContent']);
		
		$DateUpdated = gmdate ( "d-m | H:i", intval ( $page['DateUpdated'] ) + $ms );
        echo <<<EOF
                <tr>
                    <td width="20"align="center"><!-- BEGIN PageID -->{$page['PageID']}<!-- END PageID --></td>
                    <td><!-- BEGIN Slug -->{$page['Slug']}<!-- END Slug --></td>
                    <td><!-- BEGIN Name -->{$page['Name']}<!-- END Name --></td>
                    <td><!-- BEGIN Content -->{$Content}<!-- END Content --></td>
                    <td><!-- BEGIN Status -->{$page['Status']}<!-- END Status --></td>
                    <td><!-- BEGIN DateUpdated -->{$DateUpdated}<!-- END DateUpdated --></td>
                    
                    <td width="60"align="center"><a href="$editHref"><img src="images/edit.png" /></a></td>
	                <!--<td width="60"align="center"><a onclick="return confirm('Bạn có chắc chắn muốn xóa không ?');" href="$removeHref"><img src="images/delete.png" /></a></td>                    -->
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
        $header = $fields != null ? 'Chỉnh "Page"' : 'Thêm "Page"';
                
        require_once(VIEWS_COMMON_ADMIN_PATH.'header.tpl');
        require_once(VIEWS_ADMIN_PATH.'Page.tpl');
        require_once(VIEWS_COMMON_ADMIN_PATH.'footer.tpl');
    }
}

?>

