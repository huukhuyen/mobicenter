<?php

class LinksView
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
        require_once(MODELS_PATH.'Workshop.php');
echo <<<EOF

	<script>
	function go_url(nat)
	{		
		var val = nat.options[nat.selectedIndex].value;	
		if (val != 0)
		{										
			redirect("{$url['home']}index.php?module=Links&type="+val);
		}
		else
		{
			redirect("{$url['home']}index.php?module=Links");
		}
	}		
    </script>
        <div class="clearfix">
			<div style="float:left;">
                <div><input type="button" class="button2" value="Thêm địa chỉ" style="margin-bottom:10px;"onclick="location.href='index.php?module=Links&act=Insert';"></div>
            </div>
        
        <div style="float:right;">				
			
EOF;
			
			
				$category = new Workshop();
				$cat = $category->getAllWorkshop();	
				
				
				$select = '<select onchange="go_url(this)" style="float:right; width:377px;" name="WorkshopID">\n';	
				$select .= "<option selected=\"selected\" value=\"0\">< Tất cả danh mục ></option>\n";
				$WorkshopID = $fields ['WorkshopID'] ? $fields ['WorkshopID'] : $_GET['type'];

				
				
				for ($i=0; $i<sizeof($cat); $i++)
				{
					
					if ($WorkshopID == $cat[$i]['WorkshopID'])
					{
						$select .= "<option selected=\"selected\" value=\"".$cat[$i]['WorkshopID']."\" >";
						
						$select .= "Hội thảo ".$cat[$i]['Title']."</option>\n";
					}
					else 
					{
						$select .= "<option value=\"".$cat[$i]['WorkshopID']."\" >";
						
						$select .= "Hội thảo ".$cat[$i]['Title']."</option>\n";
					}		
				}
				$select .= '</select>';
			
			echo $select;
echo<<<EOF
</div></div>

        <table class="adminlist">
            <thead>
                <tr>
                    <th width="20">Type ID</th>
                    <th class="title" nowrap="nowrap">Tên địa chỉ</th>
                    <th class="title" nowrap="nowrap">Url</th>
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
        $editHref = 'index.php?module=Links&act=Update&LinkID='.$page['LinkID'];
        $removeHref = 'index.php?module=Links&act=Delete&LinkID='.$page['LinkID'];
        $Avatar = $page['Avatar'] == "" ? "../uploads/no-image.png" : "../uploads/".$page['Avatar'];
		
		$DateUpdated = gmdate ( "d-m | H:i", intval ( $page['DateUpdated'] ) + $ms );
        echo <<<EOF
                <tr>
                    <td width="20"align="center"><!-- BEGIN LinkID -->{$page['LinkID']}<!-- END LinkID --></td>
                    <td><!-- BEGIN LinkName -->{$page['LinkName']}<!-- END LinkName --></td>
                    <td><!-- BEGIN LinkUrl -->{$page['LinkUrl']}<!-- END LinkUrl --></td>
					<td><!-- BEGIN LinkUrl --><img style="width:256px;" src="{$Avatar}" /><!-- END LinkUrl --></td>
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
        $header = $fields != null ? 'Chỉnh "Links"' : 'Thêm "Links"';
                
        require_once(VIEWS_COMMON_ADMIN_PATH.'header.tpl');
        require_once(VIEWS_ADMIN_PATH.'Links.tpl');
        require_once(VIEWS_COMMON_ADMIN_PATH.'footer.tpl');
    }
}

?>

