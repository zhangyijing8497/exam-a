<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\UserModel;

class UserController extends Controller
{
    /**
     * reg view
     */
    public function reg()
    {
        return view('user.reg');
    }

    /**
     * reg 逻辑
     */
    public function regDo(Request $request)
    {
        $user_name = $request->input('user_name');
        $email = $request->input('email');
        $tel = $request->input('tel');
        $pwd = $request->input('pwd');
        $pwd1 = $request->input('pwd1');
        if(empty($user_name)){
            echo "<script>alert('用户名必填');window.history.go(-1);</script>";
            die;
        }

        if(empty($email)){
            echo "<script>alert('邮箱必填');window.history.go(-1);</script>";
            die;
        }

        if(empty($tel)){
            echo "<script>alert('手机号必填');window.history.go(-1);</script>";
            die;
        }


        if(empty($pwd)){
            echo "<script>alert('密码必填');window.history.go(-1);</script>";
            die;
        }else if(strlen($pwd)<6){
            echo "<script>alert('密码长度必须大于等于6位');window.history.go(-1);</script>";
            die;
        }

        //验证确认密码
        if(empty($pwd1)){
            echo "<script>alert('确认密码必填');window.history.go(-1);</script>";
            die;
        }else if ($pwd1 != $pwd){
            echo "<script>alert('确认密码与密码不一致');window.history.go(-1);</script>";
            die;
        }

        // 判断用户名,邮箱,手机号是否已经存在
        $u = UserModel::where(['user_name'=>$user_name])->first();
        if($u){
            echo "<script>alert('用户名已存在');window.history.go(-1);</script>";
            die;
        }
        $u = UserModel::where(['email'=>$email])->first();
        if($u){
            echo "<script>alert('邮箱已存在');window.history.go(-1);</script>";
            die;
        }
        $u = UserModel::where(['tel'=>$tel])->first();
        if($u){
            echo "<script>alert('手机号已存在');window.history.go(-1);</script>";
            die;
        }

        $pwd = password_hash($pwd,PASSWORD_BCRYPT);
        $data = [
            'user_name' => $user_name,
            'email'     => $email,
            'tel'       => $tel,
            'pwd'       => $pwd
        ];
        $uid = UserModel::insertGetId($data);
        if($uid>0){
            echo "<script>alert('注册成功',location='/login');</script>";        
        }else{
            echo "<script>alert('注册失败',location='/reg');</script>";
        }
    }

    /**
     * login view
     */
    public function login()
    {
       return view('user.login'); 
    }

    /**
     * login逻辑
     */
    public function loginDo(Request $request)
    {
        $u = $request->input('u');
        $pwd = $request->input('pwd');

        $res = UserModel::where(['user_name'=>$u])->orWhere(['email'=>$u])->orWhere(['tel'=>$u])->first();
        if($res == NULL){
            echo "<script>alert('用户不存在,请先注册用户!');location='/reg'</script>";
        }

        if(password_verify($pwd,$res->pwd)){
            echo "<script>alert('登陆成功,正在跳转至个人中心');location='/index'</script>";
        }else{
            echo "<script>alert('密码不正确,请重新输入...');window.history.go(-1);</script>";
        }
    }
}

