<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/21 0021
 * Time: 上午 11:43
 */

namespace app\validate\company;


use app\validate\BaseValidate;

class Update_Company_Validate extends BaseValidate
{
    protected $rule = [
        'company_id' => 'require',
        'company_name' => 'require|isNotEmpty',
        'company_size' => 'number',
    ];
}