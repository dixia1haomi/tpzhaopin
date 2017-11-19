<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/15 0015
 * Time: 下午 5:15
 */

namespace app\api\controller;


use app\api\service\UserToken;
use app\exception\TokenException;
use app\validate\TokenValidate;
use app\api\service\BaseToken;




class Token
{
    //获取令牌（感觉应该在用户控制器中）***
    public function getToken($code){

        (new TokenValidate())->goCheck();   //'code' => 'require|isNotEmpty'


        $ut = new UserToken($code); //接受code，在构造函数中封装微信获取openid的url
        $token = $ut->get_Token_Service();  //返回缓存的key

        return ['token_key' => $token]; //返回一个json对象（直接返回$token是json字符串）
//        return json_decode(cache($token),true); //测试获取缓存内的数据

    }


    //检查token是否有效
    public function verifyToken($token=''){

        if(!$token){
            new TokenException(['msg'=>'检查token时token为空','code'=>401]);
        }
        $valid = BaseToken::verifyToken($token);

        return ['isValid' => $valid];
    }
}