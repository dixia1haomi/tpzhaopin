<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/21 0021
 * Time: 下午 12:29
 */

namespace app\validate\resume;


use app\validate\BaseValidate;

class Update_Resume_Validate extends BaseValidate
{
    protected $rule = [
        'id' => 'require',
        'work_exp' => 'require',
//        'detailed_address' => 'require'
    ];
}