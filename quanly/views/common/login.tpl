<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="css/login-bt.css" rel="stylesheet" type="text/css" />
    <link REL="SHORTCUT ICON" HREF="images/favicon.ico">
    <title>Administrator</title>
    <script src="js/jquery-1.10.2.min.js" language="javascript"></script>
    <script src="js/bootstrap.min.js" language="javascript"></script>
    <script src="js/login.js" language="javascript"></script>
</head>

<body>
    <div class="login-body">
        <article class="container-login center-block">
            <section>
                <div class="tab-content tabs-login col-lg-12 col-md-12 col-sm-12 cols-xs-12">
                    <div id="login-access" class="tab-pane fade active in">
                        <h3 style="color: #ea533f; text-align: center; text-transform: uppercase"><i class="glyphicon glyphicon-log-in"></i> Đăng nhập quản trị</h3>
                        <div style="margin-top:5px; margin-bottom:-5px; color: red;" id="loading">
			                <p><?php if ($messageExist == true) echo $message; ?></p>
			            </div>
                        <form action="index.php?module=Login" method="POST" autocomplete="off" role="form" class="form-horizontal">
                            <div class="form-group ">
                                <label for="login" class="sr-only">Username</label>
                                <input type="text" class="form-control" name="username" id="username" placeholder="Username" tabindex="1" value="" />
                            </div>
                            <div class="form-group ">
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="" tabindex="2" />
                            </div>
                            <div class="form-group ">
                                <button type="submit" id="login" tabindex="5" class="btn btn-lg btn-primary">Đăng nhập</button>
                                <button type="reset" tabindex="5" class="btn btn-lg btn-primary">Viết lại</button>
                            </div>
                        </form>
                        <p style="text-align: center">© 2015</p>
                    </div>
                </div>
            </section>
        </article>
    </div>
</body>

</html>
