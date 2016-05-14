<?php 
namespace Home\Controller;
use Think\Controller;

class CommentDailyController extends Controller{
    //登陆后才有操作的权限
    function isLogin(){
        if(session('login')!==1){
            $path=U("Index/index");
            header("Content-type:text/html;charset=utf8");
            exit("游客此操作无权限<a href='$path'>首页</a>");
        }
    }
    //发表日常
    function daily(){
        $this->isLogin();
        //ajax发表
        $time=time();
        $CommentDaily=M('Comment_daily');
        $CommentDaily->create();
        $CommentDaily->m_name=session('user');
        $CommentDaily->s_time=$time;
        $CommentDaily->pid=-1;                      //-1代表的是日常中的数据，0表示留言顶级数据
        if($CommentDaily->add()){
            $msg['success']=true;
            $msg['s_time']=date("Y-m-d H:i:s",$time);
            $msg['id']=$CommentDaily->getLastInsID();
        }else{
            $msg['success']=false;
            $msg['error'] = $CommentDaily->getError();
        }
        $this->ajaxReturn($msg);
    }
    //查看日常内容
    function readdaily(){
        $this->isLogin();

        $CommentDaily=M('Comment_daily');
        //分页
        $count = $CommentDaily->where('pid=-1')->count();
        $Page = new \Think\Page($count,15);      // 实例化分页类 传入总记录数和每页显示的记录数(15)
        $this->dailyList=$CommentDaily->where('pid=-1')->order('s_time desc')->limit($Page->firstRow.','.$Page->listRows)->getField('m_id,m_name,content,s_time',true);   //查询結果
        $this->page = $Page->show();             // 分页显示输出
        $this->display();
    }
    //删除日常记录
    function del(){
        $this->isLogin();

        $m_id=I("post.id");
        if($m_id==""){                  //发送过来的id为空则中断程序
            return false;
        }
        $CommentDaily=M('Comment_daily');
        if($CommentDaily->where("pid=$m_id or m_id=$m_id")->delete()){
            $msg=true;
        }else{
            $msg=$CommentDaily->getError();
        }
        $this->ajaxReturn($msg);
    }
    //ajax发表留言
    function comment(){
        $time=time();
        $CommentDaily=M("CommentDaily");
        $CommentDaily->create();
        $CommentDaily->m_name=trim(I("post.m_name"));              //去空格
        $CommentDaily->content=trim(I("post.content"));            //去空格
        $CommentDaily->s_time=$time;
        $CommentDaily->top=0;           //top0表示非置顶状态
        $CommentDaily->pid=0;           //pid0表示顶级留言状态
        //正则表达式判断是否包含数据库关键词
        $pattern="/(select|delete|insert|update|from)/";
        if(preg_match($pattern, $CommentDaily->m_name)||preg_match($pattern, $CommentDaily->content)){
            $msg['error']="非法字符";
        }else{
            if($CommentDaily->filter('stripslashes')->add()){
                $msg['success']=true;
                $msg['s_time']=date("Y-m-d H:i:s",$time);
                $msg['id']=$CommentDaily->getLastInsID();
                if(session('login')===1){
                    $msg['login']=true;
                }
            }else{
                $msg['error']=$CommentDaily->getError();
            }
        }
        $this->ajaxReturn($msg);
    }
    //查看留言板
    function readcomment(){
        $CommentDaily=M("CommentDaily");
        $count=$CommentDaily->where('pid=0')->count();
        $Page = new \Think\Page($count,15);      // 实例化分页类 传入总记录数和每页显示的记录数(15)
        //顶级留言列表
        $this->commentList = $CommentDaily->where('pid=0')->order('s_time desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        //子回复列表
        $this->reply=$CommentDaily->where('pid>0')->order('s_time desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        //置顶列表
        $this->top=$CommentDaily->where('top=1 and pid=-2')->limit(1)->getField('content,s_time');          //pid=-2表示该回复是置顶内容top=1表示是置顶状态
        $this->page = $Page->show();             // 分页显示输出  
        $this->display();
    }
    //置顶功能的实现
    function betop(){
        $m_id=I('get.id');
        $CommentDaily=M("CommentDaily");
        //将回复列表所有都设置为非置顶状态
        $CommentDaily->top=0;
        $CommentDaily->pid=0;
        $CommentDaily->where('top=1 and pid=-2')->save();
        //修改$m_id的数据为置顶状态
        $CommentDaily->top=1;
        $CommentDaily->pid=-2;
        $CommentDaily->where("pid=0 and m_id=$m_id")->save();
        //跳转到留言板首页面
        $this->redirect('CommentDaily/readcomment',0);
    }
    //留言回复
    function reply(){
        $this->isLogin();
        $CommentDaily=M("CommentDaily");
        $CommentDaily->create();
        $CommentDaily->s_time=time();
        $CommentDaily->top=0;                   //top0表示非置顶状态
        $CommentDaily->m_name=session('user');
        if($CommentDaily->add()){
            $this->redirect('readcomment',0);
        }else{
            echo $CommentDaily->getError();
        }
    }
    
}


 ?>