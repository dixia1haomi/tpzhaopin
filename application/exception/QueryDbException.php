<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/11 0011
 * Time: 上午 8:51
 */

namespace app\exception;


class QueryDbException extends BaseException
{
    public $code = 400;

    public $msg = 'QueryDbException';

    public $errorCode = 10000;
}