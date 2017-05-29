<div class="banner">
    <a href="#"><img src="uploads/gal/37.jpg" alt="banner1"></a>
</div>
<!-- end banner -->
<div class="product-list">
    <ul class="list">
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
                <a href="chitietsp/<?php echo $get['ProductID'];?>/<?php echo $get['Slug'];?>.html" class="img"><img width="65px" src="uploads/<?php echo $get['Image'] ;?>" alt="<?php echo $get['Name'] ;?>"></a>
                <div class="txt">
                    <a href="chitietsp/<?php echo $get['ProductID'];?>/<?php echo $get['Slug'];?>.html"><h4 style="height: 38px;overflow: hidden;"><?php echo $get['Name'] ;?></h4></a>
                    <strong class="price"><?php echo $get['Price'] ;?>đ</strong>
                </div>
            </div>
        </li>
            <?php
        echo "</ul>";
        }
    }
?>
    </ul>
</div>
<!-- end product-list -->
