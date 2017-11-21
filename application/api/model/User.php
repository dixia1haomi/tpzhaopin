<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/15 0015
 * Time: 下午 5:51
 */

namespace app\api\model;


use app\api\service\BaseToken;

class User extends BaseModel
{
    //查询用户是否存在，通过openid查询
    public static function getByOpenid($openid){
        return self::where('openid','=',$openid)->find();
    }

    //通过uid查询用户信息
    public static function getUser_Detail_Model(){
        $uid = BaseToken::get_Token_Uid();
        return self::where('id','=',$uid)->find();
    }



    //新增用户,返回id
    public static function create_user($openid){
        $user = self::create(['openid'=>$openid]);
        return $user->id;
    }

    //获取微信用户信息更新到用户数据库中-(客户端授权userinfo后调用)
    public static function update_user($wx_userinfo){
        $uid = BaseToken::get_Token_Uid();
        $arr = [
            'id' => $uid,
            'gender' => $wx_userinfo['gender'],
            'avatar_url' => $wx_userinfo['avatar_url'],
            'nickname' => $wx_userinfo['nickname'],
            'province' => $wx_userinfo['province'],
            'city' => $wx_userinfo['city']
        ];

         return self::update($arr);
    }

    //用户关联简历？
    public static function getUser_Resume_Model(){
        $uid = BaseToken::get_Token_Uid();
        return self::with('userResume')->find($uid);
    }
    //用户关联简历->关联方法
    public function userResume(){
        return $this->hasOne('resume','user_id','id');
    }



    //用户关联公司？
    public static function getUser_Company_Model(){
        $uid = BaseToken::get_Token_Uid();
        return self::with('userCompany')->find($uid);
    }
    //用户关联公司->关联方法
    public function userCompany(){
        return $this->hasOne('company','user_id','id');
    }



    //用户关联岗位？
    public static function getUser_Job_Model(){
        $uid = BaseToken::get_Token_Uid();
        return self::with('userJob')->find($uid);
    }
    //用户关联岗位->关联方法
    public function userJob(){
        return $this->hasMany('job','user_id','id');
    }

}