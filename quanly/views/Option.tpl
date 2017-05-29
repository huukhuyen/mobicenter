<?php

require_once (VIEWS_COMMON_ADMIN_PATH . "Wysiwyg.tpl");
require_once (VIEWS_COMMON_ADMIN_PATH . "TabBegin.tpl");
?>

<form method="post"
    action="index.php?module=Option&act=<?php
    echo ($fields != null ? 'Update' : 'Insert');
    ?>">
<table class="adminform" style="width: 700px;">
    
        
        <script>
			$(document).ready(function() {
				$("#name").keypress(function(e) {					
					e.preventDefault();
				});
			});
			
		</script>
    <tr>
        <td><label for="title">Tên giá trị</label></td>
        <td><input class="input" type="text" id="name" name="Name" size="40"maxlength="255"value="<?php echo ($fields != null ? $fields ['Name'] : '');?>" /></td>
    </tr>
    <tr>
        <td><label for="title">Giá trị 1</label></td>
        <td><input class="input" type="text" name="Value1" size="40"maxlength="255"value="<?php echo ($fields != null ? $fields ['Value1'] : '');?>" /></td>
    </tr>
    <tr>
        <td><label for="title">Giá trị 2</label></td>
        <td><input class="input" type="text" name="Value2" size="40"maxlength="255"value="<?php echo ($fields != null ? $fields ['Value2'] : '');?>" /></td>
    </tr>
    <tr>
        <td><label for="title">Giá trị 3</label></td>
        <td><input class="input" type="text" name="Value3" size="40"maxlength="255"value="<?php echo ($fields != null ? $fields ['Value3'] : '');?>" /></td>
    </tr>
    <tr>
        <td><label for="title">Giá trị 4</label></td>
        <td><input class="input" type="text" name="Value4" size="40"maxlength="255"value="<?php echo ($fields != null ? $fields ['Value4'] : '');?>" /></td>
    </tr>
    <tr>
        <td><label for="title">Giá trị 5</label></td>
        <td><input class="input" type="text" name="Value5" size="40"maxlength="255"value="<?php echo ($fields != null ? $fields ['Value5'] : '');?>" /></td>
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
            <input type="hidden" name="OptionID"
            value="<?php
                echo $fields ['OptionID'];
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

