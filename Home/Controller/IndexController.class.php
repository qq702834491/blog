<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        //获取分类表
        $classify=M("Classify");
        $sql="select a.classify_id,classify_name,ifnull(num,0) as num from classify as a left join(select classify_id,count(*) as num from article group by classify_id) as b on a.classify_id=b.classify_id order by a.classify_id";
        $this->classify=$classify->query($sql);
        $classify_id=I("get.id");
        // $article=M("Article");
        if(!$_POST){        //没有搜索内容（文章搜索功能）
            if($classify_id==null){
                $count = $classify->join("article as b on classify.classify_id=b.classify_id",'right')->count();
                $Page = new \Think\Page($count,15);      // 实例化分页类 传入总记录数和每页显示的记录数(15)
                // 获取文章表
                $this->article=$classify->join("article as b on classify.classify_id=b.classify_id",'right')->order("s_time desc")->limit($Page->firstRow.','.$Page->listRows)->getField('artical_id,title,content,s_time,classify_name');
            }else{              // 按类别分类的文章表
                // 查询满足要求的总记录数
                $count = $classify->join("article as b on classify.classify_id=b.classify_id")->where("b.classify_id='$classify_id'")->count();
                $Page = new \Think\Page($count,15);      // 实例化分页类 传入总记录数和每页显示的记录数(15)
                $this->article=$classify->join("article as b on classify.classify_id=b.classify_id")->where("b.classify_id='$classify_id'")->order("s_time desc")->limit($Page->firstRow.','.$Page->listRows)->getField('artical_id,title,content,s_time,classify_name');
            }
        }else{      //输入了搜索内容
            $search=I("post.search");
            if($search==""){            // 查询满足要求的总记录数
                $count = $classify->join("article as b on classify.classify_id=b.classify_id",'right')->count();
                $Page = new \Think\Page($count,15);      // 实例化分页类 传入总记录数和每页显示的记录数(15)
                $this->article=$classify->join("article as b on classify.classify_id=b.classify_id",'right')->order("s_time desc")->limit($Page->firstRow.','.$Page->listRows)->getField('artical_id,title,content,s_time,classify_name');
            }else{
                $count = $classify->join("article as b on classify.classify_id=b.classify_id",'right')->where("title like '%$search%' or content like '%$search%'")->count();
                $Page = new \Think\Page($count,50);      
                // 这里有一个bug，点击下一页$_post['search']会变为空，暂时将分页内容变大，令他不分页
                $this->article=$classify->join("article as b on classify.classify_id=b.classify_id",'right')->where("title like '%$search%' or content like '%$search%'")->order("s_time desc")->getField('artical_id,title,content,s_time,classify_name');
            }
        }
        $this->page = $Page->show();             // 分页显示输出
        //获取最近的留言
        $CommentDaily=M("CommentDaily");
        //可优化的sql（使用getField好像有bug，只能被迫使用select）
        $this->lastestComment=$CommentDaily->where('pid=0')->order('s_time desc')->limit(5)->select();
        $this->display();

    }

    //登录
    function login(){
        $username=I("post.username");
        $pwd=I("post.pwd");
        $user=M("User");
        $data=$user->where("username='$username' and pwd='$pwd'")->limit(1)->select();
        if($data==null){
            $msg="用户名或密码错误";
        }else{
            session('user',$username);
            session('login',1);
        }
        $this->ajaxReturn($msg);
    }

    //退出(销毁session)
    function logout(){
        session('user',null);
        session('login',null);
        if(session('user')==null&&session('login')==null){
            $this->redirect('index');
        }else{
            echo "退出失败";
        }
    }

    
}