<?php 
namespace Home\Controller;
use Think\Controller;

class BlogController extends Controller{
    //查看博文
    function read(){
        //获取分类列表
        $classify=M("Classify");
        $sql="select a.classify_id,classify_name,ifnull(num,0) as num from classify as a left join(select classify_id,count(*) as num from article group by classify_id) as b on a.classify_id=b.classify_id order by a.classify_id";
        $this->classify=$classify->query($sql);
        //文章具体内容
        $article=M("Article");
        $article_id=I("get.id");
        $sql="select artical_id,title,content,s_time,ifnull(classify_name,'分类已被删除') as classify_name from classify as a right join article as b on a.classify_id=b.classify_id where artical_id='$article_id'";
        $this->article=$article->query($sql);
        $this->display();
    }


}


 ?>