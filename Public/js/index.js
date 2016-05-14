$().ready(function(){
    //删除确认
    $(".del").click(function(){
        if(confirm("删除后无法恢复，是否删除？")){
            return true;
        }else{
            return false;
        }
    });
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


