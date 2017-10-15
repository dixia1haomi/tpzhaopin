<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/13 0013
 * Time: 上午 7:19
 */

namespace app\api\controller;

use app\api\model\Company as CompanyModel;
use app\exception\QueryDbException;
use app\validate\MustBePositiveIntValidate;

class Company
{
    //查询公司详细信息API(并且关联公司发布的所有岗位)
    public function get_Company_Detail($id){

        (new MustBePositiveIntValidate())->goCheck();

        $data = CompanyModel::get_Company_Detail_Model($id);
        if(!$data){
            throw new QueryDbException(['msg'=>'查询数据不存在,来自查询公司详细信息']);
        }
        return $data;
    }

}