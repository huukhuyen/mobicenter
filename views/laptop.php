<div class="block-product">
    <ul class="list-tab block-list-5">
        <li>
            <h2><a href="#laptop" class="active">Laptop</a></h2></li>
        <li>
            <h2><a href="#macbook" >MacBook Air</a></h2></li>
    </ul>
    <!-- end list-tab -->
    <div class="tab-content">
        <div id="laptop" class="tab-detail block-detail-5">
           <ul>
            <?php
                $query = $db->query("SELECT product.ProductID, product.Slug, product.Name, product.Price, product.Image FROM product, product_categories WHERE product_categories.CategoryID = product.CategoryID and product_categories.Name LIKE '%Laptop%'");
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
                        <h4><a href="index.php?ProductID=<?php echo $get['ProductID'];?>&p=chitietsp"><?php echo $get['Name'];?></a></h4>
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
        <!-- end tab-detail -->
        <div id="macbook" class="tab-detail block-detail-5">
            <ul>
                <li>
                    <div class="detail">
                        <a href="san-pham-xem/171/macbook-air-mjvg2-(256gb-ssd)/index.html" class="img"><img width="95px" src="uploads/product/sp_1438158184.png" alt="Macbook Air MJVG2 (256GB SSD)"></a>
                        <h4><a href="san-pham-xem/171/macbook-air-mjvg2-(256gb-ssd)/index.html">Macbook Air MJVG2 (256GB SSD)</a></h4>
                        <strong>24.490.000 đ</strong>
                    </div>
                    <!-- end detail -->
                    <div class="txt-info">
                        <div class="block">
                            <h4><a href="san-pham-xem/171/macbook-air-mjvg2-(256gb-ssd)/index.html">Macbook Air MJVG2 (256GB SSD)</a></h4>
                            <ul>
                                Bộ xử lý i5 Haswell 1.6GHz Intel Dual-core thế hệ mới nhất (ép xung lên đến 2.7 GHz)
                                <br/>• Bộ nhớ cache 3MB L3 và 4GB bộ nhớ trong RAM LPDDR3 1600MHz
                                <br/>• Ổ cứng 256GB SSD siêu nhanh
                                <br/>• Tích hợp cạc đồ họa Intel </ul>
                        </div>
                    </div>
                    <!-- end txt-info -->
                </li>
                <li>
                    <div class="detail">
                        <a href="san-pham-xem/170/macbook-air-mjve2-(128gb-ssd)/index.html" class="img"><img width="95px" src="uploads/product/sp_1438158142.png" alt="Macbook Air MJVE2 (128GB SSD)"></a>
                        <h4><a href="san-pham-xem/170/macbook-air-mjve2-(128gb-ssd)/index.html">Macbook Air MJVE2 (128GB SSD)</a></h4>
                        <strong>20.690.000 đ</strong>
                    </div>
                    <!-- end detail -->
                    <div class="txt-info">
                        <div class="block">
                            <h4><a href="san-pham-xem/170/macbook-air-mjve2-(128gb-ssd)/index.html">Macbook Air MJVE2 (128GB SSD)</a></h4>
                            <ul>
                                • Bộ xử lý i5 Haswell 1.6GHz Intel Dual-core thế hệ mới nhất (ép xung lên đến 2.7 GHz)
                                <br/>• Bộ nhớ cache 3MB L3 và 4GB bộ nhớ trong RAM LPDDR3 1600MHz
                                <br/>• Ổ cứng 128GB SSD siêu nhanh
                                <br/>• Tích hợp cạc đồ họa I </ul>
                        </div>
                    </div>
                    <!-- end txt-info -->
                </li>
                <li>
                    <div class="detail">
                        <a href="san-pham-xem/169/macbook-air-mjvm2-(128gb-ssd)/index.html" class="img"><img width="95px" src="uploads/product/sp_1438157434.png" alt="Macbook Air MJVM2 (128GB SSD)"></a>
                        <h4><a href="san-pham-xem/169/macbook-air-mjvm2-(128gb-ssd)/index.html">Macbook Air MJVM2 (128GB SSD)</a></h4>
                        <strong>18.590.000 đ</strong>
                    </div>
                    <!-- end detail -->
                    <div class="txt-info">
                        <div class="block">
                            <h4><a href="san-pham-xem/169/macbook-air-mjvm2-(128gb-ssd)/index.html">Macbook Air MJVM2 (128GB SSD)</a></h4>
                            <ul>
                                • Bộ xử lý i5 Haswell 1.6GHz Intel Dual-core thế hệ mới nhất (ép xung lên đến 2.7 GHz)
                                <br/>• Bộ nhớ cache 3MB L3 và 4GB bộ nhớ trong RAM LPDDR3 1600MHz
                                <br/>• Ổ cứng 128GB SSD siêu nhanh
                                <br/>• Tích hợp cạc đồ họa In </ul>
                        </div>
                    </div>
                    <!-- end txt-info -->
                </li>
            </ul>
            <div class="clear"></div>
        </div>
        <!-- end tab-detail -->
    </div>
    <!-- end tab-tab-content -->
</div>
