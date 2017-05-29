<?php

require_once (VIEWS_COMMON_ADMIN_PATH . "Wysiwyg.tpl");
require_once (VIEWS_COMMON_ADMIN_PATH . "TabBegin.tpl");
?>

<form method="post"
    action="index.php?module=Member&act=<?php
    echo ($fields != null ? 'Update' : 'Insert');
    ?>">
<table class="adminform" style="width: 700px;">
    
        
    <input class="input" type="hidden" name="GroupID" size="40"maxlength="255"value="2" />
    <tr>
        <td><label for="title">Username</label></td>
        <td><input class="input" type="text" name="Username" size="255"maxlength="255"value="<?php echo ($fields != null ? $fields ['Username'] : '');?>" /></td>
    </tr>
    <tr>
        <td><label for="title">Tên thật</label></td>
        <td><input class="input" type="text" name="RealName" size="255"maxlength="255"value="<?php echo ($fields != null ? $fields ['RealName'] : '');?>" /></td>
    </tr>
    <tr>
        <td><label for="title">Email</label></td>
        <td><input class="input" type="text" name="Email" size="255"maxlength="255"value="<?php echo ($fields != null ? $fields ['Email'] : '');?>" /></td>
    </tr>
    <tr>
        <td><label for="title">Mật khẩu</label></td>
        <td><input class="input" type="text" name="Password" size="255"maxlength="255"value="" /> (nhập vào đây nếu muốn đổi lại mật khẩu)</td>
    </tr>
    <tr>
        <td><label for="title">Yahoo</label></td>
        <td><input class="input" type="text" name="IM" size="255"maxlength="255"value="<?php echo ($fields != null ? $fields ['IM'] : '');?>" /></td>
    </tr>
    <tr>
        <td><label for="title">Điện thoại</label></td>
        <td><input class="input" type="text" name="Phone" size="255"maxlength="255"value="<?php echo ($fields != null ? $fields ['Phone'] : '');?>" /></td>
    </tr>
    <tr>
        <td><label for="title">Ghi chú cá nhân</label></td>
        <td>
			<textarea name="Description"><?php echo ($fields != null ? $fields ['Description'] : '');?></textarea></td>
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

