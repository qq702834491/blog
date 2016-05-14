$().ready(function(){
    $("input").eq(3).click(function(){
        if($("input").eq(0).val()==""){
            alert("用户名不能为空");
            return false;
        }
        if($("input").eq(1).val()==""){
            alert("密码不能为空");
            return false;
        }
        if($("input").eq(2).val()==""){
            alert("验证码不能为空");
            return false;
        }
    });
});