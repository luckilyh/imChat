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

Route::rule('register','index/Index/register','GET|POST');
Route::rule('login','index/Index/login','GET|POST');
Route::get('chat/:token','index/Index/index');
Route::get('getFriend/:user_id','index/Index/getFriend');
Route::post('uploadImage/:user_id','index/Index/uploadImage');
Route::get('chatLog','index/Index/chatLog');
Route::post('updateSign','index/Index/updateSign');
Route::post('updateOnline','index/Index/updateOnline');
