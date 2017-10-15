<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/11 0011
 * Time: 上午 7:10
 */

namespace app\validate;


use app\exception\CheckParamException;
use think\Exception;
use think\Request;
use think\Validate;

class BaseValidate extends Validate
{
    //封装的参数验证方法
    public function goCheck(){
        //获取参数
        $request = Request::instance()->param();
        //验证参数
        $result = $this->batch()->check($request);
        //判断验证是否通过
        if(!$result){
            //不通过，获取错误信息并抛出
            throw new CheckParamException(['msg'=>$this->error]);
        }else{
            return true;
        }
    }
}