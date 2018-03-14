<?php

//  创建属于后台的路由文件
Route::group(['prefix' => 'admin'],function(){
    //  后台登录页面
    Route::get('/login','\App\Admin\Controllers\LoginController@index');
    //  后台登录行为
    Route::post('/login','\App\Admin\Controllers\LoginController@login');
    //  后台登出路由
    Route::get('/logout','\App\Admin\Controllers\LoginController@logout');
    //  后台首页
    Route::get('/home','\App\Admin\Controllers\HomeController@index');
});