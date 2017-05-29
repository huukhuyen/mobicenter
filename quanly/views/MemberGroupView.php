<?php

//@ Tệp file     : MemberGroupView.cs ver 1.0 
//@ Mobile Center

class MemberGroupView
{
    function viewList($pages)
    {
        $header = 'List Member group';
        
        if(Session::checkMessageSession())
        {
            $m = Session::getMessageSession();
            
            $message = $m['message'];
            $messageType = $m['type'];
        }
        
        require_once(VIEWS_COMMON_ADMIN_PATH.'header.tpl');
        require_once(VIEWS_COMMON_ADMIN_PATH.'TabBegin.tpl');
echo <<<EOF
        <div><input type="button" class="button2" value="Thêm Member group" style="margin-bottom:10px;"onclick="location.href='index.php?module=MemberGroup&act=Insert';"></div>
        <table class="adminlist">
            <thead>
                <tr>
                    <th width="20">Type ID</th>
                    <th class="title" nowrap="nowrap">GroupName</th>
                        
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
        $editHref = 'index.php?module=MemberGroup&act=Update&GroupID='.$page['GroupID'];
        $removeHref = 'index.php?module=MemberGroup&act=Delete&GroupID='.$page['GroupID'];
        
        echo <<<EOF
                <tr>
                    <td width="20"align="center"><!-- BEGIN GroupID -->{$page['GroupID']}<!-- END GroupID --></td>
                    <td><!-- BEGIN GroupName -->{$page['GroupName']}<!-- END GroupName --></td>
                    
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
        $header = $fields != null ? 'Chỉnh "Member group"' : 'Thêm "Member group"';
                
        require_once(VIEWS_COMMON_ADMIN_PATH.'header.tpl');
        require_once(VIEWS_ADMIN_PATH.'MemberGroup.tpl');
        require_once(VIEWS_COMMON_ADMIN_PATH.'footer.tpl');
    }
}

?>