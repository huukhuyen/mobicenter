<?php
session_start();
require_once ("config.php");
require_once(VIEWS_PATH. 'header.tpl');

if(isset($_GET['p']))
    $p = $_GET['p'];
else
    $p = "";
?>
<body>
    <div id="wrapper">
        <?php
            require_once(VIEWS_PATH. 'header2.php');
         ?>
        <div id="content">
            <div class="container">
            <?php 
            switch ($p) {
                case 'dienthoai':   require_once(VIEWS_PATH. 'mobile.php');
                    break;
                case 'tintuc':      require_once(VIEWS_PATH. 'tintuc.php');
                    break;
                case 'find':        require_once(VIEWS_PATH. 'timkiem.php');
                    break;
                case 'chitietsp':   require_once(VIEWS_PATH. 'chitiet-sp.php');
                    break;
                case 'chitiettin':  require_once(VIEWS_PATH. 'chitiet-tintuc.php');
                    break;
                case 'ipad':        require_once(VIEWS_PATH. 'ipad.php');
                    break;
                case 'phukien':     require_once(VIEWS_PATH. 'phukien.php');
                    break;
                case 'iphone':      require_once(VIEWS_PATH. 'iphone.php');
                    break;
                case 'laptop':      require_once(VIEWS_PATH. 'laptop.php');
                    break;
                case 'lienhe':      require_once(VIEWS_PATH. 'lienhe.php');
                    break;
                case 'gioithieu':      require_once(VIEWS_PATH. 'gioithieu.php');
                    break;
                case 'suachua':      require_once(VIEWS_PATH. 'suachua.php');
                    break;
                case 'doitra':      require_once(VIEWS_PATH. 'doitra.php');
                    break;
                case 'tragop':      require_once(VIEWS_PATH. 'tragop.php');
                    break;
                case 'khuyenmai':      require_once(VIEWS_PATH. 'khuyenmai.php');
                    break;

                default:
                    require_once(VIEWS_PATH. 'home.tpl');
            }
            ?>
            </div>
        </div>
	<?php require_once(VIEWS_PATH. 'footer.tpl');  ?>

</body>
</html>