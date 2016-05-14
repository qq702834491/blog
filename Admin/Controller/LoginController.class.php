<?php 
namespace Admin\Controller;
use Think\Controller;

class LoginController extends Controller{
    function login(){
        //验证登录信息
        $user=M("User");
        if($_POST){
            //验证码错误
            $verify = I('post.vcode');  
            if(!$this->check_verify($verify)){  
                header("Content-type:text/html;charset=utf8");
                echo "<script>alert('验证码错误');location.href='login';</script>";
            }else{
                $username=I("post.username");
                $pwd=md5(I("post.pwd"));
                if($user->where("username='$username' and pwd='$pwd'")->find()){
                    session('user',$username);
                    session('login',1);
                    header("location:/blog/Home/Index/index");
                }else{
                    echo "<script>alert('用户名或密码错误');</script>";
                }
            }
        }
        $this->display();
    }
    //生成验证码
    function verify(){
        $Verify = new \Think\Verify();
        $Verify->length   = 4;
        $Verify->entry();
    }
    //验证码验证
    function check_verify($code, $id = ''){    
        $verify = new \Think\Verify();    
        return $verify->check($code, $id);
    }
}
 ?>