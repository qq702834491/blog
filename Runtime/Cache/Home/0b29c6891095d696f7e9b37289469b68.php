<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manjusaka-博客频道</title>
    <link rel="shortcut icon" href="<?php echo IMG_URL;?>blog.png"/>
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_URL;?>commentdaily.css">
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_URL;?>header.css">
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_URL;?>footer.css">
    <link rel="stylesheet" type="text/css" href="/blog/Public/bs/css/bootstrap.min.css">
    <script type="text/javascript" src="/blog/Public/bs/js/jquery.min.js"></script>
    <script type="text/javascript" src="/blog/Public/bs/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo JS_URL;?>commentdaily.js"></script>
    <script type="text/javascript" src="/blog/Public/bs/js/datetimepicker.min.js"></script>
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
            </div>
            <div class="row">
                <div class="left">
                    <div class="image text-center">
                        <img src="<?php echo IMG_URL;?>logo.jpg" title="头像" style="width:100px">
                    </div>
                    <div class="bg"></div>
                    <div id="datetimepicker"></div>
                </div>
                <div class="right">
                    <div class="list">
                        <div class="topList">
                            <?php if(is_array($top)): foreach($top as $key=>$topList): ?><div class="beTopList">
                                    <div class="d_content">置顶：<?php echo ($key); ?></div>
                                    <div class="pull-right"><?php echo date("Y-m-d H:i:s",$topList);?></div>
                                </div><?php endforeach; endif; ?>
                        </div>
                        <div class="content_list">
                            <?php if(is_array($commentList)): foreach($commentList as $key=>$v): ?><div class="d_list">
                                    <div class="d_content"><?php echo ($v["content"]); ?></div>
                                    <?php if(session('login')===1): ?><div class="pull-right del"><a href="javascript:;" class="del<?php echo ($v["m_id"]); ?>">删除</a></div>
                                        <div class="pull-right reply"><a href="javascript:;" class="reply<?php echo ($v["m_id"]); ?>">回复</a></div>
                                        <div class="pull-right betop"><a href="/blog/Home/CommentDaily/betop/id/<?php echo ($v["m_id"]); ?>">置顶</a></div><?php endif; ?>
                                    <div class="pull-right"><?php echo date("Y-m-d H:i:s",$v['s_time']);?></div>
                                    <div class="pull-right">留言者：
                                        <?php if($v['m_name'] == 'qq702834491'): ?><span style="color:red;">博主</span>
                                        <?php else: ?>
                                            <?php echo ($v["m_name"]); endif; ?>
                                    </div>
                                    <div class="r_list">
                                        <?php if(is_array($reply)): foreach($reply as $key=>$rep): if($rep['pid'] == $v['m_id']): ?><div class="r_content">
                                                    <span class="replyname">
                                                        <?php if($rep['m_name'] == 'qq702834491'): ?>博主<?php endif; ?>
                                                    </span>:
                                                    <span class="replycontent"><?php echo ($rep["content"]); ?></span>
                                                    <?php if(session('login')===1): ?><span class="pull-right redel"><a href="javascript:;" class="del<?php echo ($rep["m_id"]); ?>">删除</a></span><?php endif; ?>
                                                    <span class="pull-right"><?php echo date("Y-m-d H:i:s",$rep['s_time']);?></span>
                                                </div><?php endif; endforeach; endif; ?>
                                    </div>
                                </div><?php endforeach; endif; ?>
                            <div class="text-center"><?php echo ($page); ?></div>
                        </div>
                        <div class="form-group col-md-3 col-md-offset-3">
                            <?php if(session('login')===1): ?><input type="text" name="m_name" class="form-control m_name" value="<?php echo session('user');?>" readonly="readonly">
                            <?php else: ?>
                                <input type="text" name="m_name" class="form-control m_name" placeholder="请输入用户名"><?php endif; ?>
                        </div>
                        <div class="form-group col-md-6 col-md-offset-3">
                            <textarea name="content" rows="5" placeholder="请输入留言内容" class="form-control m_content"></textarea>
                        </div>
                        <div class="form-group col-md-3 col-md-offset-3">
                            <button class="btn btn-primary btn-sm readcomment">发表</button>
                            <button class="btn btn-warning btn-sm reset">清空内容</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer text-center">
    友情链接：<a href="http://blog.csdn.net/u014715974" target="_blank">CSDN博客</a><span>联系方式：yaojun114@foxmail.com</span>
</div>
</body>
<script type="text/javascript">
$(".del a").click(function(e){
    var id=$(e.target).attr("class").substring(3);
    if(confirm("确定要删除此数据吗？")){
        $.post('/blog/Home/CommentDaily/del', {id: id}, function(data) {
            if(data===true){
                $(e.target).parents(".d_list").remove();        //删除该组数据
            }else{
                alert(data);
            }
        });
    }
});
$(".redel a").click(function(e){
    var id=$(e.target).attr("class").substring(3);
    if(confirm("确定要删除此数据吗？")){
        $.post('/blog/Home/CommentDaily/del', {id: id}, function(data) {
            if(data===true){
                $(e.target).parents(".r_content").remove();        //删除该组数据
            }else{
                alert(data);
            }
        });
    }
});
</script>
</html>