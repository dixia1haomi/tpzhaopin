<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/16 0016
 * Time: 下午 5:23
 */

namespace app\exception;


class TokenException extends BaseException
{
    public $code = 400;

    public $msg = 'token异常，TokenException';

    public $errorCode = 10000;
}