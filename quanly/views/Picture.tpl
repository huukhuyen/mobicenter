<?php

require_once (VIEWS_COMMON_ADMIN_PATH . "Wysiwyg.tpl");
require_once (VIEWS_COMMON_ADMIN_PATH . "TabBegin.tpl");

require_once (MODELS_PATH . 'PictureCategories.php');

$objHandleCat = new PictureCategories ();
$categories = $objHandleCat->getAllPictureCategories();

$fields['PictureCategoryID'] = $fields['PictureCategoryID'] ? $fields['PictureCategoryID'] : $_GET['PictureCategoryID'];
?>


<form method="post"
	enctype="multipart/form-data" 
    action="index.php?module=Picture&act=<?php
    echo ($fields['PictureID'] != null ? 'Update' : 'Insert');
    ?>">
<table class="adminform" style="width: 100%;">
    
        
        
    <tr>
        <td><label for="title">Danh mục ảnh</label></td>
        <td>
		<select onchange="go_url(this)" name="PictureCategoryID" style="width:187px;">
			<option value="0">(Chọn)</option>
				<?php
				foreach ($categories as $category) 
				{
				$selected = '';				
				
				if($category['PictureCategoryID'] == $fields['PictureCategoryID'])
				{
					$selected = ' selected';
				}				
				echo "<option value=\"".$category['PictureCategoryID']."\" ".$selected.">".$category['Year']." - ".$category['Name']."</option>";
				}
				?>
			</option>
		</td>
    </tr>
    
    <tr>
        <td><label for="title">Tên ảnh</label></td>
        <td><input class="input" type="text" name="Name" size="40"maxlength="255"value="<?php echo ($fields != null ? $fields ['Name'] : '');?>" /></td>
    </tr>
	<td><label for="title">Ảnh</label></td>
    <td>
	
		<input name="Image" type="file" size="40" />
		<input name="Image2" type="hidden" value="<?php echo $fields['Image'] == "" ? "" : $fields ['Image'];?>" />
		<br/>
		<?php echo ($fields['Image'] == "" ? "" : "<img src=../uploads/".$fields ['Image']." />" );?>
		</td>
    
    
    <tr>
        <td colspan="2" style="height: 10px;"></td>
    </tr>
    <tr>
        <td></td>
        <td><input class="button" type="submit"
            name="<?php
            echo ($fields['PictureID'] == "" ? 'insert' : 'update');
            ?>"
            value="<?php
            echo ($fields['PictureID'] != null ? 'Cập nhật' : 'Thêm mới');
            ?>" />
            <?php
            if ($fields['PictureID'] != null) :
                ?>
            <input type="hidden" name="PictureID"
            value="<?php
                echo $fields ['PictureID'];
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