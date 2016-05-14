<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>文章列表-博客频道</title>
    <link rel="shortcut icon" href="<?php echo IMG_URL;?>blog.png"/>
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_URL;?>header.css">
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_URL;?>footer.css">
    <link rel="stylesheet" type="text/css" href="/blog/Public/bs/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_URL;?>manger.css">
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_URL;?>nav.css">
    <script type="text/javascript" src="/blog/Public/bs/js/jquery.min.js"></script>
    <script type="text/javascript" src="/blog/Public/bs/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/blog/Public/bs/js/holder.min.js"></script>
    <script type="text/javascript" src="/blog/Public/js/nav.js"></script>
    <script type="text/javascript" src="<?php echo JS_URL;?>manger.js"></script>
</head>
<body>
    <div class="header">
    <div class="container top">
        <ul class="pull-left">
            <li class="pull-left"><a href="/blog/Home/Index/index" class="logo_link"><img src="<?php echo IMG_URL;?>logo.png"></a></li>
        </ul>
        <ul class="pull-right">
            <?php if(session('login')===1): ?><li class="pull-left">欢迎<?php echo session('user');?>登录&nbsp;&nbsp;&nbsp;<a href="/blog/index.php/home/Index/logout">退出</a></li><?php endif; ?>
        </ul>
    </div>
</div>
    <div class="bg"></div>
    <div class="container content">
        <div class="nav">
    <ul class="pull-left">
        <a href="/blog/Home/Manger/manger"><li class="pull-left">文章管理</li></a>
        <a href="/blog/Home/Manger/classify"><li class="pull-left">类别管理</li></a>
        <a href="/blog/Home/Manger/newarticle"><li class="pull-left">写新文章</li></a>
    </ul>
</div>
        <table class="table table-hover table-condensed table-striped table-bordered">
            <tr>
                <th class="text-center">标题</th>
                <th class="text-center">操作</th>
            </tr>
        <?php if(is_array($list)): foreach($list as $key=>$v): ?><tr>
                <td class="title"><a href="/blog/Home/Blog/read/id/<?php echo ($v["artical_id"]); ?>"><?php echo ($v["title"]); ?></a>(<?php echo date("Y-m-d H:i:s",$v['s_time']);?>)</td>
                <td class="text-center">
                    <a href="/blog/Home/Blog/newarticle/id/<?php echo ($v["artical_id"]); ?>">编辑</a>
                    <a href="/blog/Home/Blog/delarticle/id/<?php echo ($v["artical_id"]); ?>" class="del">删除</a>
                </td>
            </tr><?php endforeach; endif; ?>
        </table>
        <div class="text-center"><?php echo ($page); ?></div>
    </div>
    <div class="bg"></div>
    <div class="footer text-center">
    友情链接：<a href="http://blog.csdn.net/u014715974" target="_blank">CSDN博客</a><span>联系方式：yaojun114@foxmail.com</span>
</div>
</body>
</html>