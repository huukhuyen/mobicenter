<?php session_start();?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="../Content/css/bootstrap.min.css">
    <style type="text/css" media="screen">
    .navbar-brand {
        position: relative;
        z-index: 2;
    }
    
    .navbar-nav.navbar-right .btn {
        position: relative;
        z-index: 2;
        padding: 4px 20px;
        margin: 10px auto;
        transition: transform 0.3s;
    }
    
    .navbar .navbar-collapse {
        position: relative;
        overflow: hidden !important;
    }
    
    .navbar .navbar-collapse .navbar-right > li:last-child {
        padding-left: 22px;
    }
    
    .navbar .nav-collapse {
        position: absolute;
        z-index: 1;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        margin: 0;
        padding-right: 120px;
        padding-left: 80px;
        width: 100%;
    }
    
    .navbar.navbar-default .nav-collapse {
        background-color: #f8f8f8;
    }
    
    .navbar.navbar-inverse .nav-collapse {
        background-color: #0084ff;
    }
    
    .navbar .nav-collapse .navbar-form {
        box-shadow: none;
    }
    
    .nav-collapse>li {
        float: right;
    }
    
    .btn.btn-circle {
        border-radius: 30px;
    }
    
    .btn.btn-outline {
        background-color: transparent;
    }
    
    .navbar-nav.navbar-right .btn:not(.collapsed) {
        background-color: rgb(111, 84, 153);
        border-color: rgb(111, 84, 153);
        color: rgb(255, 255, 255);
    }
    
    .navbar.navbar-default .nav-collapse,
    .navbar.navbar-inverse .nav-collapse {
        height: auto !important;
        transition: transform 0.3s;
        transform: translate(0px, -50px);
    }
    
    .navbar.navbar-default .nav-collapse.in,
    .navbar.navbar-inverse .nav-collapse.in {
        transform: translate(0px, 0px);
    }
    
    @media screen and (max-width: 767px) {
        .navbar .navbar-collapse .navbar-right > li:last-child {
            padding-left: 15px;
            padding-right: 15px;
        }
        .navbar .nav-collapse {
            margin: 7.5px auto;
            padding: 0;
        }
        .navbar .nav-collapse .navbar-form {
            margin: 0;
        }
        .nav-collapse>li {
            float: none;
        }
        .navbar.navbar-default .nav-collapse,
        .navbar.navbar-inverse .nav-collapse {
            transform: translate(-100%, 0px);
        }
        .navbar.navbar-default .nav-collapse.in,
        .navbar.navbar-inverse .nav-collapse.in {
            transform: translate(0px, 0px);
        }
        .navbar.navbar-default .nav-collapse.slide-down,
        .navbar.navbar-inverse .nav-collapse.slide-down {
            transform: translate(0px, -100%);
        }
        .navbar.navbar-default .nav-collapse.in.slide-down,
        .navbar.navbar-inverse .nav-collapse.in.slide-down {
            transform: translate(0px, 0px);
        }
    }
    </style>
</head>

<body>
    <nav class="navbar navbar-inverse" style="border-radius: 0px; border:none; background: linear-gradient(#0084ff, #006fff); ">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-3">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="#"><img src="../images/add2.png" width="35px" style="margin:8px 0px 3px 0px" alt=""><span style="font-size: 20px; color:#FFF; padding: 5px"><?php echo"Đã đặt ".$_SESSION['sosp']; ?> sp</span></a>

            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse-3">
                <ul class="nav navbar-nav navbar-right" style="color:#FFF!important">
                    <li><a style="color:#FFF!important" href="#">GIỚI THIỆU</a></li>
                    <li><a style="color:#FFF!important" href="index.php?p=dienthoai">ĐIỆN THOẠI</a></li>
                    <li><a style="color:#FFF!important" href="index.php?p=ipad">IPAD</a></li>
                    <li><a style="color:#FFF!important" href="index.php?p=iphone">IPHONE</a></li>
                    <li><a style="color:#FFF!important" href="index.php?p=laptop">LAPTOP</a></li>
                    <li><a style="color:#FFF!important" href="index.php?p=phukien">PHỤ KIỆN</a></li>
                    <li><a style="color:#FFF!important" href="index.php?p=tintuc">TIN TỨC</a></li>
                    <li><a style="color:#FFF!important" href="#">LIÊN HỆ</a></li>
                    <li>
                        <a style="color:#0084ff!important; background:#FFF" class="btn btn-default btn-outline btn-circle collapsed" data-toggle="collapse" href="#nav-collapse3" aria-expanded="false" aria-controls="nav-collapse3">Tìm kiếm</a>
                    </li>
                </ul>
                <div class="collapse nav navbar-nav nav-collapse slide-down" id="nav-collapse3">
                    <form class="navbar-form navbar-right" role="search">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Bạn muốn mua gì..." />
                        </div>
                        <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
    <!-- /.navbar -->
    <script type="text/javascript" src="../Content/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="../Content/js/bootstrap.min.js"></script>
</body>

</html>
