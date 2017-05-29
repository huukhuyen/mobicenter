<?php

require_once (VIEWS_COMMON_ADMIN_PATH . "Wysiwyg.tpl");
require_once (VIEWS_COMMON_ADMIN_PATH . "TabBegin.tpl");
?>

<form method="post"
	enctype="multipart/form-data" 
    action="index.php?module=Partner&act=<?php
    echo ($fields != null ? 'Update' : 'Insert');
    ?>">
<table class="adminform" style="width: 700px;">
    
        
        
    <tr>
        <td><label for="title">Tên</label></td>
        <td><input class="input" type="text" name="LinkName" size="40"maxlength="255"value="<?php echo ($fields != null ? $fields ['LinkName'] : '');?>" /></td>
    </tr>
    <tr>
        <td><label for="title">Địa chỉ Website Partner</label></td>
        <td><input class="input" type="text" name="LinkUrl" size="40"maxlength="255"value="<?php echo ($fields != null ? $fields ['LinkUrl'] : '');?>" /></td>
    </tr>
	 <tr>
        <td><label for="title">Hình đại diện</label></td>
        <td>
		<input name="Avatar" type="file" size="40" />
		<input name="AvatarDB" value="<?php echo ($fields != null ? $fields['Avatar'] : '');?>" type="hidden" />
		<br/>
		<?php echo ($fields['Avatar'] == "" ? "" : "<img src=../uploads/".$fields ['Avatar']." />" );?>
		</td>
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
            <input type="hidden" name="LinkID"
            value="<?php
                echo $fields ['LinkID'];
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

