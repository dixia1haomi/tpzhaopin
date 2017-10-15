<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/13 0013
 * Time: 上午 7:19
 */

namespace app\api\model;


use think\Model;

class Company extends Model
{
    //获取公司详细信息
    public static function get_Company_Detail_Model($id){
        return self::with('companyInJob')->find($id);
    }


    //定义关联方法->公司关联到岗位（一对多）
    public function companyInJob(){
        return $this->hasMany('job','company_id','id');
    }
}