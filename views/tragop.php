<div class="product-detail-left">
<?php
    $query = $db->query("SELECT * FROM page WHERE Name ='Trả góp' ");
    if($db->numRows($query) > 0){
        $gets  = array();
        while(($row = $db->fetchArray($query)) != null){
            $gets[] = $row;
            $content = handle_content($row['Content']);
        }
    }
    $i=0;
    if (count($gets) > 0)
    {
        foreach ($gets as $get)
        {
            $i++;
    ?>
    <h3><?php echo $get['Title']; ?></h3>
    <div class="detail-info">
        <div id="detail-product" style="overflow: hidden;">
            <div class="content">
                <?php echo $content; ?>
            </div>
        </div>
        <!-- end detail-product -->
    </div>
    <!-- end detail-info -->
    <div id="comment">
        <div id="fb-root"></div>
        <div class="facebook" style="margin-top: 20px;">
            <div class="fb-comments" data-href="" data-width="100%" data-numposts="5" data-colorscheme="light"></div>
            <div class="clear"></div>
        </div>
    </div>
                <!-- end comment -->
    <?php
        }
    }
      ?>
</div>
<!-- end product-detail-left -->
<div class="product-detail-right">
    <div class="block-news">
        <ul class="info">
            <li class="new">
                <div class="detail">
                    <h4>Tin mới nhất</h4>
                    <ul>
                    <?php
                        $query = $db->query("SELECT * FROM cms ORDER By DateUpdated DESC LIMIT 5");
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
                        ?>
                        <li>
                            <div class="block-detail">
                                <a href="chitiet-tintuc.php?CmsID=<?php echo $get['CmsID'];?>" class="img"><img src="<?php echo BASE_URL ?>/uploads/<?php echo $get['Avatar']; ?>" alt="<?php echo $get['Title']; ?>"></a>
                                <div class="txt">
                                    <h5><a href="chitiet-tintuc.php?CmsID=<?php echo $get['CmsID'];?>"><?php echo $get['Title']; ?></a></h5>
                                    <span><?php echo $DateUpdated ?></span>
                                </div>
                            </div>
                            <!-- end block-detail -->
                        </li>
                        <?php
                        }
                    }
                      ?>
                    </ul>
                </div>
                <!-- end detail -->
            </li>
        </ul>
        <div class="clear"></div>
    </div>
    <div class="compare">
        <h4>Sản Phẩm nổi bật</h4>
        <ul class="compare-list">
         <?php
            $query = $db->query("SELECT * FROM product ORDER By rand() LIMIT 6");
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
            ?>
            <li>
                <a href="index.php?p=chitietsp&ProductID=<?php echo $get['ProductID'];?>&Slug=<?php echo $get['Slug'];?>" class="img"><img src="uploads/<?=$get['Image']; ?>" alt="<?=$get['Name']; ?>"></a>
                <h5 style="height: 30px;overflow: hidden;"><a href="index.php?p=chitietsp&ProductID=<?php echo $get['ProductID'];?>&Slug=<?php echo $get['Slug'];?>"><?php echo $get['Name']; ?></a></h5>
                <strong><?php echo $get['Price'];?> đ</strong>
            </li>
                <?php
                }
            }
              ?>
        </ul>
    </div>
</div>
     <!-- <?php
        $query = $db->query("SELECT * FROM product ORDER BY Name");
        if($db->numRows($query) > 0){
            $gets  = array();
            while(($row = $db->fetchArray($query)) != null){
                $gets[] = $row;
            }
        }
        if (count($gets) > 0)
        { $i;
            foreach ($gets as $get)
            {   $i++;
        ?>
        <div>
            <p>{ value: '<?php echo $get['Name'];?>'},</p>
        </div>
            <?php
            }
        }
         ?> -->

<!-- end product-detail-right -->
<div class="clear"></div>
