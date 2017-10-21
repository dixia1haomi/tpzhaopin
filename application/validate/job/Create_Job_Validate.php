<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/21 0021
 * Time: 上午 11:23
 */

namespace app\validate\job;


use app\validate\BaseValidate;

class Create_Job_Validate extends BaseValidate
{
    protected $rule = [
        'job_name' => 'require|isNotEmpty',
        'company_id' => 'number',
        'detailed_address' => 'require'
    ];
}