<div class="block-product">
    <ul class="list-tab block-list-4">
        <li>
            <h2><a href="#iphone-sp" class="active">IPHONE</a></h2></li>
    </ul>
    <!-- end list-tab -->
    <div class="tab-content">
        <div id="iphone-sp" class="tab-detail block-detail-4">
            <ul>
            <?php
                $query = $db->query("SELECT product.ProductID, product.Slug, product.Name, product.Price, product.Image FROM product, product_categories WHERE product_categories.CategoryID = product.CategoryID and product_categories.Name LIKE '%iPhone%'");
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
                                    <select name="Number" class="form-control">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
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
    </div>
</div>
