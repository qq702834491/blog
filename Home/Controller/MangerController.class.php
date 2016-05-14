<?php 
namespace Home\Controller;
use Think\Controller;

class MangerController extends Controller{
    //判断是否已经登录
    function _initialize(){
        if(session('login')!==1){
            $path=U("Index/index");
            header("Content-type:text/html;charset=utf8");
            exit("游客此操作无权限<a href='$path'>首页</a>");
        }
    }
    //初始显示文章
    function manger(){
        $article=M("Article");
        $count=$article->count();
        $Page=new \Think\Page($count,15);        // 实例化分页类 传入总记录数和每页显示的记录数(15)
        $this->page = $Page->show();             // 分页显示输出
        $this->list=$article->order("s_time desc")->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->display();
    }
    //删除博文
    function delarticle(){
        $article=M("Article");
        if($article->delete(I("get.id"))){
            $this->success("删除成功",U("Manger/manger"),0);
        }else{
            $this->error("删除出错");
        }
    }
    //写新文章功能的实现 、 编辑（修改）博文
    function newarticle(){
        //分类表
        $classify=M("Classify");
        $this->name=$classify->order('classify_id')->getField('classify_id,classify_name',true);
        //文章入库
        $article=M("Article");
        //id不为空则查询并显示文章内容
        if(I("get.id")!=null){
            $this->article=$article->find(I("get.id"));
        }
        if($_POST){
            if(I("post.id")==null){              //post.id为空表示新建文章 不为空表示修改文章
                if($article->create()){
                    $article->s_time=time();
                    if($article->add()){
                        $this->redirect("Manger/manger","发表成功",0);
                    }else{
                        echo $article->getError();
                    }
                }else{
                    echo $article->getError();
                }
            }else{
                if($article->create()){
                    $article->artical_id=I("post.id");
                    $article->s_time=time();
                    if($article->save()){
                        $this->redirect("Manger/manger","发表成功",0);
                    }
                }
            }
        }
        $this->display();
    }

    //类别管理
    function classify(){
        $classify=M("Classify");
        $sql="select a.classify_id,classify_name,ifnull(num,0) as num from classify as a left join(select classify_id,count(*) as num from article group by classify_id) as b on a.classify_id=b.classify_id order by a.classify_id";
        $this->list=$classify->query($sql);
        $this->display();
    }

    //添加类别
    function addClassify(){
        $classify=M("Classify");
        $date['classify_id']='';
        $date['classify_name']=I("post.classify_name");
        $num=$classify->where("classify_name='$date[classify_name]'")->count();
        if($num==0){
            if($classify->create($date)){
                if($classify->add()){
                    $msg[]=1;
                    $msg[]=$date['classify_name'];              //$msg[0]=1表示添加成功，=0表示类名已存在
                    $msg[]=$classify->getLastInsID();
                }
            }
        }else{
            $msg[]=0;
            $msg[]="分类已存在，请勿重复添加";
        }
        $this->Ajaxreturn($msg);
    }

    //编辑
    function modify(){
        $classify=M("Classify");
        $id=I("post.classify_id");
        $classify->classify_name=I("post.classify_name");
        $num=$classify->where("classify_name='$classify->classify_name'")->count();
        if($num==0){
            if($classify->where("classify_id='$id'")->save()){
                $msg="ok";
            }else{
                $msg="保存失败";
            }
        }else{
            $msg="类别已存在";
        }
        $this->ajaxReturn($msg);
    }


    //删除
    function delete(){
        $classify=M("Classify");
        $id=I("post.classify_id");
        if($classify->delete($id)){
            $msg="ok";
        }else{
            $msg="fail";
        }
        $this->ajaxReturn($msg);
    }



}



 ?>