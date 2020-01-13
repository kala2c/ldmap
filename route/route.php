<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------


// 前台路由

Route::get('api/buildings', 'index/api/buildings');
// 后台路由
Route::post('admin/api/building/post', 'admin/LatlngApi/post');
Route::get('admin/api/building/delete', 'admin/LatlngApi/delete');
Route::post('admin/api/login', 'admin/AuthApi/login');
