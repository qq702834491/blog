<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>编辑文章-博客频道</title>
    <link rel="shortcut icon" href="<?php echo IMG_URL;?>blog.png"/>
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_URL;?>header.css">
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_URL;?>nav.css">
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_URL;?>footer.css">
    <link rel="stylesheet" type="text/css" href="/blog/Public/bs/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_URL;?>newarticle.css">
    <script type="text/javascript" src="/blog/Public/bs/js/jquery.min.js"></script>
    <script type="text/javascript" src="/blog/Public/bs/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/blog/Public/bs/js/holder.min.js"></script>
    <script type="text/javascript" src="/blog/Public/js/nav.js"></script>
    <!-- 配置文件 -->
    <script type="text/javascript" src="/blog/Public/ueditor/ueditor.config.js"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="/blog/Public/ueditor/ueditor.all.min.js"></script>
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
        <form method="post" action="/blog/Home/Blog/newarticle" class="form-horizontal">
            <input type="hidden" name="id" value="<?php echo ($_GET['id']); ?>">
            <div class="form-group">
                <label for="title" class="col-md-2 control-label">文章标题</label>
                <div class="col-md-9">
                    <input type="text" name="title" id="title" class="form-control" value="<?php echo ($article["title"]); ?>">
                </div>
            </div>
            <div class="form-group">
                <div id="container" name="content" class="col-md-10 col-md-offset-1"></div>
            </div>
            <div class="form-group">
                    <label for="classify" class="col-md-2 control-label">选择分类：</label>
                <?php if($name == null): ?><label class="control-label">目前没有分类，请<a href="/blog/Home/Blog/classify">添加</a></label>
                <?php else: ?>
                    <div class="col-md-2">
                        <select id="classify" class="form-control" name="classify_id">
                            <?php if(is_array($name)): foreach($name as $key=>$v): ?><option value="<?php echo ($key); ?>"><?php echo ($v); ?></option><?php endforeach; endif; ?>
                        </select>
                    </div><?php endif; ?>
            </div>
            <div class="form-group">
                <div class="col-md-2 col-md-offset-5">
                    <input type="submit" value="发表博客" class="submit form-control btn btn-primary">
                </div>
            </div>
        </form>
    </div>
    <div class="bg"></div>
    <div class="footer text-center">
    友情链接：<a href="http://blog.csdn.net/u014715974" target="_blank">CSDN博客</a><span>联系方式：yaojun114@foxmail.com</span>
</div>
</body>
<script type="text/javascript">
    var ue = UE.getEditor('container',{
        toolbars: [
        [ 'bold','italic','underline','indent','horizontal','undo', 'redo','fontfamily','fontsize','simpleupload','insertimage','emotion','help','justifyleft','justifyright','justifycenter','justifyjustify','forecolor','backcolor', ],
        ['fullscreen', 'source', 'lineheight', 'autotypeset', 'inserttable',]
        ],
        initialFrameHeight:'400'
    });
    ue.ready(function(){
        ue.setContent('<?php echo htmlspecialchars_decode($article['content']);?>');
    });
    
    $().ready(function(){
        $("#classify").val("<?php echo ($article["classify_id"]); ?>");
        $(".submit").click(function(){
            var title=$("#title").val();
            var content=ue.getContentTxt();
            var classify=$("#classify").val();
            if(title==""){
                alert("标题不能为空");
                return false;
            }
            if(content==""){
                alert("请输入内容");
                return false;
            }
            if(typeof(classify)=="undefined"){
                alert("请先选择分类");
                return false;
            }
        });
    });

</script>
</html>