<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

use think\Route;

//Route::rule('路由表达式','路由地址','请求类型','路由参数（数组）','变量规则（数组）');

Route::get('api/job','api/job/get_Job_List'); //查询岗位列表

Route::get('api/job/:id','api/job/get_Job_Detail'); //查询岗位详细信息

Route::get('api/company/:id','api/company/get_Company_Detail'); //查询公司详细信息 get_Company_In_Job
