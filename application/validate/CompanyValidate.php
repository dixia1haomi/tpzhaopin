<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/18 0018
 * Time: 下午 3:31
 */

namespace app\validate;


class CompanyValidate extends BaseValidate
{
    protected $rule = [
        'company_name' => 'require|isNotEmpty',
        'company_size' => 'number',
    ];
}