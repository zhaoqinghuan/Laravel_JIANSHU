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
//文章列表页路由
Route::get('/posts', '\App\Http\Controllers\PostController@index');
//创建文章页面
Route::get('/posts/create', '\App\Http\Controllers\PostController@create');
//文章详情页路由 使用绑定模型
Route::get('/posts/{post}', '\App\Http\Controllers\PostController@show');
//创建文章行为
Route::post('/posts', '\App\Http\Controllers\PostController@store');
//编辑文章
Route::get('/posts/{post}/edit', '\App\Http\Controllers\PostController@edit');
//更新编辑后文章的行为
Route::put('/posts/{post}', '\App\Http\Controllers\PostController@update');
//删除文章
Route::get('/posts/{post}/delete', '\App\Http\Controllers\PostController@delete');