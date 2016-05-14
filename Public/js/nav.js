$().ready(function(){
    $(".nav li").mouseover(function(){
        $(this).css({
            'box-shadow': '1px 1px 1px'
        });
    });
    $(".nav li").mouseleave(function(){
        $(this).css({
            'box-shadow': '3px 3px 3px'
        });
    });
});