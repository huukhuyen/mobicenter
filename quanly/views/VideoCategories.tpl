<?php

require_once (VIEWS_COMMON_ADMIN_PATH . "Wysiwyg.tpl");
require_once (VIEWS_COMMON_ADMIN_PATH . "TabBegin.tpl");
?>

<form method="post"
    action="index.php?module=VideoCategories&act=<?php
    echo ($fields != null ? 'Update' : 'Insert');
    ?>">
<table class="adminform" style="width: 700px;">
    
        
        
    <tr>
        <td><label for="title">Tên danh mục ảnh</label></td>
        <td><input class="input" type="text" name="Name" size="40"maxlength="255"value="<?php echo ($fields != null ? $fields ['Name'] : '');?>" /></td>
    </tr>
	
	<tr>
        <td><label for="title">Năm lưu trữ</label></td>
        <td><input class="input" type="text" name="Year" size="40"maxlength="255"value="<?php echo ($fields != null ? $fields ['Year'] : '');?>" /></td>
    </tr>
	
	
        
    
	
	<tr>
        <td><label for="title">Link SEO</label></td>
        <td><input type="hidden" name="Status" size="40"maxlength="255"value="<?php echo ($fields != null ? $fields ['Status'] : '1');?>" />
		<input class="input" type="text" name="Slug" size="40"maxlength="255"value="<?php echo ($fields != null ? $fields ['Slug'] : '');?>" /> <i>Để trống nếu muốn hệ thống tự động tạo</i></td>
    </tr>
    
    <tr>
        <td colspan="2" style="height: 10px;"></td>
    </tr>
    <tr>
        <td></td>
        <td><input class="button" type="submit"
            name="<?php
            echo ($fields == "" ? 'insert' : 'update');
            ?>"
            value="<?php
            echo ($fields != null ? 'Cập nhật' : 'Thêm mới');
            ?>" />
            <?php
            if ($fields != null) :
                ?>
            <input type="hidden" name="VideoCategoryID"
            value="<?php
                echo $fields ['VideoCategoryID'];
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

