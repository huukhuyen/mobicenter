<?php

require_once (VIEWS_COMMON_ADMIN_PATH . "Wysiwyg.tpl");
require_once (VIEWS_COMMON_ADMIN_PATH . "TabBegin.tpl");

require_once (MODELS_PATH . 'ProductCategories.php');

$objHandleCat = new ProductCategories ();
$categories = $objHandleCat->getAllProductCategories();
?>


<form method="post"
	enctype="multipart/form-data" 
    action="index.php?module=Product&act=<?php
    echo ($fields['ProductID'] != "" ? 'Update' : 'Insert');
    ?>">
<table class="adminform" style="width: 100%;">
    
        
        
    <tr>
        <td><label for="title">* Danh mục</label></td>
		<td>
		<select onchange="go_url(this)" name="CategoryID" style="width:187px;">
			<option value="0">(Chọn)</option>
				<?php
				foreach ($categories as $category) 
				{
				$selected = '';				
				
				if($category['CategoryID'] == $fields['CategoryID'])
				{
					$selected = ' selected';
				}				
				echo "<option value=\"".$category['CategoryID']."\" ".$selected.">".$category['Name']."</option>";
				}
				?>
			</option>
		</td>        
    </tr>
	
	<tr>
	<td><label for="title">Ảnh</label></td>
		<td>
	
		<input name="Image" type="file" size="40" />
		<br/>
		<?php echo ($fields['Image'] == "" ? "" : "<img src=../uploads/".$fields ['Image']." />" );?>
		
		<input name="ImageBk" type="hidden" value="<?php echo ($fields['Image'] == "" ? "" : $fields['Image']);?>" size="40" />
		</td>
	</tr>
    
    <tr>
        <td><label for="title">* Tên sản phẩm</label></td>
        <td><input class="input" type="text" name="Name" size="40"maxlength="255"value="<?php echo ($fields != null ? $fields ['Name'] : '');?>" /></td>
    </tr>
    <tr>
        <td><label for="title">Miêu tả ngắn gọn</label></td>
        <td><textarea name="ShortDescription"><?php echo ($fields != null ? $fields ['ShortDescription'] : '');?></textarea></td>
    </tr>
    <tr>
        <td><label for="title">* Miêu tả chi tiết</label></td>
        <td><textarea name="FullDescription"><?php echo ($fields != null ? $fields ['FullDescription'] : '');?></textarea></td>
    </tr>
    
    <tr>
        <td><label for="title">* Giá</label></td>
        <td><input class="input" type="text" name="Price" size="40"maxlength="255"value="<?php echo ($fields != null ? $fields ['Price'] : '');?>" /></td>
    </tr>
    <tr>
        <td><label for="title">Khuyến mãi</label></td>
        <td><input class="input" type="text" name="Promotion" size="40"maxlength="255"value="<?php echo ($fields != null ? $fields ['Promotion'] : '');?>" /></td>
    </tr>
    <tr>
        <td><label for="title">Bảo hành</label></td>
        <td><input class="input" type="text" name="Warranty" size="40"maxlength="255"value="<?php echo ($fields != null ? $fields ['Warranty'] : '');?>" /></td>
    </tr>
    <tr>
        <td><label for="title">Trạng thái</label></td>
		
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
				<option value="1"<?php echo $active; ?>>Active</option>
				<option value="0"<?php echo $inactive; ?>>Inactive</option>
			</select>
		</td>
    </tr>
    <tr>
        <td><label for="title">Thứ tự sắp xếp</label></td>
        <td><input class="input" type="text" name="Order" size="40"maxlength="255"value="<?php echo ($fields != null ? $fields ['Order'] : '');?>" /></td>
    </tr>
    <tr>
        <td><label for="title">Sản phẩm nổi bật</label></td>
        <td><input class="input" type="text" name="Featured" size="40"maxlength="255"value="<?php echo ($fields != null ? $fields ['Featured'] : '');?>" /></td>
    </tr>
    
    
    <tr>
        <td colspan="2" style="height: 10px;"></td>
    </tr>
    <tr>
        <td></td>
        <td><input class="button" type="submit"
            name="<?php
            echo ($fields['ProductID'] != "" ? 'update' : 'insert');
            ?>"
            value="<?php
            echo ($fields['ProductID'] != "" ? 'Cập nhật' : 'Thêm mới');
            ?>" />
            <?php
            if ($fields['ProductID'] != "") :
                ?>
            <input type="hidden" name="ProductID"
            value="<?php
                echo $fields ['ProductID'];
                ?>" />            
            <?php endif;
            ?>
            <?php
            ?>
        </td>
</table>
</form>
<?php
require_once (VIEWS_COMMON_ADMIN_PATH . "TabEnd.tpl");
?>

