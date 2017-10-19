<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/13 0013
 * Time: 上午 7:19
 */

namespace app\api\model;



class Company extends BaseModel
{

    //查询公司详细信息
    public static function get_Company_Detail_Model($id){
        return self::with('companyInJob')->find($id);
    }


    //创建公司信息*
    public static function create_Company_Model(){

    }

    //更新公司信息*
    public function update_Company_Model($id){

    }

    //删除公司信息*
    public function delete_Company_Model($id){

    }


    //--------------关联方法------------//

    //定义关联方法->公司关联到岗位（一对多）
    public function companyInJob(){
        return $this->hasMany('job','company_id','id');
    }
}