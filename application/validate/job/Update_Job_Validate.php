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
        'id'=>'number',
        'company_id' => 'number',
        'job_name' => 'require|isNotEmpty',
        'job_user_name' => 'require',
        'pay_level' => 'number',
        'phone' => 'require',
//        'detailed_address' => 'require',
        'work_area' => 'number',
        'welfare' => 'require',
        'ments_number' => 'number',
        'ments_exp' => 'number',
        'ments_sex' => 'number',
        'ments_education' => 'number',
        'job_description' => 'require',
        'map_address' => 'require',
        'map_name' => 'require',
        'map_longitude' => 'require',
        'map_latitude' => 'require',
    ];
}