<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/13 0013
 * Time: 上午 5:40
 */

namespace app\api\controller;


use app\exception\QueryDbException;
use app\validate\MustBePositiveIntValidate;
use app\api\model\Job as jobModel;

class Job
{
    //查询岗位列表API
    public function get_Job_List(){

        $jobList = jobModel::get_Job_List_Model();
        if(!$jobList){
            throw new QueryDbException(['msg'=>'查询数据不存在,来自查询岗位列表']);
        }
        return $jobList;
    }


    //查询岗位详细信息API
    public function get_Job_Detail($id){

        (new MustBePositiveIntValidate())->goCheck();

        $job_detail = jobModel::get_Job_Detail_Model($id);
        if(!$job_detail){
            throw new QueryDbException(['msg'=>'查询数据不存在,来自查询岗位详细信息']);
        }
        return $job_detail;
    }

    //创建岗位？

    //更新岗位？

    //删除岗位？
}