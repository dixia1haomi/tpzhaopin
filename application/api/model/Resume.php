<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/21 0021
 * Time: 下午 12:26
 */

namespace app\api\model;


class Resume extends BaseModel
{


    //查询简历【列表】API
    public static function get_Resume_List_Model($area)
    {

        if ($area == 0) {
            $data = self::select();
        } else {
            $data = self::where('work_place', $area)->order('update_time desc,create_time desc')->select();
        }
        return $data;
    }




}