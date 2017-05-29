<div class="block-product">
    <ul class="list-tab block-list-1">
        <li>
            <h2><a href="#product-hot" class="active">Sảm phẩm <?php echo $keyword ?></a></h2></li>
    </ul>
    <!-- end list-tab -->
    <div class="tab-content">
        <div id="product-hot" class="tab-detail block-detail-1">
            <ul>
            <?php
                $keyword = $_GET['keyword'];
                $query = $db->query("SELECT product.ProductID, product.Slug, product.Name, product.Price, product.Image FROM product, product_categories WHERE product.CategoryID = product_categories.CategoryID LIMIT 43");
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
