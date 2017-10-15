<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/11 0011
 * Time: 上午 6:31
 */

namespace app\validate;


use think\Validate;

class MustBePositiveIntValidate extends BaseValidate
{
    //验证规则
    protected $rule = [
        'id'=>'number|>:0', //必须是数字,必须大于0
    ];

}