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
Route::get('/',function(){return redirect('posts');});