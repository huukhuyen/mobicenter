</div>
</div>
</div>
</div>
<div class="main_bottom">
</div>
<div class="footer clearfix">
    <?php 
                    $time_load = end_page_load();
                    $gzip = substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip') ? "Bật" : "Tắt";             
                ?>
        <div class="left">
            Thời gian tải trang:
            <?php echo $time_load ?>. GZIP đang ở trạng thái
                <?php echo $gzip ?>.
                    <br/> Copyright © 2015. All rights reserved.
        </div>
        <div class="right">
            <br/>
        </div>
</div>
</center>
</body>

</html>
