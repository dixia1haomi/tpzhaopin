<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/15 0015
 * Time: 下午 5:17
 */

namespace app\validate;


class TokenValidate extends BaseValidate
{
    protected $rule = [
        'code' => 'require|isNotEmpty',
//        'userinfo' => 'require|isNotEmpty'
    ];

    protected $message = [
        'code' => 'code不能为空.',
//        'userinfo' => 'userinfo不能为空.'
    ];
}