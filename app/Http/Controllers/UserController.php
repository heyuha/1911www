<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\UserModel;

class UserController extends Controller
{
    //执行登录
    public function logindo(Request $request){
        $user_name = request()->input('user_name');
        $password  = request()->input('password');
        $u = UserModel::where(['user_name'=>$user_name])->orWhere(['user_email'=>$user_name])->first();
//        dd($u);
         $result = password_verify($password,$u['password']);
         if($result != $u['password']){
         	echo "密码不正确";die;
         }
        if($u == NULL)
        {
            header("refresh:3;url=http://api.1911.com/goods/login");
            echo "该用户不存在";die;
        }
        //存session
        session(['user_name' => $u['user_name']]);
        header("refresh:3;url=http://api.1911.com/goods");
        echo "登录成功 正在跳转至首页...";
    }
    //执行注册
    public function regdo(Request $request){
        //接值
        $user_name  = request()->post('user_name');
        $user_email = request()->post('user_email');
        $password   = request()->post('user_pwd');
        //加密
        $password = password_hash($password,PASSWORD_BCRYPT);
        //入库
        $user_data = [
            'user_name' => $user_name,
            'user_email' => $user_email,
            'password'  => $password,
        ];
        $u = UserModel::create($user_data);
        header("refresh:2;url=http://api.1911.com/goods/login");
        echo "注册成功";
    }
    //退出登录
    public function login_out(){
        $a = session(['user_name'=>null]);
        header("refresh:3;url=http://api.1911.com/goods");
        echo "退出成功...";
    }
    //
}
