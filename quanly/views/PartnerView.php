<?php

//@ Tệp file     : PartnerView.cs ver 1.0 
//@ Mobile Center

class PartnerView
{
    function viewList($pages)
    {
        $header = 'Danh sách';
        
        if(Session::checkMessageSession())
        {
            $m = Session::getMessageSession();
            
            $message = $m['message'];
            $messageType = $m['type'];
        }
        
        require_once(VIEWS_COMMON_ADMIN_PATH.'header.tpl');
        require_once(VIEWS_COMMON_ADMIN_PATH.'TabBegin.tpl');
echo <<<EOF
        <div><input type="button" class="button2" value="Thêm địa chỉ" style="margin-bottom:10px;"onclick="location.href='index.php?module=Partner&act=Insert';"></div>
        <table class="adminlist">
            <thead>
                <tr>
                    <th width="20">Type ID</th>
                    <th class="title" nowrap="nowrap">Tên đối tác</th>
                    <th class="title" nowrap="nowrap">Url Website</th>
					<th class="title" nowrap="nowrap">Hình đại diện</th>
                    <th class="title" nowrap="nowrap">Trạng thái</th>
                    <th class="title" nowrap="nowrap">Ngày cập nhật</th>
                        
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
        $editHref = 'index.php?module=Partner&act=Update&LinkID='.$page['LinkID'];
        $removeHref = 'index.php?module=Partner&act=Delete&LinkID='.$page['LinkID'];
        $Avatar = $page['Avatar'] == "" ? "../uploads/no-image.png" : "../uploads/".$page['Avatar'];
		
		$DateUpdated = gmdate ( "d-m | H:i", intval ( $page['DateUpdated'] ) + $ms );
        echo <<<EOF
                <tr>
                    <td width="20"align="center"><!-- BEGIN LinkID -->{$page['LinkID']}<!-- END PartnerID--></td>
                    <td><!-- BEGIN PartnerName -->{$page['LinkName']}<!-- END PartnerName --></td>
                    <td><!-- BEGIN PartnerUrl -->{$page['LinkUrl']}<!-- END PartnerUrl --></td>
					<td><!-- BEGIN PartnerUrl --><img style="width:256px;" src="{$Avatar}" /><!-- END PartnerUrl --></td>
                    <td><!-- BEGIN Status -->{$page['Status']}<!-- END Status --></td>
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
        $header = $fields != null ? 'Chỉnh "Partner"' : 'Thêm "Partner"';
                
        require_once(VIEWS_COMMON_ADMIN_PATH.'header.tpl');
        require_once(VIEWS_ADMIN_PATH.'Partner.tpl');
        require_once(VIEWS_COMMON_ADMIN_PATH.'footer.tpl');
    }
}

?>

