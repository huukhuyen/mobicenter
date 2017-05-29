﻿<div class="container">
    <div class="content-new">
        <div class="news-left">
            <h3>Tin mới nhất</h3>
            <ul>
                <?php
                    $sotrang = $_GET['trang'];
                    $sohienthi = 10;
                    if(isset($sotrang))
                    {
                        $sotrang = $_GET['trang'];
                        settype($sotrang, "int");
                    }else{
                        $sotrang = 1;
                    }

                    $batdautu = ($sotrang - 1) * $sohienthi;
                    
                    $query = $db->query("SELECT * FROM cms ORDER BY DateUpdated DESC LIMIT $batdautu, $sohienthi");
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
                    <div class="detail" style="position: relative;">
                        <h2 style="height: 42px ;overflow: hidden;"><a href="chitiettin/<?php echo $get['CmsID'];?>/<?php echo $get['Slug'];?>.html"><?php echo $get['Title'];?></a></h2>
                        <span><?php  $DateUpdated = gmdate ( "d-m-Y H:i:s", intval ( $get['DateUpdated'] ));
                            echo $DateUpdated;?></span>
                        <div style="overflow: hidden;height: 175px;">
                            <div class="img">
                                <a href="chitiettin/<?php echo $get['CmsID'];?>/<?php echo $get['Slug'];?>.html"><img src="uploads/<?php echo $get['Avatar'];?>" alt=""></a>
                            </div>
                            <h4><p><?php echo $get['SimpleContent'];?></p></h4>
                        </div>
                    </div>
                </li>
                    <?php
                    }
                }
                $tongsorecord = 0;              
                $query = $db->query("SELECT COUNT(*) FROM cms");
                if($db->numRows($query) > 0){
                    $gets  = array();
                    $row = $db->fetchArray($query);
                    $tongsorecord = $row[0];
                }
                
                $sotranghienco = $tongsorecord / $sohienthi;
                if ($tongsorecord % $sohienthi != 0) 
                {
                    $sotranghienco++;
                    settype($sotranghienco,"int");
                }
                echo "<div class='navigation'>";
                echo "<span class='current_page_item'>Bạn đang xem trang ".$sotrang." trên $sotranghienco</span>";
                for ($i=1; $i<=$sotranghienco; $i++){
                    if ($i == $sotrang) 
                    {
                        echo "<b><a href=tintuc/trang$i><span class='current_page_item'>$i</span></a></b>";
                    }
                    else
                    {
                        echo "<a href=tintuc/trang$i><span class='current_page_item'>$i</span></a> ";
                    }
                }
                echo "</div>";
                ?>
                <div class="navigation"></div>
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
                                    $gets  = array();
                                    while(($row = $db->fetchArray($query)) != null){
                                        $gets[] = $row;
                                    }
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
