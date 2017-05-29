<?php

require_once (VIEWS_COMMON_ADMIN_PATH . "Wysiwyg.tpl");
require_once (VIEWS_COMMON_ADMIN_PATH . "TabBegin.tpl");
?>

<form method="post"
    action="index.php?module=MemberGroup&act=<?php
    echo ($fields != null ? 'Update' : 'Insert');
    ?>">
<table class="adminform" style="width: 700px;">
    
        
        
    <tr>
        <td><label for="title">GroupName</label></td>
        <td><input class="input" type="text" name="GroupName" size="40"maxlength="255"value="<?php echo ($fields != null ? $fields ['GroupName'] : '');?>" /></td>
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
            <input type="hidden" name="GroupID"
            value="<?php
                echo $fields ['GroupID'];
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

