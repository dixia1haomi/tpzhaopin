<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/11 0011
 * Time: 上午 11:11
 */

namespace app\exception;


class CheckParamException extends BaseException
{
    public $code = 411;

    public $msg = '查询数据库传入的参数验证错误，CheckParamException';

    public $errorCode = 10000;
}