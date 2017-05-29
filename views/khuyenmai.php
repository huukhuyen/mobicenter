<div class="container">
    <div class="content-new">
        <div class="news-left">
            <h3>Khuyến mãi</h3>
            <ul>
            <?php
            $query = $db->query("SELECT cms.CmsID, cms.Title, cms.Slug, cms.Avatar FROM cms_categories, cms WHERE cms.CategoryID = cms_categories.CategoryID and cms_categories.Name LIKE '%Tin khuyến mãi%'");
            if($db->numRows($query) > 0){
                $gets = $db->result_array($query);
            }
            if (count($gets) > 0)
            {
                foreach ($gets as $get)
                {
                    $i++;
            ?>
                <li>
                    <div class="detail" style="position: relative;border: none;">
                        <div class="ga" style="overflow: hidden;height: 240px;border: 1px solid #D0CDCD; padding: 8px;">
                            <div style="width: 100%;text-align: center;">
                                <a href="chitiettin/<?php echo $get['CmsID'];?>/<?php echo $get['Slug'];?>.html"><img src="<?php echo BASE_URL ?>/uploads/<?php echo $get['Avatar']; ?>" alt=""></a>
                            </div>
                        </div>
                        <h2 style="height: 42px ;overflow: hidden;text-align: center;padding: 15px 0;"><a href="chitiettin/<?php echo $get['CmsID'];?>/<?php echo $get['Slug'];?>.html"><?php echo $get['Title']?></a></h2>
                </li>
                <?php
                }
            }
            echo "</ul>";
            ?>
            </ul>
            </div>
            <!-- end news-left -->
            <div class="news-right">
            <div class="block-news">
                <ul class="info">
                    <li>
                        <div class="detail">
                            <h4>Tin hot nhất</h4>
                            <ul class="new-hot">
                            <?php
                                $query = $db->query("SELECT * FROM cms ORDER By ViewedCount DESC LIMIT 5");
                                if($db->numRows($query) > 0){
                                    $gets = $db->result_array($query);
                                }
                                if (count($gets) > 0)
                                { $i=0;
                                    foreach ($gets as $get)
                                    {   $i++
                                ?>
                                    <li>
                                        <span class="number"><?php echo $i ?></span>
                                        <h5><a href="chitiettin/<?php echo $get['CmsID'];?>/<?php echo $get['Slug'];?>.html"><?php echo $get['Title']; ?></a></h5>
                                    </li>
                                <?php
                                }
                            }
                              ?>
                            </ul>
                        </div>
                    </li>
                </ul>
                <div class="clear"></div>
            </div>
            <!-- end block-new -->
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
                                        <a href="chitiettin/<?php echo $get['CmsID'];?>/<?php echo $get['Slug'];?>.html" class="img"><img src="uploads/<?php echo $get['Avatar']; ?>" alt="<?php echo $get['Title']; ?>"></a>
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
                    </li>
                </ul>
                <div class="clear"></div>
            </div>
            <!-- end block-new -->
        </div>
        <!-- end news-right -->
        <div class="clear"></div>
    </div>
    <!-- end content-new -->
</div>
