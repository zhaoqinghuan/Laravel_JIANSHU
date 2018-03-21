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
//  基础操作
        //  后台登出路由
        Route::get('/logout','\App\Admin\Controllers\LoginController@logout');
        //  后台首页
        Route::get('/home','\App\Admin\Controllers\HomeController@index');

//使用Gate进行专题权限管理
        Route::group(['middleware'=>'can:topic'],function(){
        //专题模块路由使用resource
            Route::resource('topics','\App\Admin\Controllers\TopicController',['only'=>[
                'index','create','store','destroy']]);
            /*因为这里使用了resource的路由定义方法 所以系统默认帮我们开启了所有方法 在不需要某些方法的情况下
            我们使用resource的第三个参数来限制只使用哪些操作
            */
        });
//使用Gate进行文章权限管理
        Route::group(['middleware'=>'can:post'],function() {
        //  文章审核
            //  文章审核静态页
            Route::get('/posts', '\App\Admin\Controllers\PostController@index');
            //  文章审核逻辑页
            Route::post('/posts/{post}/status', '\App\Admin\Controllers\PostController@status');
        });

//使用Gate进行系统权限管理
        Route::group(['middleware'=>'can:system'],function(){
        //  管理员
            //  管理人员列表页
            Route::get('/users','\App\Admin\Controllers\UserController@index');
            //  管理人员添加静态页
            Route::get('/users/create','\App\Admin\Controllers\UserController@create');
            //  管理人员添加逻辑页
            Route::post('/users/store','\App\Admin\Controllers\UserController@store');
            //  管理人员角色页
            Route::get('/users/{user}/role', '\App\Admin\Controllers\UserController@role');
            //  管理人员角色修改页
            Route::post('/users/{user}/role', '\App\Admin\Controllers\UserController@storeRole');
        //  角色
            //  角色列表页
            Route::get('/roles', '\App\Admin\Controllers\RoleController@index');
            //  角色创建页
            Route::get('/roles/create', '\App\Admin\Controllers\RoleController@create');
            //  角色创建行为
            Route::post('/roles/store', '\App\Admin\Controllers\RoleController@store');
            //  角色与权限的关系列表
            Route::get('/roles/{role}/permission', '\App\Admin\Controllers\RoleController@permission');
            //  角色与权限创建行为
            Route::post('/roles/{role}/permission', '\App\Admin\Controllers\RoleController@storePermission');
        //  权限
            //  权限列表页
            Route::get('/permissions', '\App\Admin\Controllers\PermissionController@index');
            //  权限创建页
            Route::get('/permissions/create', '\App\Admin\Controllers\PermissionController@create');
            //  权限创建行为
            Route::post('/permissions/store', '\App\Admin\Controllers\PermissionController@store');
        });
    });
});