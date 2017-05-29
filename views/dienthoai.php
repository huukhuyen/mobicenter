<div class="block-product">
    <ul class="list-tab block-list-2">
        <li>
            <h2><a href="#oppo" class="active">OPPO</a></h2></li>
        <li>
            <h2><a href="#nokia" >NOKIA</a></h2></li>
        <li>
            <h2><a href="htc" >HTC</a></h2></li>
        <li>
            <h2><a href="#samsung" >SAMSUNG</a></h2></li>
        <li>
            <h2><a href="#wing" >WING</a></h2></li>
        <li>
            <h2><a href="#zenfone" >ZENFONE</a></h2></li>
    </ul>
    <div class="tab-content">
    <!-- OPPO -->
        <div id="oppo" class="tab-detail block-detail-2">
            <ul>
            <?php
                require_once ('config.php');
                $query = $db->query("SELECT product.ProductID, product.Slug, product.Name, product.Price, product.Image FROM product, product_categories WHERE product.CategoryID = product_categories.CategoryID and product_categories.Name LIKE '%OPPO%' LIMIT 0,12");
                if($db->numRows($query) > 0){
                    $gets = $db->result_array($query);
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
                </li>
                        <?php
                echo "</ul>";
                }
            }
        ?>
            </ul>
            <div class="clear"></div>
        </div>
        <!-- NOKIA -->
        <div id="nokia" class="tab-detail block-detail-2">
            <ul>
            <?php
                $query = $db->query("SELECT product.ProductID, product.Slug, product.Name, product.Price, product.Image FROM product, product_categories WHERE product.CategoryID = product_categories.CategoryID and product_categories.Name LIKE '%NOKIA%' LIMIT 0,12");
                if($db->numRows($query) > 0){
                    $gets = $db->result_array($query);
                }
                if (count($gets) > 0)
                {
                    foreach ($gets as $get)
                    {   
                    echo "<ul>";
                ?>
                <li>
                    <div class="detail">
                        <a href="views/index.php?p=chitietsp&ProductID=<?php echo $get['ProductID'];?>" class="img"><img width="95px" src="uploads/<?php echo $get['Image'];?>" alt="<?php echo $get['Name'];?>"></a>
                        <h4><a href="views/chitietsp/<?php echo $get['ProductID'];?>/<?php echo $get['Slug'];?>.html"><?php echo $get['Name'];?></a></h4>
                        <strong><?=$get['Price'];?> đ</strong>
                    </div>
                    <div class="txt-info">
                        <div class="block">
                        <form action="addcart.php?ProductID=<?php echo $get['ProductID'];?>" method="POST">
                            <h4><a href="views/chitietsp/<?php echo $get['ProductID'];?>/<?php echo $get['Slug'];?>.html"><?php echo $get['Name'] ;?></a></h4>
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
                </li>
                        <?php
                echo "</ul>";
                }
            }
        ?>
            </ul>
            <div class="clear"></div>
        </div>
        <!-- HTC -->
        <div id="iphone-3" class="tab-detail block-detail-2">
            <ul>
            <?php
                $query = $db->query("SELECT product.ProductID, product.Slug, product.Name, product.Price, product.Image FROM product, product_categories WHERE product_categories.CategoryID = product.CategoryID and product_categories.Name LIKE '%HTC%' LIMIT 0,12");
                if($db->numRows($query) > 0){
                    $gets = $db->result_array($query);
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
                </li>
                        <?php
                echo "</ul>";
                }
            }
        ?>
            </ul>
            <div class="clear"></div>
        </div>
        <!-- SAMSUNG -->
        <div id="samsung" class="tab-detail block-detail-2">
            <ul>
            <?php
                $query = $db->query("SELECT product.ProductID, product.Slug, product.Name, product.Price, product.Image FROM product, product_categories WHERE product_categories.CategoryID = product.CategoryID and product_categories.Name LIKE '%SAMSUNG%' LIMIT 0,12");
                if($db->numRows($query) > 0){
                    $gets = $db->result_array($query);
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
                </li>
                        <?php
                echo "</ul>";
                }
            }
        ?>
            </ul>
            <div class="clear"></div>
        </div>
        <!-- WING -->
        <div id="wing" class="tab-detail block-detail-2">
            <ul>
            <?php
                $query = $db->query("SELECT product.ProductID, product.Slug, product.Name, product.Price, product.Image FROM product, product_categories WHERE product_categories.CategoryID = product.CategoryID and product_categories.Name LIKE '%Wing%' LIMIT 0,12");
                if($db->numRows($query) > 0){
                    $gets = $db->result_array($query);
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
                </li>
                        <?php
                echo "</ul>";
                }
            }
        ?>
            </ul>
            <div class="clear"></div>
        </div>
        <!-- ZENFONE -->
        <div id="zenfone" class="tab-detail block-detail-2">
            <ul>
            <?php
                $query = $db->query("SELECT product.ProductID, product.Slug, product.Name, product.Price, product.Image FROM product, product_categories WHERE product_categories.CategoryID = product.CategoryID and product_categories.Name LIKE '%Zen%' LIMIT 0,12");
                if($db->numRows($query) > 0){
                    $gets = $db->result_array($query);
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
                </li>
                        <?php
                echo "</ul>";
                }
            }
        ?>
            </ul>
            <div class="clear"></div>
        </div>
    </div>
</div>
<div class="banner">
    <a href="#"><img src="uploads/gal/39.jpg" alt="banner3"></a>
</div>
