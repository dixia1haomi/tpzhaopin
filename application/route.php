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

//token组
Route::post('api/token/user','api/token/getToken'); //获取Token


//User组
Route::post('api/user','api/user/getUser_Detail'); //查询用户详细信息
Route::post('api/user/job','api/user/getUser_Job'); //查询用户关联的岗位
Route::post('api/user/company','api/user/getUser_Company'); //查询用户关联的公司
Route::post('api/user/resume','api/user/getUser_Resume'); //查询用户关联的简历


//岗位组
Route::get('api/job/:work_area','api/job/get_Job_List'); //查询岗位列表
Route::get('api/job/detail/:id','api/job/get_Job_Detail'); //查询岗位详细信息
Route::post('api/job/create','api/job/create_Job'); //新增岗位
Route::post('api/job/update','api/job/update_Job'); //更新岗位
Route::post('api/job/delete','api/job/delete_Job'); //删除岗位


//公司组
Route::get('api/company/detail/:id','api/company/get_Company_Detail'); //查询公司详细信息
//Route::get('api/company/company_get_job/:id','api/company/company_get_Job_List'); //根据公司id查询关联的岗位列表
Route::post('api/company/create','api/company/create_Company'); //创建公司
Route::post('api/company/update','api/company/update_Company'); //更新公司
Route::post('api/company/delete','api/company/delete_Company'); //删除公司


//简历组
Route::get('api/resume/:area','api/resume/select_Resume'); //查询简历列表
Route::get('api/resume/detail/:id','api/resume/find_Resume'); //查询简历详细信息
Route::post('api/resume/create','api/resume/create_Resume'); //新增简历
Route::post('api/resume/update','api/resume/update_Resume'); //更新简历
Route::post('api/resume/delete','api/resume/delete_Resume'); //删除简历

