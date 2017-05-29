<?php

require_once (VIEWS_COMMON_ADMIN_PATH . "Wysiwyg.tpl");
require_once (VIEWS_COMMON_ADMIN_PATH . "TabBegin.tpl");
?>

<form method="post"
    action="index.php?module=CmsCategories&act=<?php
    echo ($fields['CategoryID'] != "" ? 'Update' : 'Insert');
    ?>">
<table class="adminform" style="width: 700px;">
    
        
	<input class="input" type="hidden" name="ParentID" size="40"maxlength="255"value="0" />
    
    <tr>
        <td><label for="title">Tên danh mục</label></td>
        <td><input class="input" type="text" name="Name" size="40"maxlength="255"value="<?php echo ($fields != null ? $fields ['Name'] : '');?>" /></td>
    </tr>
	 <tr>
        <td><label for="title">Nằm trong danh mục</label></td>
        
		
		<td>
			<?php        
			
				$category = new CmsCategories();
				$cat_parent = $category->getAllCmsCategoriesByParent();	
				
				$cat = $category->getAllCmsCategoriesByGroup($cat_parent);	
				
				
				$select = '<select style="width:187px;" name="ParentID">\n';	
				$select .= "<option selected=\"selected\" value=\"0\">< Ngoài cùng ></option>\n";
				$ParentID = $fields ['ParentID'] ? $fields ['ParentID'] : $_GET['type'];

				
				
				for ($i=0; $i<sizeof($cat); $i++)
				{
					
					if ($ParentID == $cat[$i]['CategoryID'])
					{
						$select .= "<option selected=\"selected\" value=\"".$cat[$i]['CategoryID']."\" >";
						if ($cat[$i]['ParentID'] != 0)
						{
							$select .= "|_____";
						}										
						$select .= $cat[$i]['Name']."</option>\n";
					}
					else 
					{
						$select .= "<option value=\"".$cat[$i]['CategoryID']."\" >";
						if ($cat[$i]['ParentID'] != 0)
						{
							$select .= "|_____";
						}										
						$select .= $cat[$i]['Name']."</option>\n";
					}		
				}
				$select .= '</select>';
			?>
			<?php echo $select ?></td>
    </tr>
	<tr>
        <td><label for="title">Thứ tự</label></td>
        <td><input class="input" type="text" name="Index" size="40"maxlength="255"value="<?php echo ($fields != null ? $fields ['Index'] : '');?>" /></td>
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

