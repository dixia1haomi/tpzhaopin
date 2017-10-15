<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/13 0013
 * Time: 上午 5:40
 */

namespace app\api\model;


use think\Model;
use think\Db;

class Job extends Model
{

    //只显示-工作名称-薪资水平-工作范围-公司关联信息-福利-创建时间
//    protected $job_List_visible = ['id','job_name','pay_level','work_area','company_name','company','welfare','create_time'];

    //查询岗位列表API
    public static function get_Job_List_Model(){
        return self::field('job_description,Job_requirements,delete_time',true)->
        with(['company'=>function($query){$query->withField('id,company_name');}])->
        select();
    }

    //定义关联方法->工作列表关联到公司
    public function company(){
        return $this->hasOne('company','id','company_id')->bind('company_name');
    }



    //查询岗位详细信息API
    public static function get_Job_Detail_Model($id){
        return self::with('company')->find($id);
    }
}