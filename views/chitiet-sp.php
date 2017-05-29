<div class="product-detail-left">
<?php
    $ProductID = $_GET['ProductID'];
    $query = $db->query("SELECT * FROM product WHERE ProductID =".$_GET['ProductID']);
    if($db->numRows($query) > 0){
        $gets  = array();
        while(($row = $db->fetchArray($query)) != null){
            $gets[] = $row;
            $content = handle_content($row['FullDescription']);
        }
    }
    $i=0;
    if (count($gets) > 0)
    {
        foreach ($gets as $get)
        {
            $i++;
    ?>
    <h3><?php echo $get['Name']; ?></h3>
    <div class="detail-info">
        <div style="display: none;" id="task_flyout">
            <ul class="tab">
                <li><a href="#detail-product">Chi tiết sản phẩm</a></li>
                <li><a href="#comment">Bình luận</a></li>
                <div class="clear"></div>
            </ul>
            <div class="clear"></div>
        </div>
        <div style="width: 100%;" id="task_flyout1">
            <ul class="tab">
                <li><a href="#detail-product">Chi tiết sản phẩm</a></li>
                <li><a href="#comment">Bình luận</a></li>
            </ul>
        </div>
        <div id="detail-product" style="overflow: hidden;">
            <h4 style="padding-bottom: 20px;">Chi tiết sản phẩm</h4>
            <div class="content">
                <?php echo $content; ?>
                <img width="95px" src="<?php echo BASE_URL ?>/uploads/<?php echo $get['Image'];?>">

            </div>
        </div>
        <!-- end detail-product -->
    </div>
    <!-- end detail-info -->
    <div id="comment">
        <h4>Bình luận về sản phẩm <?php echo $get['Name']; ?></h4>
        <div id="fb-root"></div>
        <div class="facebook" style="margin-top: 20px;">
            <div class="fb-comments" data-href="http://quangphucmobile.com/san-pham-xem/178/samsung-galaxy-j5/" data-width="100%" data-numposts="5" data-colorscheme="light"></div>
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
    <div class="block-price">
        <label>Giá bán</label>
    </div>
    <!-- end price -->
    <strong class="price"><?php echo $get['Price'] ?> đ</strong>
    <div class="compare">
        <h4>Sản Phẩm nổi bật</h4>
        <ul class="compare-list">
         <?php
            $query = $db->query("SELECT * FROM product ORDER By rand() LIMIT 6");
            if($db->numRows($query) > 0){
                $gets = $db->result_array($query);
            }
            if (count($gets) > 0)
            { 
                foreach ($gets as $get)
                {   
            ?>
            <li>
                <a href="chitietsp/<?php echo $get['ProductID'];?>/<?php echo $get['Slug'];?>.html" class="img"><img src="<?php echo BASE_URL ?>uploads/<?=$get['Image']; ?>" alt="<?=$get['Name']; ?>"></a>
                <h5 style="height: 30px;overflow: hidden;"><a href="chitietsp/<?php echo $get['ProductID'];?>/<?php echo $get['Slug'];?>.html"><?php echo $get['Name']; ?></a></h5>
                <strong><?php echo $get['Price'];?> đ</strong>
            </li>
                <?php
                }
            }
              ?>
        </ul>
    </div>
    <!-- end compare -->
    <div class="block-news">
        <ul class="info">
            <li class="new">
                <div class="detail">
                    <h4>Tin mới nhất</h4>
                    <ul>
                    <?php
                        $query = $db->query("SELECT * FROM cms ORDER By DateUpdated DESC LIMIT 5");
                        if($db->numRows($query) > 0){
                            $gets = $db->result_array($query);
                        }
                        if (count($gets) > 0)
                        { 
                            foreach ($gets as $get)
                            {   
                        ?>
                        <li>
                            <div class="block-detail">
                                <a href="chitiettin/<?php echo $get['CmsID'];?>/<?php echo $get['Slug'];?>.html" class="img"><img src="<?php echo BASE_URL ?>/uploads/<?php echo $get['Avatar']; ?>" alt="<?php echo $get['Title']; ?>"></a>
                                <div class="txt">
                                    <h5><a href="chitiettin/<?php echo $get['CmsID'];?>/<?php echo $get['Slug'];?>.html"><?php echo $get['Title']; ?></a></h5>
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
    <!-- end block-new -->
</div>
<!-- end product-detail-right -->
<div class="clear"></div>
