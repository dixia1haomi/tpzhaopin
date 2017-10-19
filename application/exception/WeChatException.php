<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/15 0015
 * Time: 下午 7:38
 */

namespace app\exception;


class WeChatException extends BaseException
{
    public $code = 400;

    public $msg = 'WeChatException';

    public $errorCode = 10000;
}