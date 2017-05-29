<?php

//@ Tệp file     : SupportView.cs ver 1.0 
//@ Mobile Center

class SupportView
{
    function viewList($pages)
    {
        $header = 'List Support';
        
        if(Session::checkMessageSession())
        {
            $m = Session::getMessageSession();
            
            $message = $m['message'];
            $messageType = $m['type'];
        }
        
        require_once(VIEWS_COMMON_ADMIN_PATH.'header.tpl');
        require_once(VIEWS_COMMON_ADMIN_PATH.'TabBegin.tpl');
echo <<<EOF
        <!--<div><input type="button" class="button2" value="Thêm Support" style="margin-bottom:10px;"onclick="location.href='index.php?module=Support&act=Insert';"></div>-->
        <table class="adminlist">
            <thead>
                <tr>
                    <th width="20">Type ID</th>
                    <th class="title" nowrap="nowrap">YM</th>
                    <th class="title" nowrap="nowrap">Skype</th>
                    <th class="title" nowrap="nowrap">FullName</th>
                    <th class="title" nowrap="nowrap">Phone</th>
                    <th class="title" nowrap="nowrap">Message</th>
                    <th class="title" nowrap="nowrap">DateUpdated</th>
                        
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
        $editHref = 'index.php?module=Support&act=Update&SupportID='.$page['SupportID'];
        $removeHref = 'index.php?module=Support&act=Delete&SupportID='.$page['SupportID'];
        $DateUpdated = gmdate ( "d-m | H:i", intval ( $page['DateUpdated'] ) + $ms );
        echo <<<EOF
                <tr>
                    <td width="20"align="center"><!-- BEGIN SupportID -->{$page['SupportID']}<!-- END SupportID --></td>
                    <td><!-- BEGIN YM -->{$page['YM']}<!-- END YM --></td>
                    <td><!-- BEGIN Skype -->{$page['Skype']}<!-- END Skype --></td>
                    <td><!-- BEGIN FullName -->{$page['FullName']}<!-- END FullName --></td>
                    <td><!-- BEGIN Phone -->{$page['Phone']}<!-- END Phone --></td>
                    <td><!-- BEGIN Message -->{$page['Message']}<!-- END Message --></td>
                    <td><!-- BEGIN DateUpdated -->{$DateUpdated}<!-- END DateUpdated --></td>
                    
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
        $header = $fields != null ? 'Chỉnh "Support"' : 'Thêm "Support"';
                
        require_once(VIEWS_COMMON_ADMIN_PATH.'header.tpl');
        require_once(VIEWS_ADMIN_PATH.'Support.tpl');
        require_once(VIEWS_COMMON_ADMIN_PATH.'footer.tpl');
    }
}

?>

