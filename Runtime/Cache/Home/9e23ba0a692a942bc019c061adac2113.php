<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manjusaka-博客频道</title>
    <link rel="shortcut icon" href="<?php echo IMG_URL;?>blog.png"/>
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_URL;?>index.css">
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_URL;?>header.css">
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_URL;?>footer.css">
    <link rel="stylesheet" type="text/css" href="/blog/Public/bs/css/bootstrap.min.css">
    <script type="text/javascript" src="/blog/Public/bs/js/jquery.min.js"></script>
    <script type="text/javascript" src="/blog/Public/bs/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/blog/Public/bs/js/datetimepicker.min.js"></script>
    <script type="text/javascript" src="<?php echo JS_URL;?>index.js"></script>
    <link rel="stylesheet" type="text/css" href="/blog/Public/bs/css/datetimepicker.min.css">
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
                <?php if(I('get.id')): ?><li class="pull-left"><a href="/blog/Home/index/index/mode/simple/id/<?php echo I('get.id');?>" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th-list"></span>&nbsp;目录视图</a></li>
                    <li class="pull-left"><a href="/blog/Home/index/index/mode/more/id/<?php echo I('get.id');?>" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;摘要视图</a></li>
                <?php else: ?>
                    <li class="pull-left"><a href="/blog/Home/index/index/mode/simple" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th-list"></span>&nbsp;目录视图</a></li>
                    <li class="pull-left"><a href="/blog/Home/index/index/mode/more" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;摘要视图</a></li><?php endif; ?>
                <?php if(session('login')===1): ?><li class="pull-left"><a href="/blog/Home/CommentDaily/readdaily" class="btn btn-default btn-sm daily"><span class="glyphicon glyphicon-tasks"></span>&nbsp;日常事务</a></li>
                    <li class="pull-left"><a href="/blog/Home/Manger/manger" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-book"></span>&nbsp;管理博客</a></li>
                    <li class="pull-left"><a href="/blog/Home/Manger/newarticle" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-pencil"></span>&nbsp;写新文章</a></li><?php endif; ?>
                    <li class="pull-left"><a href="/blog/Home/CommentDaily/readcomment" class="btn btn-default btn-sm comment"><span class="glyphicon glyphicon-pushpin"></span>&nbsp;留言板</a></li>
                </ul>
                <ul  class="pull-right">
                    <li>
                        <form action="/blog/index.php/home/index/index" method="post" class="form-inline">
                            <div class="form-group">
                                <input class="form-control" type="text" name="search" placeholder="文章搜索">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span>查询</button>
                            </div>
                        </form>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="left">
                    <div class="image text-center">
                        <img src="<?php echo IMG_URL;?>logo.jpg" title="头像" style="width:100px">
                    </div>
                    <div class="bg"></div>
                    <div id="datetimepicker"></div>
                    <div class="bg"></div>
                    <div class="classify">
                        <ul>
                            <li>分类列表：</li>
                            <?php if(I('get.mode')): if(is_array($classify)): foreach($classify as $key=>$v): ?><li>
                                        <a href="/blog/Home/Index/index/id/<?php echo ($v["classify_id"]); ?>/mode/<?php echo I('get.mode');?>"><?php echo ($v["classify_name"]); ?></a>
                                        (<?php echo ($v["num"]); ?>)
                                    </li><?php endforeach; endif; ?>
                                <?php else: ?>                        
                                <?php if(is_array($classify)): foreach($classify as $key=>$v): ?><li>
                                        <a href="/blog/Home/Index/index/id/<?php echo ($v["classify_id"]); ?>"><?php echo ($v["classify_name"]); ?></a>
                                        (<?php echo ($v["num"]); ?>)
                                    </li><?php endforeach; endif; endif; ?>
                        </ul>
                    </div>
                    <div class="bg"></div>
                    <div class="lastestComment">
                        <h5>最近留言：</h5>
                        <?php if(is_array($lastestComment)): foreach($lastestComment as $key=>$lastest): ?><div class="lastestList">
                            <?php if('qq702834491' == $lastest['m_name']): ?><span style="color:red;">博主</span>：<?php echo mb_substr($lastest['content'],0,10,'utf-8');?>
                            <?php else: ?>
                                <?php echo ($lastest["m_name"]); ?>：<?php echo mb_substr($lastest['content'],0,10,'utf-8'); endif; ?>
                                <div class="text-right"><?php echo date("Y-m-d H:i:s",$lastest['s_time']);?></div>
                            </div><?php endforeach; endif; ?>
                        <div class="text-right"><a href="/blog/Home/CommentDaily/readcomment">更多...</a></div>
                    </div>
                </div>
                <div class="right">
                    <div class="list">
                    <?php if(I('get.mode') == 'simple'): if(is_array($article)): foreach($article as $key=>$article): ?><div class="clearfix">
                                <div class="title-simple pull-left"><a href="/blog/Home/Blog/read/id/<?php echo ($article["artical_id"]); ?>"><?php echo ($article["title"]); ?></a></div>
                                <div class="msg">
                                    <?php if(session('login')===1): ?><div class="pull-right"><a href="/blog/Home/Manger/newarticle/id/<?php echo ($article["artical_id"]); ?>">编辑</a>&nbsp;|&nbsp;<a href="/blog/Home/Manger/delarticle/id/<?php echo ($article["artical_id"]); ?>" class="del">删除</a></div><?php endif; ?>
                                    <div class="leibie pull-right">类别：<?php echo ($article["classify_name"]); ?></div>
                                    <div class="time pull-right">发表时间：<?php echo date("Y-m-d H:i:s",$article['s_time']);?></div>
                                </div>
                            </div><?php endforeach; endif; ?>
                    <?php else: ?>
                        <?php if(is_array($article)): foreach($article as $key=>$article): ?><div class="clearfix">
                                <div class="title"><a href="/blog/Home/Blog/read/id/<?php echo ($article["artical_id"]); ?>"><?php echo ($article["title"]); ?></a></div>
                                <div class="main"><?php echo mb_substr(strip_tags(htmlspecialchars_decode($article['content'])),0,100,'utf-8');?></div>
                                <div class="msg">
                                <?php if(session('login')===1): ?><div class="pull-right"><a href="/blog/Home/Manger/newarticle/id/<?php echo ($article["artical_id"]); ?>">编辑</a>&nbsp;|&nbsp;<a href="/blog/Home/Manger/delarticle/id/<?php echo ($article["artical_id"]); ?>" class="del">删除</a></div><?php endif; ?>
                                    <div class="leibie pull-right">类别：<?php echo ($article["classify_name"]); ?></div>
                                    <div class="time pull-right">发表时间：<?php echo date("Y-m-d H:i:s",$article['s_time']);?></div>
                                </div>
                            </div><?php endforeach; endif; endif; ?>
                    </div>
                    <div class="text-center">
                        <?php echo ($page); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer text-center">
    友情链接：<a href="http://blog.csdn.net/u014715974" target="_blank">CSDN博客</a><span>联系方式：yaojun114@foxmail.com</span>
</div>
</body>
</html>