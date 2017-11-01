<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/13 0013
 * Time: 上午 5:40
 */

namespace app\api\model;



use think\db\Query;
use think\Queue;

class Job extends BaseModel
{

    //获取器-> 查出数据来处理
    // work_area工作范围字段用int类型储存-> 0=>'曲靖',1=>'麒麟',2=>'沾益'
//    public function getWorkAreaAttr($value)
//    {
//        $status = [0=>'曲靖',1=>'麒麟',2=>'沾益'];
//        return $status[$value];
//    }

    //只显示-工作名称-薪资水平-工作范围-公司关联信息-福利-创建时间
//    protected $job_List_visible = ['id','job_name','pay_level','work_area','company_name','company','welfare','create_time'];


    //查询岗位【列表】API
    public static function get_Job_List_Model($work_area){

        if($work_area == 0){
            $data = self::
            field('job_description,Job_requirements,delete_time',true)->
            order('set_top desc,welfare desc')->
            with(['company'=>function($query){$query->withField('id,company_name');}])->
            select();
        }else{
            $data = self::
            field('job_description,Job_requirements,delete_time',true)->
            where('work_area',$work_area)->
            order('set_top desc,welfare desc')->
            with(['company'=>function($query){$query->withField('id,company_name');}])->
            select();
        }

        return $data;
    }
    //定义关联方法->工作列表关联到公司
    public function company(){
        return $this->hasOne('company','id','company_id')->bind('company_name');
    }



    //查询岗位【详细信息】API
    public static function get_Job_Detail_Model($id){
        $find = self::with('company')->find($id);
        $find->setInc('page_view'); //查询岗位详情时让浏览量+1
        return $find;
    }
}