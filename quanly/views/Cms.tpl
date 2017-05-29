<?php

require_once (VIEWS_COMMON_ADMIN_PATH . "Wysiwyg.tpl");
require_once (VIEWS_COMMON_ADMIN_PATH . "TabBegin.tpl");
?>

<form method="post" id="form"
	enctype="multipart/form-data" 
    action="index.php?module=Cms&type=<?php echo $_GET['type'];?>&act=<?php
    echo ($fields['CmsID'] != "" ? 'Update' : 'Insert');
    ?>">
	<script type="text/javascript" src="js/calendarDateInput.js"></script>
<table class="adminform" style="width: 100%;">
    
    <tr>
        <td><div style="width:100px"><label for="title">Tiêu đề</label></div></td>
        <td><input style="width:500px;" class="input title" maxlength="1000" type="text" name="Title" size="40"maxlength="255"value="<?php echo ($fields != null ? $fields ['Title'] : '');?>" /></td>
    </tr>
	 <tr>
        <td><label for="title">Nằm trong mục</label></td>
        
		
		<td>
			<?php        
			
				$category = new CmsCategories();
				$cat_parent = $category->getAllCmsCategoriesByParent();	
				
				$cat = $category->getAllCmsCategoriesByGroup($cat_parent);	
				
				
				$select = '<select style="width:187px;" name="ParentID">\n';	
				$select .= "<option selected=\"selected\" value=\"0\">< Chưa phân mục ></option>\n";
				$ParentID = $fields ['ParentID'] ? $fields ['ParentID'] : $_GET['type'];
				
				$ParentID = $ParentID ? $ParentID : $_POST['ParentID'];

				
				
				for ($i=0; $i<sizeof($cat); $i++)
				{
					
					if ($ParentID == $cat[$i]['CategoryID'])
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
			?>
			<?php echo $select ?></td>
    </tr>
    
	
	<tr>
			<td><label for="title">Ngày viết bài</label></td>
			<td>Chỉnh thời gian <input type="checkbox" onclick="checkDate()" name="DateUpdated">
				<br/>
				<div id="showDate">
					<script>DateInput('_dateIn', true, 'YYYY-MM-DD')</script>
				</div>
			</td>
		</tr>
	<style>
	
	.btn-primary {
  color: #fff;
  background-color: #428bca;
  border-color: #357ebd;
}


.btn {
  display: inline-block;
  margin-bottom: 0;
  font-weight: normal;
  text-align: center;
  vertical-align: middle;
  cursor: pointer;
  background-image: none;
  border: 1px solid transparent;
  white-space: nowrap;
  padding: 6px 12px;
  font-size: 14px;
  line-height: 1.42857143;
  border-radius: 4px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

.fileUpload {
  position: relative;
  overflow: hidden;
  margin: 10px;
}


.fileUpload input.upload {
	position: absolute;
	top: 0;
	right: 0;
	margin: 0;
	padding: 0;
	font-size: 20px;
	cursor: pointer;
	opacity: 0;
	filter: alpha(opacity=0);
}
</style>


    <tr>
        <td><label for="title">Hình đại diện</label></td>
        <td>
		<br/>
		Đổi với tin có ảnh ngoài trang chủ vui lòng chọn ảnh có kích thước <b>802p x 446px</b>
		<br/>
		
			<div style="margin-top:0px; margin-left:0px;" class="fileUpload btn btn-primary">
				
				<span>&nbsp;&nbsp;Tải ảnh từ máy tính lên&nbsp;</span>

				<input name="Avatar" class="upload" type="file" size="40" />
			</div>
		<br/>
		<?php
		$Avatar = $fields['Avatar'] == "" ? "../uploads/no-image.png" : "../uploads/".$fields['Avatar'];
		?>
		<img style='max-width:200px;' src="<?php echo $Avatar;?>" />
		</td>
    </tr>
    <tr>
        <td><label for="title">Nội dung tắt</label></td>
        <td><textarea class="tuan" style="width:100%; height:100px;" name="SimpleContent"><?php echo ($fields != null ? $fields ['SimpleContent'] : '');?></textarea></td>
    </tr>
    <tr>
        <td><label for="title">Nội dung</label></td>
        <td><textarea name="Content"><?php echo ($fields != null ? $fields ['Content'] : '');?></textarea></td>
    </tr>
    <tr>
		<td colspan="2">
			<hr/>
		</td>
	</tr>
	
	<tr>
        <td width="100"><label for="title">Kiểm duyệt bài</label></td>
        <td>
			<select class="inputbox" name="Status" size="1">
				<?php
					$active = '';
					$inactive = '';
					
					if($fields != null)
					{
						if($fields['Status'] == '0')
						{
							$inactive = ' selected="selected"';	
						}
						else 
						{								
							$active = ' selected="selected"';
						}
					}
					else 
					{
						$active = ' selected="selected"';
					}
				?>
				<option value="1"<?php echo $active; ?>>Xuất bản</option>
				<option value="0"<?php echo $inactive; ?>>Chờ duyệt</option>
			</select>			
		</td>
    </tr>
	
	<tr>
        <td width="100"><label for="title">Loại tin</label></td>
        <td>
			<select class="inputbox" name="Star" size="1">
				<?php
					$active = '';
					$inactive = '';
					
					if($fields != null)
					{
						if($fields['Star'] == '1')
						{
							$inactive = ' selected="selected"';	
						}
						else 
						{								
							$active = ' selected="selected"';
						}
					}
					else 
					{
						$active = ' selected="selected"';
					}
				?>
				<option value="1"<?php echo $active; ?>>Tin có ảnh đại diện ngoài trang chủ</option>
				<option value="0"<?php echo $inactive; ?>>Tin thường</option>
			</select>			
		</td>
    </tr>
	
	<tr style="display:none">
        <td width="100"><label for="title">Tin sự kiện</label></td>
        <td>
			<select class="inputbox" name="Event" size="1">
				<?php
					$active = '';
					$inactive = '';
					
					if($fields != null)
					{
						if($fields['Event'] == '0')
						{
							$inactive = ' selected="selected"';	
						}
						else 
						{								
							$active = ' selected="selected"';
						}
					}
					else 
					{
						$active = ' selected="selected"';
					}
				?>				
				<option value="0"<?php echo $inactive; ?>>Không phải sự kiện</option>
				<option value="1"<?php echo $active; ?>>Hiển thị là sự kiện</option>
			</select>			
		</td>
    </tr>
	
	
    <tr>
        <td><label for="title">Lượt xem</label></td>
        <td><input class="input" type="text" name="ViewedCount" size="40"maxlength="255"value="<?php echo ($fields != null ? $fields ['ViewedCount'] : '');?>" /></td>
    </tr>
    
	<tr>
	<td>
		<td><div style="cursor:pointer;" onclick="javascript:$('#divSEO').show();">Tùy chỉnh nâng cao [-]</div></td>
		<td></td>
		
	</td>
	</tr>
	<tr>
	
	<td></td>
	<td><hr/>
	<div id="divSEO" style="display:none">
		
		<script>
		
		function checkDate()
		{
			if ($("#showDate").css("display") == "block")
			{
				$("#showDate").css("display", "none");
			}
			else
			{
				$("#showDate").css("display", "block");
			}
		}
		</script>
		<style>
		#_dateIn_Year_ID	{width:100px}
		#showDate		{display:none}
		</style>
		
		<table>
		
		<tr>
			<td><label for="title">MetaTitle</label></td>
			<td><input style="width:500px;" class="input" type="text" name="MetaTitle" size="40"maxlength="255"value="<?php echo ($fields != null ? $fields ['MetaTitle'] : '');?>" /></td>
		</tr>
		<tr>
			<td><label for="title">MetaDescription</label></td>
			<td><input style="width:500px;" class="input" type="text" name="MetaDescription" size="40"maxlength="255"value="<?php echo ($fields != null ? $fields ['MetaDescription'] : '');?>" /></td>
		</tr>
		<tr>
			<td><label for="title">MetaKeyword</label></td>
			<td><input style="width:500px;" class="input" type="text" name="MetaKeyword" size="40"maxlength="255"value="<?php echo ($fields != null ? $fields ['MetaKeyword'] : '');?>" /></td>
		</tr>
		</table>
	</div>
	</td>
	</tr>
        
    <tr>
        <td colspan="2" style="height: 10px;"></td>
    </tr>
    <tr>
        <td></td>
        <td><input class="button" type="submit"
            name="<?php
            echo ($fields['CmsID'] == "" ? 'insert' : 'update');
            ?>"
            value="<?php
            echo ($fields['CmsID'] != "" ? 'Cập nhật' : 'Thêm mới');
            ?>" />
            <?php
            if ($fields['CmsID'] != "") :
                ?>
				
            <input type="hidden" name="CmsID"
            value="<?php
                echo $fields ['CmsID'];
                ?>" />            
				<?php echo $fields['cSlug'] ? "<input type=\"hidden\" name=\"type\" value=\"{$fields['cSlug']}\" />" : ""; ?>
				<input type="hidden" name="CategoryID"
            value="<?php
                echo $fields ['CategoryID'];
                ?>" />            
            <?php endif;
            ?>
            <?php
            ?>
			
			
        </td>
	</tr>
</table>
</form>
<?php
require_once (VIEWS_COMMON_ADMIN_PATH . "TabEnd.tpl");
?>
