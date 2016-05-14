$().ready(function(){
    //readdaily.html的js
    $(".readdaily").click(function(){
        var content=$(".m_content").val();
        if(content==""){
            alert("请输入内容");
            return false;
        }else{
            $.post('/blog/Home/CommentDaily/daily', {content: content}, function(data) {
                if(data['success']===true){
                    $(".m_content").val('');
                    $(".content_list").prepend('<div class="d_list"><div class="d_content">'+content+'</div><div class="pull-right del"><a href="javascript:;" class="del'+data['id']+'">删除</a></div><div class="pull-right">'+data['s_time']+'</div></div>');
                    $(".del a").click(function(e){
                        var id=$(e.target).attr("class").substring(3);
                        if(confirm("确定要删除此数据吗？")){
                            $.post('del', {id: id}, function(data) {
                                if(data===true){
                                    $(e.target).parents(".d_list").remove();        //删除该组数据
                                }else{
                                    alert(data);
                                }
                            });
                        }
                    });
                }else{
                    alert(data['error']);   //输出错误信息
                }
            });
        }
    });
    //readcomment.html的js
    //reset button的功能
    $(".reset").click(function(){
        $(".m_content").val('');
    });
    //提交按钮功能
    $(".readcomment").click(function(){
        var m_name = $(".m_name").val();
        var content = $(".m_content").val();
        if(m_name==""){
            alert("请输入用户名");
            return false;
        }
        if(content==""){
            alert("请输入内容");
            return false;
        }
        $.post('/blog/Home/CommentDaily/comment', 
            {m_name: m_name,content:content}, function(data) {
                if(data['success']===true){
                    $(".m_content").val('');
                    if(data['login']){          //登录了的情况
                        $(".content_list").prepend('<div class="d_list"><div class="d_content">'+content+'</div><div class="pull-right del"><a href="javascript:;" class="del'+data['id']+'">删除</a></div><div class="pull-right">'+data['s_time']+'</div><div class="pull-right">留言者：<span style="color:red;">博主</span></div></div>');
                    }else{                      //未登录
                        $(".content_list").prepend('<div class="d_list"><div class="d_content">'+content+'</div><div class="pull-right">'+data['s_time']+'</div><div class="pull-right">留言者：'+m_name+'</div></div>');
                    }
                    $(".del a").click(function(e){
                        var id=$(e.target).attr("class").substring(3);
                        if(confirm("确定要删除此数据吗？")){
                            $.post('del', {id: id}, function(data) {
                                if(data===true){
                                    $(e.target).parents(".d_list").remove();        //删除该组数据
                                }else{
                                    alert(data);
                                }
                            });
                        }
                    });
                }else{
                    alert(data['error']);
                }
        });
    });

    count=new Array();
    //回复功能
    $(".reply a").click(function(e){
        var id=$(e.target).attr("class").substring(5);
        if("undefined" == typeof count[id]){
            count[id]=0;
        }
        if(count[id]==0){
            $(e.target).parents(".d_list").append('<form method="post" action="/blog/Home/CommentDaily/reply"><div class="form-group"><input type="hidden" name="pid" value="'+id+'"><textarea name="content" class="form-control" placeholder="请输入内容"></textarea></div><div class="form-group"><button type="submit" class="btn btn-primary btn-sm">发送</button></div></form>');
            //判空
            $("button").click(function(){
                var content=$('form textarea').val();
                if(content==""){
                    alert("请输入内容");
                    $("form textarea").focus();
                    return false;
                }
            });
            $(e.target).html("收起");
            count[id]++;
        }else if(count[id]==1){
            $(e.target).parents(".d_list").children('form').remove();
            $(e.target).html("回复");
            count[id]--;
        }

    });
    //去除没有内容的div
    for (var i = 0; i < $(".r_list").length; i++) {
        if($(".r_list").eq(i).children('.r_content').length==0){
            $(".r_list").eq(i).remove();
            i--;
        }
    }
    
    //添加datetimepicker日历插件
    $("#datetimepicker").datetimepicker({
        todayHighlight:true,
    });
    $(".day").click(function(){
        return false;
    });
    $(".prev").click(function(){
        return false;
    });
    $(".next").click(function(){
        return false;
    });
    $(".switch").click(function(){
        return false;
    });
});


