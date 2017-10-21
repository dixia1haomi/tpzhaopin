<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/13 0013
 * Time: 上午 5:40
 */

namespace app\api\controller;


use app\api\service\BaseToken;
use app\exception\QueryDbException;
use app\validate\job\Create_Job_Validate;
use app\validate\job\Update_Job_Validate;
use app\validate\JobValidate;
use app\validate\MustBePositiveIntValidate;
use app\api\model\Job as JobModel;

class Job
{
    //查询岗位列表API
    public function get_Job_List(){

        (new MustBePositiveIntValidate())->goCheck();

        $jobList = JobModel::get_Job_List_Model();
        if(!$jobList){
            throw new QueryDbException(['msg'=>'查询数据不存在,来自查询岗位列表']);
        }
        return $jobList;
    }


    //查询岗位详细信息API
    public function get_Job_Detail($id){

        (new MustBePositiveIntValidate())->goCheck();

        $job_detail = JobModel::get_Job_Detail_Model($id);
        if(!$job_detail){
            throw new QueryDbException(['msg'=>'查询数据不存在,来自查询岗位详细信息']);
        }
        return $job_detail;
    }

    /*岗位 -> 新增(个人岗位(没得公司)：前置登录uid -> 发布
              公司岗位(  有公司)：前置登录uid -> uid关联的公司id -> 发布)
       -> 更新(前置 -> uid关联的岗位id = 要操作的岗位id -> 执行更新)
       -> 删除(前置 -> uid关联的岗位id = 要操作的岗位id -> 执行删除)
    */


    /*
     * 新增岗位
     * post
     * 必须携带token
     */
    public function create_Job(){
        //个人的接受uid，公司的接受uid和公司id
        $uid = BaseToken::get_Token_Uid();

        //参数效验 -> 过滤参数
        $jobValidate = new Create_Job_Validate();
        $jobValidate->goCheck();    //验证rule
        $data = $jobValidate->getDataByRule(input('post.'));    //过滤参数

        //加入uid -> 写入数据库
        $data['user_id'] = $uid;

        $jobModel = new JobModel();
        $result = $jobModel->isUpdate(false)->save($data);
        if(!$result){
            throw new QueryDbException(['msg' => '新增岗位失败，create_job']);
        }
        return new QueryDbException(['msg' => '新增岗位成功,ID='.$jobModel->id.'，来自create_Job()']);
    }


    /*
     * 更新
     * post
     * 必须携带token
     */
    public function update_Job(){
        //接受uid，接受岗位id
        BaseToken::get_Token_Uid(); //用户验证

        //参数效验 -> 过滤参数
        $jobValidate = new Update_Job_Validate();
        $jobValidate->goCheck();    //验证rule
        $data = $jobValidate->getDataByRule(input('post.'));    //过滤参数

        //更新数据库
        $jobModel = new JobModel();
        $result = $jobModel->isUpdate(true)->save($data);
        if(!$result){
            throw new QueryDbException(['msg' => '更新岗位失败，来自update_Job()']);
        }
        return new QueryDbException(['msg' => '更新公司成功,ID='.$jobModel->id.'，来自update_Job()']);
    }

    //删除
    public function delete_Job(){
        //接受uid，接受岗位id
        BaseToken::get_Token_Uid();  //用户验证
        $job_id = input('id');
        $result = JobModel::destroy($job_id);

        if(!$result){
            throw new QueryDbException(['msg'=>'删除岗位信息失败,来自delete_Job()']);
        }
        return new QueryDbException(['msg'=>'删除公司成功,影响数据'.$result.'条，来自delete_Job()']);
    }

}