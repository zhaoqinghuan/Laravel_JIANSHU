<?php

//  创建属于后台的路由文件
Route::group(['prefix' => 'admin'],function(){
    //  后台登录页面
    Route::get('/login','\App\Admin\Controllers\LoginController@index');
    //  后台登录行为
    Route::post('/login','\App\Admin\Controllers\LoginController@login');

    //将定义好的中间件加给需要的路由
        //  这里的auth后面的参数就是\config\auth.php 中guards部分的参数值即上边第三步的名称
    Route::group(['middleware'=>'auth:admin'],function(){
        //  后台登出路由
        Route::get('/logout','\App\Admin\Controllers\LoginController@logout');
        //  后台首页
        Route::get('/home','\App\Admin\Controllers\HomeController@index');
        //  管理人员列表页
        Route::get('/users','\App\Admin\Controllers\UserController@index');
        //  管理人员添加静态页
        Route::get('/users/create','\App\Admin\Controllers\UserController@create');
        //  管理人员添加逻辑页
        Route::post('/users/store','\App\Admin\Controllers\UserController@store');
        //  文章审核静态页
        Route::get('/posts','\App\Admin\Controllers\PostController@index');
        //  文章审核逻辑页
        Route::post('/posts/{post}/status', '\App\Admin\Controllers\PostController@status');
    });
});