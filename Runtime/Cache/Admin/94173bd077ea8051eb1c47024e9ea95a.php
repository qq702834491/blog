<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manjusaka-个人博客登录入口</title>
    <link rel="shortcut icon" href="<?php echo IMG_URL;?>blog.png"/>
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_URL;?>login.css">
    <link rel="stylesheet" type="text/css" href="/blog/Public/bs/css/bootstrap.min.css">
    <script type="text/javascript" src="/blog/Public/bs/js/jquery.min.js"></script>
    <script type="text/javascript" src="/blog/Public/bs/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo JS_URL;?>login.js"></script>
</head>
<body>
    <div class="container header">
        <a href="/blog/index.php/Home/Index/index"><img src="<?php echo IMG_URL;?>logo.png"></a>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4 login">
            <h3>个人博客登录</h3>
            <hr>
            <form method="post" action="/blog/Admin/Login/login">
                <div class="form-group">
                    <input type="text" name="username" class="form-control" placeholder="用户名">
                </div>
                <div class="form-group">
                    <input type="password" name="pwd" class="form-control" placeholder="密码">
                </div>
                <div class="form-group row">
                    <div class="col-md-8">
                        <input type="text" name="vcode" class="form-control" placeholder="验证码">
                    </div>
                    <div class="col-md-4">
                        <img src="/blog/index.php/Admin/Login/verify" onclick="this.src='/blog/index.php/Admin/Login/verify?'+Math.random()">
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" value="登录" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</body>
</html>