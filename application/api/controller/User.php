<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/17 0017
 * Time: 上午 11:36
 */

namespace app\api\controller;
use app\api\model\User as UserModel;
use app\api\service\BaseToken;
use app\exception\QueryDbException;

class User
{
    //不允许直接携带uid，token这些参数直接访问接口，token必须从客户端传过来，再在服务器间接获取uid
    //自己访问自己的信息 -> 根据客户端缓存的token查询客户的uid -> 根据uid查询所关联的公司id,岗位id,简历id
    //自己访问自己的信息 -> 根据客户端缓存的token查询客户的uid（前置）

    //以下操作必须携带token，检查是自己的数据才可以操作


    /*公司 -> 新增(前置uid)
           -> 更新(前置 -> uid关联的公司id = 要操作的公司id -> 执行更新)
           -> 删除(前置 -> uid关联的公司id = 要操作的公司id -> 执行删除)
    */


    /*岗位 -> 新增(个人岗位(没得公司)：前置登录uid -> 发布
                  公司岗位(  有公司)：前置登录uid -> uid关联的公司id -> 发布)
           -> 更新(前置 -> uid关联的岗位id = 要操作的岗位id -> 执行更新)
           -> 删除(前置 -> uid关联的岗位id = 要操作的岗位id -> 执行删除)
    */


    /*简历 -> 新增(前置uid)
           -> 更新(前置 -> uid关联的简历id = 要操作的简历id -> 执行更新)
           -> 删除(前置 -> uid关联的简历id = 要操作的简历id -> 执行删除)
           -> 查看(简历id，权限控制* -> 普通，.....)
    */


    //新增用户？

    //更新用户？

    //查询用户详细信息
    public function getUser_Detail(){
        $result = UserModel::getUser_Detail_Model();
        if(!$result){
            throw new QueryDbException(['msg'=>'查询用户失败','code'=>401]);
        }
        return $result;
    }

    //登录？

    //登出？

    //用户关联简历？getUser_Resume_Model
    public function getUser_Resume(){
        $result = UserModel::getUser_Resume_Model();
        if(!$result){
            throw new QueryDbException(['msg'=>'查询用户关联的简历失败','code'=>401]);
        }
        return $result;
    }


    //用户关联公司？
    public function getUser_Company(){
        $result = UserModel::getUser_Company_Model();
        if(!$result){
            throw new QueryDbException(['msg'=>'查询用户关联的公司失败','code'=>401]);
        }
        return $result;
    }


    //用户关联岗位？
    public function getUser_Job(){
        $result = UserModel::getUser_Job_Model();
        if(!$result){
            throw new QueryDbException(['msg'=>'查询用户关联的岗位失败','code'=>401]);
        }
        return $result;
    }


    // 获取微信用户信息写入数据库
    public function getWx_userInfo(){
        $wx_userinfo = input('post.');
        $update = UserModel::update_user($wx_userinfo);
        if(!$update){
            throw new QueryDbException(['msg'=>'更新用户信息失败','code'=>401]);
        }

        return $update;
    }
}