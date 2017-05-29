<?php

//@ Tệp file     : VideoView.cs ver 1.0 
//@ Mobile Center

class VideoView
{
    function viewList($pages, $categories, $footer)
    {
		global $url;
        $header = 'List Video';
        
        if(Session::checkMessageSession())
        {
            $m = Session::getMessageSession();
            
            $message = $m['message'];
            $messageType = $m['type'];
        }
        
        require_once(VIEWS_COMMON_ADMIN_PATH.'header.tpl');
        require_once(VIEWS_COMMON_ADMIN_PATH.'TabBegin.tpl');
		$VideoCategoryID = $_GET['VideoCategoryID'] ? $_GET['VideoCategoryID'] : "";
echo <<<EOF
	<script>
		function go_url(nat)
		{		
			var val = nat.options[nat.selectedIndex].value;	
			if (val != 0)
			{										
				redirect("{$url['home']}admincp/index.php?module=Video&VideoCategoryID="+val);
			}
			else
			{
				redirect("{$url['home']}admincp/index.php?module=Video");
			}
		}
	</script>
        <div class="clearfix">
			<div style="float:left;"><input type="button" class="button2" value="Thêm Video" style="margin-bottom:10px;"onclick="location.href='index.php?module=Video&act=Insert&VideoCategoryID={$VideoCategoryID}';"></div>
			<div style="float:right;">
				<select onchange="go_url(this)" name="VideoCategoryID" style="width:187px;">
						<option value="0">(Tất cả)</option>
EOF;
				
				foreach ($categories as $category) 
				{
				$selected = '';
				
				
				if($category['VideoCategoryID'] == $_GET['VideoCategoryID'])
				{
					$selected = ' selected';
				}				
				echo "<option value=\"".$category['VideoCategoryID']."\" ".$selected.">".$category['Year']." - ".$category['Name']."</option>";
				}
	echo <<<EOF
				</select>
			</div>
		</div>
        <table class="adminlist">
            <thead>
                <tr>
                    <th width="20">Type ID</th>
                    
                    
                    <th class="title" nowrap="nowrap">Name</th>
                    <th class="title" nowrap="nowrap">Video</th>
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
        $editHref = 'index.php?module=Video&act=Update&VideoID='.$page['VideoID'];
        $removeHref = 'index.php?module=Video&act=Delete&VideoID='.$page['VideoID'];
		$Avatar = $page['Video'] == "" ? "../uploads/no-image.png" : "http://img.youtube.com/vi/".$page['Video']."/0.jpg";
        $DateUpdated = gmdate ( "d-m-Y | H:i", intval ( $page['DateUpdated'] ) + $ms );
		
        echo <<<EOF
                <tr>
                    <td width="20"align="center"><!-- BEGIN VideoID -->{$page['VideoID']}<!-- END VideoID --></td>
                    
                    <td><!-- BEGIN Name -->{$page['Name']}<!-- END Name --></td>
                    <td><!-- BEGIN Video --><img style="width:128px" src="{$Avatar}" /><!-- END Video --></td>
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
		<br/>
		<div style="display:block;display:table; width:100%; margin-left:0px auto; margin-right:0px auto;">
		{$footer}
		</div>
EOF;
        require_once(VIEWS_COMMON_ADMIN_PATH.'TabEnd.tpl');
        require_once(VIEWS_COMMON_ADMIN_PATH.'footer.tpl');
    }
    
    function detail($message = null, $messageType = null, $fields = null)
    {        
        $header = $fields != null ? 'Chỉnh "Video"' : 'Thêm "Video"';
                
        require_once(VIEWS_COMMON_ADMIN_PATH.'header.tpl');
        require_once(VIEWS_ADMIN_PATH.'Video.tpl');
        require_once(VIEWS_COMMON_ADMIN_PATH.'footer.tpl');
    }
}

?>

