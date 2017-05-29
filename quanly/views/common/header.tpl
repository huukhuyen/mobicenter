<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="css/smothness/jquery_ui_datepicker.css" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <link href="css/tab.css" rel="stylesheet" type="text/css" />
    <link href="css/highslide.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/jquery-ui.css" />
    <script src="js/jquery.min.js" language="javascript"></script>
    <script src="js/marketing-online.js" language="javascript"></script>
    <link rel="stylesheet" type="text/css" href="css/jquery.alerts.css" media="screen" />
    <script type="text/javascript" src="js/jquery.alerts.js"></script>
    <script type="text/javascript" src="js/jquery.jcookie.min.js"></script>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui.js"></script>
    <script>
    BASE_URL = '<?php echo BASE_URL;?>';
    </script>
</head>

<body>
    <center>
        <div class="main_top">
        </div>
        <!-- MAIN MIDDLE -->
        <div class="main_middle">
            <div style="width: 100%">
                <!-- MAIN-MIDDLE-TOP-->
                <div class="main_middle_top">
                    <div style="float:left; width:907px; height:105px; margin-left:30px;">
                        <img src="images/logo-admin.png" height="97" width="203" style="float:left; margin-top: 6px">
                    </div>
                </div>
                <!-- MAIN-MIDDLE-HEAD -->
                <div class="headmenu">
                    <div class="middle">
                        <ul id="menu">
                            <li>
                                <!--[if lte IE 6]></td></tr></table></a><![endif]-->
                            </li>
                            <li><span style="font-size: 15px; text-transform: uppercase">Quản lý chung</span>
                                <!--[if lte IE 6]><a href="#nogo"><table><tr><td><![endif]-->
                                <dl>
                                    <dt><a href="#" style="font-size: 15px; text-transform: uppercase">Quản lý chung</a></dt>
                                    <dd class="first">
                                        <a href="<?php echo ADMIN_URL;?>index.php?module=Logs&act=ViewPagingList">Truy vấn Logs</a></dd>
                                    <dd>
                                        <a href="<?php echo ADMIN_URL;?>index.php?module=Member">Quản lý thành viên</a></dd>
                                    <dd>
                                        <a href="<?php echo ADMIN_URL;?>index.php?module=Member&act=Password">Đổi mật khẩu</a></dd>
                                </dl>
                                <!--[if lte IE 6]></td></tr></table></a><![endif]-->
                            </li>
                            <li><span style="font-size: 15px; text-transform: uppercase">Quản lý bài viết</span>
                                <dl>
                                    <dt><a href="index.php?module=CmsCategories" style="font-size: 15px; text-transform: uppercase">Quản lý bài viết</a></dt>
                                    <dd><a href="index.php?module=CmsCategories">Quản lý danh mục bài viết</a></dd>
                                    <dd><a href="index.php?module=Cms">Quản lý bài viết</a></dd>
                                    <dd><a href="index.php?module=Page">Quản lý trang</a></dd>
                                </dl>
                                <!--[if lte IE 6]></td></tr></table></a><![endif]-->
                            </li>
                            <li><span style="font-size: 15px; text-transform: uppercase">Quản lý sản phẩm</span>
                                <dl>
                                    <dt><a href="index.php?module=Product" style="font-size: 15px; text-transform: uppercase">Quản lý sản phẩm</a></dt>
                                    <dd><a href="index.php?module=ProductCategories">Quản lý danh mục sản phẩm</a></dd>
                                    <dd><a href="index.php?module=Product">Quản lý sản phẩm</a></dd>
                                </dl>
                                <!--[if lte IE 6]></td></tr></table></a><![endif]-->
                            </li>
                            <li><span style="font-size: 15px; text-transform: uppercase">Liên kết Website</span>
                                <dl>
                                    <dt><a href="<?php echo ADMIN_URL;?>index.php?module=Links" style="font-size: 15px; text-transform: uppercase">Liên kết Website</a></dt>
                                    <dd><a href="<?php echo ADMIN_URL;?>index.php?module=Links&act=Insert">Thêm URL liên kết</a></dd>
                                </dl>
                            </li>
                            <li><span style="font-size: 15px; text-transform: uppercase">Thư viện Tài Nguyên</span>
                                <!--[if lte IE 6]><a href="#nogo"><table><tr><td><![endif]-->
                                <dl>
                                    <dt><a href="#" style="font-size: 15px; text-transform: uppercase">Thư viện Tài Nguyên</a></dt>
                                    <dd class="first">
                                        <a href="<?php echo ADMIN_URL;?>index.php?module=Picture">Album hình ảnh</a></dd>
                                    <dd>
                                        <a href="<?php echo ADMIN_URL;?>index.php?module=PictureCategories">Danh mục ảnh</a></dd>
                                    <dd>
                                        <a href="<?php echo ADMIN_URL;?>index.php?module=Video">Video Clip</a></dd>
                                    <dd>
                                        <a href="<?php echo ADMIN_URL;?>index.php?module=VideoCategories">Danh mục Video Clip</a></dd>
                                </dl>
                                <!--[if lte IE 6]></td></tr></table></a><![endif]-->
                            </li>
                        </ul>
                        <ul id="menu2">
                            <?php 
                            if (isset($_SESSION['logged'])) 
                            { 
                            ?>
                                <li><a href="index.php?module=Login&act=Logout">[<font style="color:red"><?php echo $_SESSION['username']?></font>] Đăng xuất</a> </li>
                                <?php 
                            } 
                            else 
                            { 
                            ?>
                                    <li><a href="index.php?module=Login">Đăng nhập</a> </li>
                                    <?php 
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="highslide-maincontent">
                </div>
                <!-- MAIN-MIDDLE-SHADOW-->
                <div class="main_middle_shadow">
                </div>
                <!--MAIN-MIDDLE -->
                <div class="main_small clearfix">
                    <!--MAIN-LEFT-->
                    <!--MAIN-RIGHT-->
                    <div class="main_full">
                        <div id="messageSession" style="text-align:center;">
                            <?php 
                            if(isset($message) && $message != null || $_SESSION['message'] != null)
                            {
                            ?>
                                <dl id="system-message">
                                    <dt class="message"></dt>
                                    <dd class="<?php echo $messageType ? $messageType : $_SESSION['messageType'];?> fade">
                                        <ul>
                                            <li>
                                                <?php echo $message ? $message : $_SESSION['message'];?>
                                            </li>
                                        </ul>
                                    </dd>
                                </dl>
                                <?php 
                            }
                            ?>
                        </div>
