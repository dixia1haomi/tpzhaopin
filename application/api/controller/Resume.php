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
        $resumeModel = new ResumeModel();
        $result = $resumeModel->isUpdate(false)->save($data);

        if(!$result){
            throw new QueryDbException(['msg' => '新增简历失败，create_resume','code'=>401]);
        }
        return new QueryDbException(['msg' => '新增简历成功,ID='.$resumeModel->id.'，来自create_resume']);
    }


    /*
     * 更新
     * post
     * 必须携带token
     */
    public function update_Resume(){
        //登录
        BaseToken::get_Token_Uid();

        //过滤参数
        $resumeValidate = new Update_Resume_Validate();
        $resumeValidate->goCheck(); //验证rule
        $data = $resumeValidate->getDataByRule(input('post.')); //过滤参数

        //更新数据
        $resumeModel = new ResumeModel();
        $result = $resumeModel->isUpdate(true)->save($data);

        if(!$result){
            throw new QueryDbException(['msg' => '更新简历失败，update_resume','code'=>401]);
        }
        return new QueryDbException(['msg' => '更新简历成功,ID='.$resumeModel->id.'，来自update_resume']);
    }


    /*
     * 删除
     * post
     * 必须携带token
     */
    public function delete_Resume(){
        //登录
        BaseToken::get_Token_Uid();
        $resume_id = input('id');   //获取id
        $result = ResumeModel::destroy($resume_id); //删除数据

        if(!$result){
            throw new QueryDbException(['msg'=>'删除简历信息失败,来自delete_resume','code'=>401]);
        }
        return new QueryDbException(['msg'=>'删除简历成功,影响数据'.$result.'条，来自delete_resume']);
    }


}