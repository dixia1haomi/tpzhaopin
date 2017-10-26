<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/21 0021
 * Time: 上午 11:24
 */

namespace app\validate\job;


use app\validate\BaseValidate;

class Update_Job_Validate extends BaseValidate
{
    protected $rule = [
        'id' => 'require',
        'job_name' => 'require|isNotEmpty',
        'company_id' => 'number',
        'pay_level' => 'require',
        'work_area' => 'require',
        'detailed_address' => 'require',
        'job_description' => 'require'
    ];
}