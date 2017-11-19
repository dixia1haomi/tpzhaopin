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

    //查询公司详细信息->并且关联公司名下的岗位
    public static function get_Company_Detail_Model($id){
        return self::with('companyInJob')->find($id);
    }


    //创建公司信息*
    public static function create_Company_Model(){

    }

    //更新公司信息*
    public static function update_Company_Model($id){

    }

    //删除公司信息*
    public static function delete_Company_Model(){
//        return self::with('companyInJob');
    }


    //--------------之前是查公司详细信息关联岗位--现在改成查岗位详细信息的时候关联公司并且再关联该公司岗位---------//

    //定义关联方法->公司id关联到岗位（一对多,该方法在Job模型中使用）
    public function companyInJob(){
        return $this->hasMany('job','company_id','id');
    }


}