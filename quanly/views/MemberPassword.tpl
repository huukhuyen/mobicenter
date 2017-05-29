<?php

require_once (VIEWS_COMMON_ADMIN_PATH . "Wysiwyg.tpl");
require_once (VIEWS_COMMON_ADMIN_PATH . "TabBegin.tpl");
?>


<form method="post"
    action="">
<table class="adminform" style="width: 700px;">
    
        
    <tr>
        <td><label for="title">Mật khẩu cũ</label></td>
        <td><input class="input" type="password" name="OldPassword" size="255"maxlength="255"value="" /></td>
    </tr>
	
    <tr>
        <td><label for="title">Mật khẩu mới</label></td>
        <td><input class="input" type="password" name="NewPassword" size="255"maxlength="255"value="" /></td>
    </tr>
    <tr>
        <td><label for="title">Nhập lại mật khẩu mới</label></td>
        <td><input class="input" type="password" name="ConfirmPassword" size="255"maxlength="255"value="" /></td>
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
            <input type="hidden" name="MemberID"
            value="<?php
                echo $fields ['MemberID'];
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

