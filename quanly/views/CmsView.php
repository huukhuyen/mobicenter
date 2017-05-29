<?php

//@ Tệp file     : CmsView.cs ver 1.0 
//@ Mobile Center

class CmsView
{
    function viewList($pages, $categories, $footer)
    {
		global $url;
        $header = 'Danh sách';
		$type=getInput("type");
		$keyword=getInput("keyword");
		
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
				redirect("{$url['home']}quanly/index.php?module=Cms&type="+val);
			}
			else
			{
				redirect("{$url['home']}quanly/index.php?module=Cms");
			}
		}
		
		function search()
		{		
			keyword = $("#keyword").val();
			
			url = location.href;
			if (keyword != '')
			{										
				
				
				if (url.indexOf("&keyword") != -1)
				{
					url = url.split("&keyword")[0];
					
				}			
				redirect(url+"&keyword="+keyword);
				
				
			}
			else
			{
				redirect(url+"&keyword="+keyword);
			}
		}
	</script>
        <div class="clearfix">
			<div style="float:left;">
EOF;
			
			echo <<<EOF
			<input type="button" class="button2" value="Thêm bài" style="margin-bottom:10px;"onclick="location.href='index.php?module=Cms&act=Insert&type={$type}';">
				
			</div>
			<div style="float:right;">				
			
EOF;
				 
			
			
				$category = new CmsCategories();
				$cat_parent = $category->getAllCmsCategoriesByParent();	
				
				$cat = $category->getAllCmsCategoriesByGroup($cat_parent);	
				
				
				$select = '<select onchange="go_url(this)" style="float:right; width:187px;" name="CategoryID">\n';	
				$select .= "<option selected=\"selected\" value=\"0\">< Tất cả danh mục ></option>\n";
				$CategoryID = $fields ['CategoryID'] ? $fields ['CategoryID'] : $_GET['type'];

				
				
				for ($i=0; $i<sizeof($cat); $i++)
				{
					
					if ($CategoryID == $cat[$i]['CategoryID'])
					{
						$select .= "<option selected=\"selected\" value=\"".$cat[$i]['CategoryID']."\" >";
						if ($cat[$i]['ParentID'] != 0)
						{
							$select .= "|_____";
						}										
						$select .= $cat[$i]['Name']."</option>\n";
					}
					else 
					{
						$select .= "<option value=\"".$cat[$i]['CategoryID']."\" >";
						if ($cat[$i]['ParentID'] != 0)
						{
							$select .= "|_____";
						}										
						$select .= $cat[$i]['Name']."</option>\n";
					}		
				}
				$select .= '</select>';
			
			echo $select;
			
	echo <<<EOF
				<div style="margin-top:20px;">
			<input style="width:200px; margin:0px 10px;" id="keyword" value="{$keyword}" type="text" name="keyword" /><input style="margin:0px 5px;" type="button" onclick="search()" class="button" value="Tìm kiếm" />
				</div>
			</div>
		</div>
        <table class="adminlist">
            <thead>
                <tr>
                    <th width="20">#</th>
                    <th class="title" nowrap="nowrap">Tiêu đề</th>
                    <th class="title" nowrap="nowrap">Hình đại diện</th>
                    <th class="title" nowrap="nowrap">Danh mục</th>                    
                    <th class="title" nowrap="nowrap">Trạng thái</th>
                    <th class="title" nowrap="nowrap">Lượt xem</th>
					
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
		
		
        $editHref = 'index.php?module=Cms&act=Update&type='.$page["CategoryID"].'&CmsID='.$page['CmsID'].'&type='.$_GET['type'];
        $removeHref = 'index.php?module=Cms&act=Delete&CmsID='.$page['CmsID'].'&type='.$_GET['type'];
        $Avatar = $page['Avatar'] == "" ? "../uploads/no-image.png" : "../uploads/".$page['Avatar'];
		$DateUpdated = gmdate ( "d-m-Y H:i", intval ( $page['DateUpdated'] ) + $ms  );
		$Status = $page['Status'] ? "<span style='color:blue'>OK</span>" : "<span style='color:red'>Chưa xuất bản</span>";
		$Star = $page['Star'] ? "<span style='color:#008000'>Tin đại diện</span>" : "<span style=''>Tin thường</span>";
		$Event = $page['Event'] ? " | <span style='color:#red'>Tin sự kiện</span>" : "";
		
		$Content = htmlspecialchars_decode($page['cCategoryName']);

		if ($_SESSION ['groupID'] == '2')
		{
			 $display = "cit";
		}
		else
		{
			if ($_SESSION['memberID'] == $page['MemberID'])
			{
				$display = "cit";
			}
			else
			{
				$display = "";
			}
		}


        echo <<<EOF
                <tr>
                    <td width="20"align="center"><!-- BEGIN CmsID -->{$page['CmsID']}<!-- END CmsID --></td>                    
                    
                    <td><!-- BEGIN Title --><a style="font-size:15px;" target="_blank" href="{$url['home']}{$page['slug']}/{$page['cSlug']}/{$page['Slug']}.html">{$page['Title']}<!-- END Title --></a></td>
                    <td><!-- BEGIN Avatar --><img src="{$Avatar}" style="width:64px;" /><!-- END Avatar --></td>
                    <td><!-- BEGIN SimpleContent --><div style="max-width:500px; overflow:auto;">{$Content}</div><!-- END SimpleContent --></td>                    
                    <td><!-- BEGIN Status -->{$Status}<!-- END Status --></td>
                    <td><!-- BEGIN ViewedCount -->{$page['ViewedCount']}<!-- END ViewedCount --></td>
					
                    <td><!-- BEGIN DateUpdated -->{$DateUpdated}<!-- END DateUpdated --></td>
                    
					<td width="60"align="center">

EOF;
					
	if ($display == "cit") 
	{
		
		echo '<a href="'.$editHref.'"><img src="images/edit.png" /></a>';
	}
					
        echo <<<EOF

					</td>
	                <td width="60"align="center">

EOF;
					
	if ($display == "cit") echo '<a onclick="return confirm(\'Bạn có chắc chắn muốn xóa không ?\');" href="'.$removeHref.'"><img src="images/delete.png" /></a>';

        echo <<<EOF


					</td>                    
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
		
		
		<script>

/*		
	$(function() {

		setTimeout(function() {
			href = $(".button2:first-child").attr('onclick');
			
			href = href.replace('location.href=', '');
			href = href.replace("';", "");
			href = href.replace("'", "");
			
			
			window.location.href = href;
		}, 1);
	});
  */
</script>
EOF;
        require_once(VIEWS_COMMON_ADMIN_PATH.'TabEnd.tpl');
        require_once(VIEWS_COMMON_ADMIN_PATH.'footer.tpl');
    }
    
    function detail($message = null, $messageType = null, $fields = null)
    {        
        $header = $fields != null ? 'Chỉnh "Tin"' : 'Thêm "Tin"';
                
        require_once(VIEWS_COMMON_ADMIN_PATH.'header.tpl');
        require_once(VIEWS_ADMIN_PATH.'Cms.tpl');
        require_once(VIEWS_COMMON_ADMIN_PATH.'footer.tpl');
    }
}

?>

