<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/21 0021
 * Time: 下午 12:16
 */

namespace app\api\controller;


use app\api\service\BaseToken;
use app\exception\QueryDbException;
use app\validate\resume\Create_Resume_Validate;
use app\api\model\Resume as ResumeModel;
use app\validate\resume\Update_Resume_Validate;
use think\Exception;

class Resume
{
    //简历表

    /*
     * 查询简历列表
     * get
     * 必须携带token
     */
    public function select_Resume($area){
        $result = ResumeModel::get_Resume_List_Model($area);
        if(!$result){
            throw new QueryDbException(['msg' => '查询简历列表失败','code'=>401]);
        }
        return $result;
    }

    /*
     * 查询简历详细信息
     * get
     * 必须携带token
     */
    public function find_Resume($id){
        $result = ResumeModel::get($id);
        if(!$result){
            throw new QueryDbException(['msg' => '查询简历列表失败','code'=>401]);
        }
        return $result;
    }


    /*
     * 新增
     * post
     * 必须携带token
     */
    public function create_Resume(){
        //携带uid
        $uid = BaseToken::get_Token_Uid();

        //过滤参数
        $resumeValidate = new Create_Resume_Validate();
        $resumeValidate->goCheck();     //验证rule
        $data = $resumeValidate->getDataByRule(input('post.')); //过滤参数

        $data['user_id'] = $uid;            //加入uid
        //写入数据库
        $result = ResumeModel::create($data);

        if(!$result){
            throw new QueryDbException(['msg' => '新增简历失败，create_resume','code'=>401]);
        }
        return new QueryDbException(['msg' => '新增简历成功,ID='.$result->id.'，来自create_resume']);
    }


    /*
     * 更新
     * post
     * 必须携带token
     */
    public function update_Resume(){

        $uid = BaseToken::get_Token_Uid();
        //验证是用户自己操作自己的数据，（防止直接用API恶意传参修改别人的数据）
        //这条数据的user_id = token->uid (user_id是这条数据的拥有者，token->uid是用户身份id)
        //user_id 在post请求中获取id，根据id查询数据返回user_id，获取post请求的数据之前先过滤参数
        $resumeValidate = new Update_Resume_Validate();
        $resumeValidate->goCheck(); //验证rule
        $post_data = $resumeValidate->getDataByRule(input('post.')); //过滤参数

        //根据id查询数据库返回这条数据的user_id
        $resume = ResumeModel::get($post_data['id']);
        BaseToken::isValidOperate($resume['user_id'],$uid);   //传入user_id和uid,验证不通过抛出错误

        //执行更新
        $result = ResumeModel::update($post_data);

        if(!$result){
            throw new QueryDbException(['msg' => '更新简历失败，update_resume','code'=>401]);
        }
        return new QueryDbException(['msg' => '更新简历成功,ID='.$result->id.'，来自update_resume']);
    }


    /*
     * 删除
     * post
     * 必须携带token
     */
    public function delete_Resume(){
        $resume_id = input('id');   //获取id
        $uid = BaseToken::get_Token_Uid();

        //条件删除（只允许自己删除自己的数据）
        $result = ResumeModel::destroy(['id'=>$resume_id,'user_id'=>$uid]);

        if(!$result){
            throw new QueryDbException(['msg'=>'删除简历信息失败,来自delete_resume','code'=>401]);
        }
        return new QueryDbException(['msg'=>'删除简历成功,影响数据'.$result.'条，来自delete_resume']);
    }


}