<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/15 0015
 * Time: 下午 5:51
 */

namespace app\api\model;


class User extends BaseModel
{
    //查询用户是否存在，通过openid查询
    public static function getByOpenid($openid){
        return self::where('openid','=',$openid)->find();
    }



    //新增用户,返回id
    public static function create_user($openid){
        $user = self::create(['openid' => $openid]);
        return $user->id;
    }

    //更新用户


}