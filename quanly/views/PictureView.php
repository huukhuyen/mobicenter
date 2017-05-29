<?php

//@ Tệp file     : PictureView.cs ver 1.0 
//@ Mobile Center

class PictureView
{
    function viewList($pages, $categories, $footer)
    {
		global $url;
        $header = 'List Picture';
        
        if(Session::checkMessageSession())
        {
            $m = Session::getMessageSession();
            
            $message = $m['message'];
            $messageType = $m['type'];
        }
        
        require_once(VIEWS_COMMON_ADMIN_PATH.'header.tpl');
        require_once(VIEWS_COMMON_ADMIN_PATH.'TabBegin.tpl');
		$PictureCategoryID = $_GET['PictureCategoryID'] ? $_GET['PictureCategoryID'] : "";
echo <<<EOF
	<script>
		function go_url(nat)
		{		
			var val = nat.options[nat.selectedIndex].value;	
			if (val != 0)
			{										
				redirect("{$url['home']}quanly/index.php?module=Picture&PictureCategoryID="+val);
			}
			else
			{
				redirect("{$url['home']}quanly/index.php?module=Picture");
			}
		}
	</script>
        <div class="clearfix">
			<div style="float:left;"><input type="button" class="button2" value="Thêm Picture" style="margin-bottom:10px;"onclick="location.href='index.php?module=Picture&act=Insert&PictureCategoryID={$PictureCategoryID}';"></div>
			<div style="float:right;">
				<select onchange="go_url(this)" name="PictureCategoryID" style="width:187px;">
						<option value="0">(Tất cả)</option>
EOF;
				
				foreach ($categories as $category) 
				{
				$selected = '';
				
				
				if($category['PictureCategoryID'] == $_GET['PictureCategoryID'])
				{
					$selected = ' selected';
				}				
				echo "<option value=\"".$category['PictureCategoryID']."\" ".$selected.">".$category['Year']." - ".$category['Name']."</option>";
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
                    <th class="title" nowrap="nowrap">Image</th>
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
        $editHref = 'index.php?module=Picture&act=Update&PictureID='.$page['PictureID'];
        $removeHref = 'index.php?module=Picture&act=Delete&PictureID='.$page['PictureID'];
		$Avatar = $page['Image'] == "" ? "../uploads/no-image.png" : "../uploads/".$page['Image'];
        $DateUpdated = gmdate ( "d-m-Y | H:i", intval ( $page['DateUpdated'] ) + $ms );
		
        echo <<<EOF
                <tr>
                    <td width="20"align="center"><!-- BEGIN PictureID -->{$page['PictureID']}<!-- END PictureID --></td>
                    
                    <td><!-- BEGIN Name -->{$page['Name']}<!-- END Name --></td>
                    <td><!-- BEGIN Image --><img style="width:128px" src="{$Avatar}" /><!-- END Image --></td>
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
        $header = $fields != null ? 'Chỉnh "Picture"' : 'Thêm "Picture"';
                
        require_once(VIEWS_COMMON_ADMIN_PATH.'header.tpl');
        require_once(VIEWS_ADMIN_PATH.'Picture.tpl');
        require_once(VIEWS_COMMON_ADMIN_PATH.'footer.tpl');
    }
}

?>

