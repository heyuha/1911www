<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use GuzzleHttp\Client;


class TestController extends Controller
{
    public function test1(){
        $url = "http://api.1911.com/api/token";
        $response = file_get_contents($url);
        $response = json_decode($response,true);
        echo $response['token'];
    }
    public function test2(){
        echo "test2";
    }

    public function reg(){
    	$url = "http://api.1911.com/user/reg";
    	$response = file_get_contents($url);
    	echo $response;
    }
     public function login(){
    	$url = "http://api.1911.com/user/login";
    	$response = file_get_contents($url);
    	echo $response;
    }
     public function center(){
    	$url = "http://api.1911.com/user/center";
    	$response = file_get_contents($url);
    	echo $response;
    }
     public function loginadd(){
    	$url = "http://api.1911.com/user/loginadd";
    	$response = file_get_contents($url);
    	echo $response;
    }
     public function regadd(){
    	$url = "http://api.1911.com/user/regadd";
    	$response = file_get_contents($url);
    	echo $response;
    }
    public function dec(){

        //get

//        $mehod = "AES-256-CBC";
//        $key = "1911api";
//        $iv ="aaaabbbbccccdddd";
//        $openit = OPENSSL_RAW_DATA;
//        $data = request()->get('data');
//        $dec_data = base64_decode($data);
//        $dec = openssl_decrypt($dec_data,$mehod,$key,$openit,$iv);
//        echo $dec;


//post
        $mehod = "AES-256-CBC";
        $key = "1911api";
        $iv ="aaaabbbbccccdddd";
        $openit = OPENSSL_RAW_DATA;
//        echo $_POST['data'];die;
        $enc_data = base64_decode($_POST['data']);
        $dec = openssl_decrypt($enc_data,$mehod,$key,$openit,$iv);
        echo $dec;

    }
    public function dec2(){
        $content = file_get_contents(storage_path('keys/www/priv.key'));
        $priv_key =  openssl_get_privatekey($content);
        $enc_data = base64_decode($_POST['data']);
        openssl_private_decrypt($enc_data,$dec_data,$priv_key);
        echo $dec_data;


        //回复
        //获取api公钥
        $acontent = file_get_contents(storage_path('keys/api/pub.key'));
        $apub_key = openssl_get_publickey($acontent);
        $adata = "不太好";//回复内容
        openssl_public_encrypt($adata,$adec_data,$apub_key);
        $client = new Client();
        $b64 = base64_encode($adec_data);
        return $b64;
        

    }
    /*
     验签
     * */
    public function sign(){
        $data = request()->get('data');
        $key = "1911api";
        $sign = request()->get("sign");

        $sign_str1 = md5( $data . $key );

        if($sign == $sign_str1){
            echo "验签通过";
        }else{
            echo "验签失败";
        }
    }


    public function sign2(){
        $data = request()->get("data");
        $sign = request()->get("sign");
        $sign = base64_decode($sign);
//        echo $data;die;
        $pub_key = file_get_contents(storage_path("keys/api/pub.key"));
//        $pub_key_id = openssl_get_publickey($pub_key);
        $vertrue=openssl_verify($data,$sign,$pub_key,OPENSSL_ALGO_SHA1);
        echo $vertrue;
    }

    //对称加密  私钥签名
    public function sign3(){

    }
    //header
    public function header1(){
        if( isset($_SERVER['HTTP_TOKEN']) ){
            $token = $_SERVER['HTTP_TOKEN'];
            $uid = $_SERVER['HTTP_UID'];

            echo $token;
        }else{
            echo "授权失败";die;
        }

    }

}
