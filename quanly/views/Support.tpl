<?php

require_once (VIEWS_COMMON_ADMIN_PATH . "Wysiwyg.tpl");
require_once (VIEWS_COMMON_ADMIN_PATH . "TabBegin.tpl");
?>

<form method="post"
    action="index.php?module=Support&act=<?php
    echo ($fields != null ? 'Update' : 'Insert');
    ?>">
<table class="adminform" style="width: 700px;">
    
        
        
    <tr>
        <td><label for="title">YM</label></td>
        <td><input class="input" type="text" name="YM" size="40"maxlength="255"value="<?php echo ($fields != null ? $fields ['YM'] : '');?>" /></td>
    </tr>
    <tr>
        <td><label for="title">Skype</label></td>
        <td><input class="input" type="text" name="Skype" size="40"maxlength="255"value="<?php echo ($fields != null ? $fields ['Skype'] : '');?>" /></td>
    </tr>
    <tr>
        <td><label for="title">Họ tên</label></td>
        <td><input class="input" type="text" name="FullName" size="40"maxlength="255"value="<?php echo ($fields != null ? $fields ['FullName'] : '');?>" /></td>
    </tr>
    <tr>
        <td><label for="title">Chức danh</label></td>
        <td><input class="input" type="text" name="Phone" size="40"maxlength="255"value="<?php echo ($fields != null ? $fields ['Phone'] : '');?>" /></td>
    </tr>
    <tr>
        <td><label for="title">Nội dung message Yahoo</label></td>
        <td><input class="input" type="text" name="Message" size="40"maxlength="255"value="<?php echo ($fields != null ? $fields ['Message'] : '');?>" /></td>
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
            <input type="hidden" name="SupportID"
            value="<?php
                echo $fields ['SupportID'];
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

