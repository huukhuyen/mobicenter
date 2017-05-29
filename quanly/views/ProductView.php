<?php

//@ Tệp file     : ProductView.cs ver 1.0 

class ProductView
{
    function viewList($pages, $categories, $footer = null)
    {
		global $url;
        $header = 'DS Sản phẩm';
        
        if(Session::checkMessageSession())
        {
            $m = Session::getMessageSession();
            
            $message = $m['message'];
            $messageType = $m['type'];
        }
        
        require_once(VIEWS_COMMON_ADMIN_PATH.'header.tpl');
        require_once(VIEWS_COMMON_ADMIN_PATH.'TabBegin.tpl');
echo <<<EOF
		<script>
		function go_url(nat)
		{		
			var val = nat.options[nat.selectedIndex].value;	
			if (val != 0)
			{										
				redirect("{$url['home']}quanly/index.php?module=Product&CategoryID="+val);
			}
			else
			{
				redirect("{$url['home']}quanly/index.php?module=Product");
			}
		}
	</script>
        <div class="clearfix">
			<div style="float:left;">
				<input type="button" class="button2" value="Thêm Sản phẩm" style="margin-bottom:10px;"onclick="location.href='index.php?module=Product&act=Insert';">
			</div>
			<div style="float:right;">
				<select onchange="go_url(this)" name="CategoryID" style="width:187px;">
						<option value="0">(Tất cả)</option>
EOF;
				
				foreach ($categories as $category) 
				{
				$selected = '';
				
				
				if($category['CategoryID'] == $_GET['CategoryID'])
				{
					$selected = ' selected';
				}				
				echo "<option value=\"".$category['CategoryID']."\" ".$selected.">".$category['Name']."</option>";
				}
	echo <<<EOF
				</select>
			</div>
		</div>
        <table class="adminlist">
            <thead>
                <tr>
                    <th width="20">ID</th>
                    <th class="title" nowrap="nowrap">Danh mục</th>
                    
                    <th class="title" nowrap="nowrap">Tên sản phẩm</th>
                    <th class="title" nowrap="nowrap">Mô tả ngắn</th>
                    
                    <th class="title" nowrap="nowrap">Hình đại diện</th>
                    <th class="title" nowrap="nowrap">Giá</th>
                    
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
        $editHref = 'index.php?module=Product&act=Update&ProductID='.$page['ProductID'];
        $removeHref = 'index.php?module=Product&act=Delete&ProductID='.$page['ProductID'];
        $Avatar = $page['Image'] == "" ? "../uploads/no-image.png" : "../uploads/".$page['Image'];
        $DateUpdated = gmdate ( "d-m | H:i", intval ( $page['DateUpdated'] ) + $ms );
		$Status = $page['Status'] == "1" ? "Hiển thị" : "Không hiện thị";
		
        echo <<<EOF
                <tr>
                    <td width="20"align="center"><!-- BEGIN ProductID -->{$page['ProductID']}<!-- END ProductID --></td>
                    <td><!-- BEGIN CategoryID -->{$page['CategoryID']}<!-- END CategoryID --></td>
                    
                    <td><!-- BEGIN Name -->{$page['Name']}<!-- END Name --></td>
                    <td><!-- BEGIN ShortDescription -->{$page['ShortDescription']}<!-- END ShortDescription --></td>
                    
                    <td><!-- BEGIN Image --><img style="width:64px" src="{$Avatar}" /><!-- END Image --></td>
                    <td><!-- BEGIN Price -->{$page['Price']}<!-- END Price --></td>                    
					<td><!-- BEGIN DateUpdated -->{$Status}<!-- END DateUpdated --></td>
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
        <div style="margin-left:300px; padding-bottom: 20px;">{$footer}</div>
EOF;
        require_once(VIEWS_COMMON_ADMIN_PATH.'TabEnd.tpl');
        require_once(VIEWS_COMMON_ADMIN_PATH.'footer.tpl');
    }
    
    function detail($message = null, $messageType = null, $fields = null)
    {        
        $header = $fields != null ? 'Chỉnh "Sản phẩm"' : 'Thêm "Sản phẩm"';
                
        require_once(VIEWS_COMMON_ADMIN_PATH.'header.tpl');
        require_once(VIEWS_ADMIN_PATH.'Product.tpl');
        require_once(VIEWS_COMMON_ADMIN_PATH.'footer.tpl');
    }
}

?>

