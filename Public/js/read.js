$().ready(function(){
    $(".del").click(function(){
        if(confirm("删除后无法恢复，确定删除？")){
            return true;
        }else{
            return false;
        }
    });
    //判断图片大小是否超出div.right的大小，超出的话“缩小”为div.right的100%
    var rightWidth=$(".right").width();
    for (var i = 2; i < $("img").length; i++) {
       if($("img").eq(i).width()>rightWidth){
            $(".acontent img").eq(i-2).css("width","100%");
       }
    }
});