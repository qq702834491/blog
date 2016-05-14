$().ready(function(){

    //添加类别
    $("#classify").click(function(){
        var classify_name=$("#classify_name").val();        //获取输入框内容
        $("#classify_name").val("");            // 清空输入框内容
        if(classify_name===""){
            alert("类别名称不能为空");
            return false;
        }else{
            $.post("addClassify",
                {"classify_name":classify_name},
                function(date){
                    if(date[0]==0){                 //=0表示类名已存在
                        alert(date[1]);
                    }else if(date[0]==1){           //=1表示添加成功并返回分类名称 ， 用表格形式返回
                        $(".table").append("<tr class=\"tr"+date[2]+"\"><td class='name"+date[2]+"'>"+date[1]+"</td><td class=\"text-center\">0</td><td class=\"text-center\"><a onclick=\"edit("+date[2]+")\" href=\"#\">编辑</a>|<a onclick=\"del("+date[2]+")\">删除</a></td></tr>");
                    }
                });
        }
    });
});

//编辑   
function edit(id){
    var name=$(".name"+id).html();
    if(name.indexOf('input')<0){
        $(".name"+id).html("<input type='text' value='"+name+"'/>&nbsp;<a href='javascript:;' class='save' onclick='save("+id+")'>保存</a>&nbsp;<a href='javascript:;' class='cancle' onclick='cancle("+id+")'>取消</a>");
    }
}

//保存
function save(id){
    var value=$(".name"+id+" input").val();
    if(value===""){
        alert("类别名称不能为空");
        return false;
    }else{
        $.post("modify",{
            "classify_name":value,
            "classify_id":id},
            function(date){
                if(date=="ok"){
                    $(".name"+id).html($(".name"+id+" input").val());
                }else{
                    alert(date);
                }
            });
    }
}

//取消
function cancle(id){
    $(".name"+id).html($(".name"+id+" input").val());
}

//删除
function del(id){
    if(confirm("确定要删除此类别吗？")){
        $.post("delete",
            {"classify_id":id},
            function(date){
                if(date=="ok"){
                    $(".tr"+id).remove();
                }else{
                    alert("删除失败");
                }
            });
        
    }
}