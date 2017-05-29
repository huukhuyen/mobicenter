<?php

//@ Tệp file     : OptionView.cs ver 1.0 
//@ Mobile Center

class OptionView
{
    function viewList($pages)
    {
        $header = 'List Option';
        
        if(Session::checkMessageSession())
        {
            $m = Session::getMessageSession();
            
            $message = $m['message'];
            $messageType = $m['type'];
        }
        
        require_once(VIEWS_COMMON_ADMIN_PATH.'header.tpl');
        require_once(VIEWS_COMMON_ADMIN_PATH.'TabBegin.tpl');
echo <<<EOF
        <div><input type="button" class="button2" value="Thêm Option" style="margin-bottom:10px;"onclick="location.href='index.php?module=Option&act=Insert';"></div>
        <table class="adminlist">
            <thead>
                <tr>
                    <th width="20">Type ID</th>
                    <th class="title" nowrap="nowrap">Name</th>
                    <th class="title" nowrap="nowrap">Value1</th>
                    <th class="title" nowrap="nowrap">Value2</th>
                    <th class="title" nowrap="nowrap">Value3</th>
                    <th class="title" nowrap="nowrap">Value4</th>
                    <th class="title" nowrap="nowrap">Value5</th>
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
        $editHref = 'index.php?module=Option&act=Update&OptionID='.$page['OptionID'];
        $removeHref = 'index.php?module=Option&act=Delete&OptionID='.$page['OptionID'];
        $DateUpdated = gmdate ( "d-m | H:i", intval ( $page['DateUpdated'] ) + $ms );
        echo <<<EOF
                <tr>
                    <td width="20"align="center"><!-- BEGIN OptionID -->{$page['OptionID']}<!-- END OptionID --></td>
                    <td><!-- BEGIN Name -->{$page['Name']}<!-- END Name --></td>
                    <td><!-- BEGIN Value1 -->{$page['Value1']}<!-- END Value1 --></td>
                    <td><!-- BEGIN Value2 -->{$page['Value2']}<!-- END Value2 --></td>
                    <td><!-- BEGIN Value3 -->{$page['Value3']}<!-- END Value3 --></td>
                    <td><!-- BEGIN Value4 -->{$page['Value4']}<!-- END Value4 --></td>
                    <td><!-- BEGIN Value5 -->{$page['Value5']}<!-- END Value5 --></td>
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
        $header = $fields != null ? 'Chỉnh "Option"' : 'Thêm "Option"';
                
        require_once(VIEWS_COMMON_ADMIN_PATH.'header.tpl');
        require_once(VIEWS_ADMIN_PATH.'Option.tpl');
        require_once(VIEWS_COMMON_ADMIN_PATH.'footer.tpl');
    }
}

?>

