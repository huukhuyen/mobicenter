<div class="block-news">
    <div class="container">
        <ul class="info">
            <li>
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
                <!-- end detail -->
            </li>
            <li>
                <div class="detail">
                    <h4>Tin hot nhất</h4>
                    <ul class="new-hot">
                    <?php
                        $query = $db->query("SELECT * FROM cms ORDER BY ViewedCount DESC LIMIT 8");
                        if($db->numRows($query) > 0){
                            // $gets  = array();
                            // while(($row = $db->fetchArray($query)) != null){
                            //     $gets[] = $row;
                            // }
                            $gets = $db->result_array($query);
                        }
                        if (count($gets) > 0)
                        { 
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
                <!-- end detail -->
            </li>
            <li class="promotion">
                <div class="detail">
                    <a href="#"><img src="images/tuyendung.jpg" alt=""></a>
                </div>
                <!-- end detail -->
            </li>
        </ul>
        <div class="clear"></div>
    </div>
</div>