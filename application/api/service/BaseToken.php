<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/16 0016
 * Time: 下午 4:04
 */

namespace app\api\service;


use app\exception\CheckParamException;
use app\exception\TokenException;
use app\extra\Enum;
use think\Cache;
use think\Exception;
use think\Request;

class BaseToken
{
    //Token基类:负责生成token的key:value


    //准备令牌的value，
    //接受微信返回的数据和数据库返回的用户id
    //返回字符串,(原本是数组，但是框架的缓存只接受字符串value,所以json_encode)
    public static function prepare_Token_Value($wxResult,$uid){
        $tokenValue = $wxResult;
        $tokenValue['uid'] = $uid;
        $tokenValue['scope'] = 16;
        return json_encode($tokenValue);
    }


    //准备令牌的key,返回md5加密字符串
    public static function prepare_Token_Key(){
        //用三组字符串进行md5加密
        //获取随机字符串
        $rand_str = get_Rand_Str(32);
        //获取当前时间戳
        $time = $_SERVER['REQUEST_TIME'];
        //获取 盐
        $token_salt = config('wx_config.token_salt');

        return md5($rand_str.$time.$token_salt);
    }


    //根据传入的参数获取token里value中想要的值
    public static function get_Token_Value_Vars($key){
        //从请求中的header里获取token的key
        $info = Request::instance()->header();
        $token_key = $info['token_key'];

        if(empty($token_key)){
            throw new TokenException(['msg' => '必须携带token，来自get_Token_Value_Vars','code'=>401]);
        }
        //根据token_key取缓存,并判断是否获取成功
        $vars = cache($token_key);
        //如果获取缓存失败，抛出异常
        if(!$vars){
            throw new TokenException(['msg' => '用token_key取缓存中的token失败，来自get_Token_Value_Vars','code'=>401]);
        }else{
            //获取缓存成功.判断取出来的缓存是不是数组（因为之前存入的时候是JSON字符串，转化为组数好操作）
            if(!is_array($vars)){
                $vars = json_decode($vars,true);
            }
            //判断取出的数组里有没有传入的变量，如果有：则返回对应变量的值，没有就抛出异常（防止自己传入错误的变量）
            if(array_key_exists($key,$vars)){
                return $vars[$key];
            }else{
                throw new Exception('尝试获取的token_value中的值不存在，是不是传入了错误的变量？');
            }
        }
    }


    //获取token中的uid值
    public static function get_Token_Uid(){
        $uid = self::get_Token_Value_Vars('uid');
        $scope = self::get_Token_Value_Vars('scope');

        //如果是super
        if($scope == Enum::Super){               // 只有Super权限才可以自己传入uid,且必须在get参数中，post不接受任何uid字段
            $id = input('get.id');
            if(!$id){
                throw new CheckParamException(['msg' => '没有指定要操作的对象','code'=>401]);
            }
            return $id;
        }else{
            return $uid;
        }
    }



    //检查token是否有效
    public static function verifyToken($token)
    {
        $exist = Cache::get($token);
        if($exist){
            return true;
        }
        else{
            return false;
        }
    }


}