<?php

require_once (VIEWS_COMMON_ADMIN_PATH . "Wysiwyg.tpl");
require_once (VIEWS_COMMON_ADMIN_PATH . "TabBegin.tpl");
?>
    <form method="post" enctype="multipart/form-data" action="index.php?module=Page&act=<?php
    echo ($fields != null ? 'Update' : 'Insert');
    ?>">
        <table class="adminform" style="width: 700px;">
            <tr>
                <td>
                    <label for="title">Tên trang</label>
                </td>
                <td>
                    <input class="input" type="text" name="Name" size="40" maxlength="255" value="<?php echo ($fields != null ? $fields ['Name'] : '');?>" />
                </td>
            </tr>
            <tr>
                <td>
                    <label for="title">Nội dung</label>
                </td>
                <td>
                    <textarea name="Content">
                        <?php echo ($fields != null ? $fields ['Content'] : '');?>
                    </textarea>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="title">Trạng thái</label>
                </td>
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
                            <option value="1" <?php echo $active; ?>>Active</option>
                            <option value="0" <?php echo $inactive; ?>>Inactive</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="height: 10px;"></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input class="button" type="submit" name="<?php
            echo ($fields == " " ? 'insert' : 'update');
            ?>" value="<?php
            echo ($fields != null ? 'Cập nhật' : 'Thêm mới');
            ?>" />
                    <?php
            if ($fields != null) :
                ?>
                        <input type="hidden" name="PageID" value="<?php
                echo $fields ['PageID'];
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
