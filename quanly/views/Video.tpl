<?php

require_once (VIEWS_COMMON_ADMIN_PATH . "Wysiwyg.tpl");
require_once (VIEWS_COMMON_ADMIN_PATH . "TabBegin.tpl");

require_once (MODELS_PATH . 'VideoCategories.php');

$objHandleCat = new VideoCategories ();
$categories = $objHandleCat->getAllVideoCategories();

$fields['VideoCategoryID'] = $fields['VideoCategoryID'] ? $fields['VideoCategoryID'] : $_GET['VideoCategoryID'];
?>


<form method="post"
	enctype="multipart/form-data" 
    action="index.php?module=Video&act=<?php
    echo ($fields['VideoID'] != null ? 'Update' : 'Insert');
    ?>">
<table class="adminform" style="width: 100%;">
    
        
        
    <tr>
        <td><label for="title">Danh mục video clip</label></td>
        <td>
		<select onchange="go_url(this)" name="VideoCategoryID" style="width:187px;">
			<option value="0">(Chọn)</option>
				<?php
				foreach ($categories as $category) 
				{
				$selected = '';				
				
				if($category['VideoCategoryID'] == $fields['VideoCategoryID'])
				{
					$selected = ' selected';
				}				
				echo "<option value=\"".$category['VideoCategoryID']."\" ".$selected.">".$category['Year']." - ".$category['Name']."</option>";
				}
				?>
			</option>
		</td>
    </tr>
    
    <tr>
        <td><label for="title">Tên video</label></td>
        <td><input class="input" type="text" name="Name" size="40"maxlength="255"value="<?php echo ($fields != null ? $fields ['Name'] : '');?>" /></td>
    </tr>
	
	<tr>
        <td><label for="title">Hình ảnh thumbnail</label></td>
        <td><img src="http://img.youtube.com/vi/<?php echo $fields ['Video'];?>/0.jpg" /></td>
    </tr>
	<tr>
	<td><label for="title">Video</label></td>
    
			<td><input style="width:500px; background: #CCC" class="input" type="text" name="Video" size="40"maxlength="255"value="<?php echo ($fields['Video'] == "" ? '' : "http://www.youtube.com/watch?v=".$fields ['Video']);?>" /></td>
	
	</tr>
	<tr>
		<td><label for="title">Miêu tả về Video</label></td>
    
			<td>
				<textarea id="content" name="Description"><?php echo ($fields != null ? $fields ['Description'] : '');?></textarea>			
			</td>
	
    
    
    <tr>
        <td colspan="2" style="height: 10px;"></td>
    </tr>
    <tr>
        <td></td>
        <td><input class="button" type="submit"
            name="<?php
            echo ($fields['VideoID'] == "" ? 'insert' : 'update');
            ?>"
            value="<?php
            echo ($fields['VideoID'] != null ? 'Cập nhật' : 'Thêm mới');
            ?>" />
            <?php
            if ($fields['VideoID'] != null) :
                ?>
            <input type="hidden" name="VideoID"
            value="<?php
                echo $fields ['VideoID'];
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