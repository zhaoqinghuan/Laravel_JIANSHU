<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//使用中间件对路由进行控制
Route::group(['middleware' => 'auth:web'],function(){

//  个人中心模块
    //  添加关注
    Route::post('/user/{user}/fan','\App\Http\Controllers\UserController@fan');
    //  取消关注
    Route::post('/user/{user}/unfan', '\App\Http\Controllers\UserController@unfan');
    //  个人中心页面
    Route::get('/user/{user}','\App\Http\Controllers\UserController@show');

    //  个人设置页面
    Route::get('/user/me/setting','\App\Http\Controllers\UserController@setting');
    //  个人设置行为
    Route::post('/user/me/setting','\App\Http\Controllers\UserController@settingStore');
    //  登出行为
    Route::get('/logout','\App\Http\Controllers\LoginController@logout');

    //  通知
    Route::get('/notices','\App\Http\Controllers\NoticeController@index');


//  文章模块
    //  文章搜索
    Route::get('/posts/search', '\App\Http\Controllers\PostController@search');
    //  赞
        Route::get('/posts/{post}/zan', '\App\Http\Controllers\PostController@zan');
    //  取消赞
        Route::get('/posts/{post}/unzan', '\App\Http\Controllers\PostController@unzan');
    //  文章评论提交
        Route::post('/posts/{post}/comment', '\App\Http\Controllers\PostController@comment');
    //  文章列表页路由
        Route::get('/posts', '\App\Http\Controllers\PostController@index');
    //  创建文章页面
        Route::get('/posts/create', '\App\Http\Controllers\PostController@create');
    //  文章详情页路由 使用绑定模型
        Route::get('/posts/{post}', '\App\Http\Controllers\PostController@show');
    //  创建文章行为
        Route::post('/posts', '\App\Http\Controllers\PostController@store');
    //  编辑文章
        Route::get('/posts/{post}/edit', '\App\Http\Controllers\PostController@edit');
    //  更新编辑后文章的行为
        Route::put('/posts/{post}', '\App\Http\Controllers\PostController@update');
    //  删除文章
        Route::get('/posts/{post}/delete', '\App\Http\Controllers\PostController@delete');
    //  编辑器图片上传
        Route::post('/post/image/upload','\App\Http\Controllers\PostController@imageUpload');

//  专题
    //  专题详情页
        Route::get('/topic/{topic}', '\App\Http\Controllers\TopicController@show');
    //  专题投稿
        Route::post('/topic/{topic}/submit', '\App\Http\Controllers\TopicController@submit');
});

//  用户模块
//  注册页面
Route::get('/register','\App\Http\Controllers\RegisterController@index');
//  注册行为
Route::post('/register','\App\Http\Controllers\RegisterController@register');
//  登录页面
Route::get('/login','\App\Http\Controllers\LoginController@index')->name('login');
//  登录行为
Route::post('/login','\App\Http\Controllers\LoginController@login');

//注册默认url
//Route::get('/',function(){return redirect('posts');});
Route::get('/','\App\Http\Controllers\LoginController@welcome');

//引入后台路由文件
//include_once ('admin.php');

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
//使用Gate进行系统通知权限管理
        Route::group(['middleware'=>'can:notice'],function() {
            //专题模块路由使用resource
            Route::resource('notices','\App\Admin\Controllers\NoticeController',['only'=>[
                'index','create','store']]);
            /*因为这里使用了resource的路由定义方法 所以系统默认帮我们开启了所有方法 在不需要某些方法的情况下
            我们使用resource的第三个参数来限制只使用哪些操作
            */
        });
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