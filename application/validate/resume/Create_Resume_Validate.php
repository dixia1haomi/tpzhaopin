<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/21 0021
 * Time: 下午 12:29
 */

namespace app\validate\resume;


use app\validate\BaseValidate;

class Create_Resume_Validate extends BaseValidate
{
    protected $rule = [
        'name' => 'require',
        'sex' => 'number',
        'age' => 'number',
        'phone' => 'number',
        'education' => 'number',
        'expectation_pay' => 'number',
        'current_state' => 'number',
        'expectation_position' => 'number',
        'report_time' => 'number',
        'work_exp' => 'number',
        'work_nature' => 'number',
        'work_place' => 'number',
        'resume_description' => 'require',
    ];
}