<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manjusaka-博客频道</title>
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_URL;?>read.css">
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_URL;?>header.css">
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_URL;?>footer.css">
    <link rel="stylesheet" type="text/css" href="/blog/Public/bs/css/bootstrap.min.css">
    <script type="text/javascript" src="/blog/Public/bs/js/jquery.min.js"></script>
    <script type="text/javascript" src="/blog/Public/bs/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo JS_URL;?>read.js"></script>
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
    <div class="body">
        <div class="container content">
            <div class="row nav">
                <ul class="pull-left">
                    <li class="pull-left"><a href="/blog/index.php/home/Index/index/mode/simple" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th-list"></span>目录视图</a></li>
                    <li class="pull-left"><a href="/blog/index.php/home/Index/index/mode/more" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-list-alt"></span>摘要视图</a></li>
                <?php if(session('login')===1): ?><li class="pull-left"><a href="/blog/index.php/home/Manger/manger" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-book"></span>管理博客</a></li>
                    <li class="pull-left"><a href="/blog/index.php/home/Manger/newarticle" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-pencil"></span>写新文章</a></li><?php endif; ?>
                </ul>
            </div>
            <div class="row">
                <div class="left">
                    <div class="image text-center">
                        <img src="<?php echo IMG_URL;?>logo.jpg" title="头像">
                    </div>
                    <div class="bg"></div>
                    <div class="classify">
                        <ul>
                            <li>分类列表：</li>
                            <?php if(is_array($classify)): foreach($classify as $key=>$v): ?><li><a href="/blog/index.php/home/Index/index/id/<?php echo ($v["classify_id"]); ?>"><?php echo ($v["classify_name"]); ?></a>(<?php echo ($v["num"]); ?>)</li><?php endforeach; endif; ?>
                        </ul>
                    </div>
                </div>
                <div class="right container">
                    <?php if(is_array($article)): foreach($article as $key=>$v): ?><div class="title"><h2><?php echo ($v["title"]); ?></h2></div>
                        <div class="time pull-right">
                            <?php if(session('login')===1): ?><a href="/blog/index.php/home/Manger/newarticle/id/<?php echo ($v["artical_id"]); ?>" class="modify">编辑</a>|<a href="/blog/index.php/home/Manger/delarticle/id/<?php echo ($v["artical_id"]); ?>" class="del">删除</a><?php endif; ?>
                            发表时间：<?php echo date("Y-m-d H:i:s",$v['s_time']);?>
                        </div>
                        <div class="cname pull-left">所属分类：<?php echo ($v["classify_name"]); ?></div>
                        <div class="acontent pull-left"><?php echo htmlspecialchars_decode($v['content']);?></div><?php endforeach; endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="footer text-center">
    友情链接：<a href="http://blog.csdn.net/u014715974" target="_blank">CSDN博客</a><span>联系方式：yaojun114@foxmail.com</span>
</div>
</body>
</html>