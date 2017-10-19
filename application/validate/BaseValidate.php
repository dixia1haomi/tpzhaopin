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

    //过滤获取的数据，只要rule中定义过的数据
    public function getDataByRule($dataArray){
        //请求中不允许携带uid,user_id这些参数，（恶意访问）
        if(array_key_exists('uid',$dataArray) || array_key_exists('user_id',$dataArray)){
            throw new CheckParamException(['msg' => '恶意访问，参数中包含uid，user_id,来自BaseValidate的getDataByRule']);
        }

        //把rule定义过的参数组装成新数组（变相的用rule定义过的参数来过滤过户传来的数据，只要我定义过的数据）
        $newArray = [];
        foreach($this->rule as $key => $value){
            $newArray[$key] = $dataArray[$key];
        }
        return $newArray;
    }

    //自定义验证方法isNotEmpty
    public function isNotEmpty($value){
        if(empty($value)){
            return false;
        }else{
            return true;
        }
    }
}