<div class="block-product">
    <ul class="list-tab block-list-1">
        <li>
            <h2><a href="#product-hot" class="active">Sản phẩm nổi bật</a></h2></li>
    </ul>
    <!-- end list-tab -->
    <div class="tab-content">
        <div id="product-hot" class="tab-detail block-detail-1">
            <ul>
            <?php
                $query = $db->query("SELECT * FROM product ORDER BY rand() LIMIT 0,12");
                if($db->numRows($query) > 0){
                    $gets  = array();
                    while(($row = $db->fetchArray($query)) != null){
                        $gets[] = $row;
                    }
                }
                if (count($gets) > 0)
                {
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
<!-- end block-product -->
<div class="banner">
    <a href="#"><img src="uploads/gal/38.png" alt="banner2"></a>
</div>
