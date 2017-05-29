<div class="block-product">
    <ul class="list-tab block-list-1">
        <li>
            <h2><a href="#product-hot" class="active">Sản phẩm <?php echo $keyword ?></a></h2></li>
    </ul>
    <!-- end list-tab -->
    <div class="tab-content">
    <div class="row">
        <div class="col-lg-2">
            <select id="type" name="type" class="form-control" onchange="onchangetype()">
            <?php if($_GET['type'] == 0) {?>
                <option value="0" selected>ĐIỆN THOẠI</option>
                <option value="1">LAPTOP</option>
                <option value="2">TABLET</option>
                <option value="3">PHỤ KIỆN</option>
            <?php } else if($_GET['type'] == 1) {?>
                <option value="0">ĐIỆN THOẠI</option>
                <option value="1" selected>LAPTOP</option>
                <option value="2">TABLET</option>
                <option value="3">PHỤ KIỆN</option>
            <?php } else if($_GET['type'] == 2) {?>
                <option value="0">ĐIỆN THOẠI</option>
                <option value="1">LAPTOP</option>
                <option value="2" selected>TABLET</option>
                <option value="3">PHỤ KIỆN</option>
            <?php } else if($_GET['type'] == 3) {?>
            <option value="0">ĐIỆN THOẠI</option>
                <option value="1">LAPTOP</option>
                <option value="2">TABLET</option>
                <option value="3" selected>PHỤ KIỆN</option>
            <?php } else {?>
                <option value="0">ĐIỆN THOẠI</option>
                <option value="1">LAPTOP</option>
                <option value="2">TABLET</option>
                <option value="3">PHỤ KIỆN</option>
            <?php } ?>
            </select>
        </div>
        <div class="col-md-2">
            <?php 
                $query = $db->query("Select * from product_categories order by CategoryID desc");
                if($db->numRows($query) > 0){
                    $gets  = array();
                    while(($row = $db->fetchArray($query)) != null){
                        $gets[] = $row;
                    }
                }
            ?>
            <select id="price_sort" class="form-control" name="Name" onchange="changephonetype()">
                <?php 
                    if(count($gets)) {
                        foreach ($gets as $k => $v) {
                            if($v["CategoryID"]==(int)@$_GET["price_sort"])
                                $selected="selected";
                            else 
                                $selected="";
                ?>
                <option value="<?=$v['CategoryID']?>" <?=$selected?>><?=$v['Name']?></option>
                <?php 
                    }
                }
                ?>
            </select>
        </div>
    </div>
        <div id="product-hot" class="tab-detail block-detail-1">
        <!-- Lọc -->
        
            <ul>
            <?php
                /*echo '<pre>';
                var_dump($_GET);
                echo '<pre>';*/
                //die;
                $keyword = $_GET['keyword'];
                $sql = "SELECT * FROM product WHERE Name LIKE '%".$keyword."%'";
                if((int)@$_GET['type']>='0') {
                    $sql = "SELECT p.*, pc.* FROM product p inner join product_categories pc on p.CategoryID = pc.CategoryID WHERE p.Name LIKE '%".$keyword."%' and pc.parentID = '".$_GET['type']."'";
                }
                if((int)@$_GET['price_sort']) {
                    $sql = "SELECT p.*, pc.* FROM product p inner join product_categories pc on p.CategoryID = pc.CategoryID WHERE p.Name LIKE '%".$keyword."%' and pc.CategoryID = '".$_GET['price_sort']."'";
                }
                
                if((int)@$_GET['price']!='') {
                    $price = explode("_",$_GET['price']);
                    $pr = str_replace(".", "", $price[0]);
                    if($price[1] == "small") {
                        $sql = "SELECT p.*, pc.* FROM product p inner join product_categories pc on p.CategoryID = pc.CategoryID WHERE p.Name LIKE '%".$keyword."%' and pc.parentID = '".$_GET['type']."' and p.Price >= 0  and p.Price <= ".$pr."";
                    } else {
                        $sql = "SELECT p.*, pc.* FROM product p inner join product_categories pc on p.CategoryID = pc.CategoryID WHERE p.Name LIKE '%".$keyword."%' and pc.parentID = '".$_GET['type']."' and p.Price >= ".$pr."";
                    }
                }
                // echo $sql;
                $query = $db->query($sql);
                
                if($db->numRows($query) > 0){
                    $gets  = array();
                    while(($row = $db->fetchArray($query)) != null){
                        $gets[] = $row;
                    }
                }
                else{
                    echo "<p style='color:red; font-size:20px; margin:10px 0px 130px 0px; text-align:center'>Không có kết quả với từ khóa \"".$keyword."\"</p>";
                }
                if (count($gets) > 0)
                {
                    echo "<p style='color:#0F7EA9;text-transform:uppercase; font-weight:bold; border-bottom:1px solid #51a5eb; padding:10px 0px; font-size:16px; text-align:center'>Có ". count($gets)." sản phẩm ".$keyword."</p>";
                    foreach ($gets as $get)
                    {   
                    echo "<ul>";
                ?>
                <li>
                    <div class="detail">
                        <a href="chitietsp/<?php echo $get['ProductID'];?>/<?php echo $get['Slug'];?>.html" class="img"><img width="95px" src="uploads/<?php echo $get['Image'];?>" alt="<?php echo $get['Name'];?>"></a>
                        <h4><a href="chitietsp/<?php echo $get['ProductID'];?>/<?php echo $get['Slug'];?>.html"><?php echo $get['Name'];?></a></h4>
                        <strong><?=$get['Price'];?> đ</strong>
                    </div>
                    <!-- end detail -->
                    <div class="txt-info">
                        <div class="block">
                        <form action="addcart.php?ProductID=<?php echo $get['ProductID'];?>" method="POST">
                            <h4><a href="chitietsp/<?php echo $get['ProductID'];?>/<?php echo $get['Slug'];?>.html"><?php echo $get['Name'] ;?></a></h4>
                            <h4><a style="color:red; text-align: center!importan" href="addcart.php" title=""><img src="images/add.png" height="40" width="40" alt=""></a>
                                <input type="number" name="Number" style="height:20px; background:#FFFCDB; text-indent: 10px" min="0" max="20" class="form-control" value="1"/>
                            </h4>
                            <input type="submit" name="" class="btn btn-primary" value="Mua">
                        </form>

                            <ul>
                                - Nhỏ gọn, mạnh mẽ - hiệu quả
                                <br/>- Thiết kế sang trọng - quý phái
                                <br/>- Tương thích với bất cứ thiết bị nào của Apple
                                <br/>- Xem phim và hình ảnh chuẩn 1080HD
                                <br/>- Chia sẻ hình ảnh, phim, âm nhạc... cho tất cả mọi người.
                            </ul>
                        </div>
                    </div>
                    <!-- end txt-info -->
                </li>
                        <?php
                    echo "</ul>";
                    }
                }
            ?>
            </ul>
            <div class="clear"></div>
        </div>
        <!-- end tab-detail -->
    </div>
    <!-- end tab-tab-content -->
</div>
<script type="text/javascript">
    function onchangetype() {
        var a=document.getElementById("type");
        window.location ="trang-chu?keyword=&p=find&type="+a.value;    
        return true;
    }
    function changephonetype() {
        var a=document.getElementById("type");
        var b=document.getElementById("price_sort");
        window.location ="trang-chu?keyword=&p=find&type="+a.value+"&price_sort="+b.value;    
        return true;
    }
    function onchangeprice() {
        var a=document.getElementById("type");
        var b=document.getElementById("price");
        window.location ="trang-chu?keyword=&p=find&type="+a.value+"&price="+b.value;    
        return true;
    }
</script>