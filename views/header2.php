<script src="<?php echo BASE_URL ?>/Content/js/jquery.autocomplete.min.js" type="text/javascript"></script>
<script src="<?php echo BASE_URL ?>/Content/js/currency-autocomplete.js" type="text/javascript"></script>
<div id="header">
    <div class="header-top">
        <div class="container">
            <h1 style="padding-top: 2px;"><a href="<?php BASE_URL ?>trang-chu" class="logo"></a></h1>
            <div class="searching">
                <strong>Hotline: 0511 777 8888</strong>
                <div class="form-control" style="border:none; box-shadow: none; background-color:transparent!important;">
                    <form action="trang-chu" method="GET">
                        <input name="keyword" class="biginput" id="autocomplete" style="font-style: italic; border-color: #fff; color:#0d3058" type="text" placeholder="Bạn muốn mua gì..." accesskey="1">
                        <input type="hidden" name="p" value="find">
                        <button type="submit" id="find" accesskey="2"></button>
                    </form>
                </div>
                <!-- end form-control -->
            </div>
            <!-- end searching -->
            <div class="clear"></div>
        </div>
    </div>
    <!-- end header-top -->
    <div class="header-bottom">
        <div class="container">
            <div class="menu" id="menu-web">
                <a href="#menu-mobile" class="menu-mobile"><span>Menu Mobile</span></a>
                <ul>
                    <li class="home"><a href="trang-chu">Home</a></li>
                    <li><a href="danhmuc/gioithieu">Giới thiệu</a></li>
                    <li><a href="danhmuc/dienthoai">Điện thoại</a>
                        <!-- <ul>
                            <li><a href="index.php?p=dienthoai&keyword=oppo">OPPO</a></li>
                            <li><a href="index.php?p=dienthoai&keyword=nokia">NOKIA</a></li>
                            <li><a href="index.php?p=dienthoai&keyword=htc">HTC</a></li>
                            <li><a href="index.php?p=dienthoai&keyword=samsung">SAMSUNG</a></li>
                            <li><a href="index.php?p=dienthoai&keyword=wing">WING</a></li>
                            <li><a href="index.php?p=dienthoai&keyword=zenfone">ZENFONE</a></li>
                            <li><a href="index.php?p=dienthoai&keyword=iphone">IPHONE</a></li>
                        </ul> -->
                    </li>
                    <li><a href="danhmuc/ipad">Ipad</a></li>
                    <li><a href="danhmuc/iphone">Iphone</a></li>
                    <li><a href="danhmuc/laptop">Laptop</a></li>
                    <li><a href="danhmuc/phukien">Phụ kiện</a>
                        <!-- <ul>
                            <li><a href="index.php?p=phukien&keyword=tainghe">Tai nghe</a></li>
                            <li><a href="index.php?p=phukien&keyword=baoda">Bao da và ốp lưng</a></li>
                            <li><a href="index.php?p=phukien&keyword=dmh">Miếng dán màn hình</a></li>
                            <li><a href="index.php?p=phukien&keyword=sac">Sạc và cáp</a></li>
                            <li><a href="index.php?p=phukien&keyword=sacdp">Sạc dự phòng</a></li>
                        </ul> -->
                    </li>
                    <li><a href="danhmuc/khuyenmai">Khuyến mãi</a></li>
                    <li><a href="danhmuc/tintuc">Tin tức</a></li>
                    <li><a href="danhmuc/lienhe">Liên hệ</a></li>
                    <li id="gh"><a href="danhmuc/gio-hang" style="color:red; font-size: 20px"><img src="images/bags.png" alt="">+<?php echo $_SESSION['sosp'];?></a></li>
                </ul>
                <div class="clear"></div>
            </div>
            <!-- end menu -->
        </div>
    </div>
    <!-- end header-bottom -->
</div>
<script>
    $("document").ready(function($){
    var nav = $('.menu');
    $(window).scroll(function () {
        if ($(this).scrollTop() > 130) {
            nav.addClass("f-nav");
        } else {
            nav.removeClass("f-nav");
        }
    });
});
</script>