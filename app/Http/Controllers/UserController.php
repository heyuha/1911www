<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\UserModel;
use App\Model\CartModel;
use App\Model\GoodsModel;

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
    //商品详情页
    public function detail($goods_id){
        //根据商品id查询goods表
        $goodsinfo = GoodsModel::where('goods_id',$goods_id)->first();

    }
    /**
     * 商品列表
     */
    public function product(Request $request)
    {
        $goods_name = $request->input('goods_name');
        $where = [];
        if(!empty($goods_name)){
            $where[]=['goods_name','like',"%$goods_name%"];
        }
        $prolist=GoodsModel::where($where)->orderby('goods_id','DESC')->paginate(6);
        return view('cart/product',['prolist'=>$prolist,'goods_name'=>$goods_name]);
    }


}


