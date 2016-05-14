$().ready(function(){
    $(".del").click(function(){
        if(confirm("删除博文无法恢复，请慎重")){
            return true;
        }else{
            return false;
        }
    });
});