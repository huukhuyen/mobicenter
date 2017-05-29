<?php

require_once (VIEWS_COMMON_ADMIN_PATH . "Wysiwyg.tpl");
require_once (VIEWS_COMMON_ADMIN_PATH . "TabBegin.tpl");
?>

<form method="post"
    action="index.php?module=ProductCategories&act=<?php
    echo ($fields['CategoryID'] != "" ? 'Update' : 'Insert');
    ?>">
<table class="adminform" style="width: 700px;">
    
        
	<input class="input" type="hidden" name="ParentID" size="40"maxlength="255"value="0" />
    
    <tr>
        <td><label for="title">Name</label></td>
        <td><input class="input" type="text" name="Name" size="40"maxlength="255"value="<?php echo ($fields != null ? $fields ['Name'] : '');?>" /></td>
    </tr>
    
    <tr>
        <td colspan="2" style="height: 10px;"></td>
    </tr>
    <tr>
        <td></td>
        <td><input class="button" type="submit"
            name="<?php
            echo ($fields['CategoryID'] != "" ? 'update' : 'insert');
            ?>"
            value="<?php
            echo ($fields['CategoryID'] != "" ? 'Cập nhật' : 'Thêm mới');
            ?>" />
            <?php
            if ($fields['CategoryID'] != "") :
                ?>
            <input type="hidden" name="CategoryID"
            value="<?php
                echo $fields ['CategoryID'];
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

