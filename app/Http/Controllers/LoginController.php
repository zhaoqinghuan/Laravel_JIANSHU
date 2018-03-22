<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //  WelCome
    public function welcome(){
        return redirect('/login');
    }

    //  登录页面
    public function index(){
        //判断当前是否登录 如果已经登录跳转到文章列表页
        if(\Auth::check()){
            return redirect('/posts');
        }
        return view('login.index');
    }

    //  登出行为
    public function logout(){
        //  Auth门脸类的登出方法
        \Auth::logout();
        //  页面重定向到登录页面
        return redirect('/login');
    }

    //  登录行为
    public function login(){
        //  验证
        $this->validate(\request(),[
            'email' => 'required|email',
            //验证表单提交过来的邮箱 满足必填，在users表中的email字段必须唯一, 符合email格式
            'password' => 'required|min:5|max:10',
            //验证表单提交过来的密码 满足必填，最短5位最长10位，两次填写必须一致
            'is_remember' => 'integer'
            //验证是否记住密码单选框是否被选择中 用int类型进行判断
        ],[
            'email.required'=>'邮箱必须填写',
            'email.email'=>'请输入正确的邮箱格式',
            'password.required'=>'密码必须填写',
            'password.min'=>'密码最短填写5位',
            'password.max'=>'密码最长填写10位',
        ]);
        //  逻辑
        //获取表单提交过来的用户名和密码信息
        $user = \request(['email','password']);
        //获取表单提交过来的是否记住密码信息
        $is_remember = boolval(\request(['is_remember']));
        //登录    Auth门脸类的登录方法 第一个参数代表提交过来的账户密码信息 第二个参数代表是否记住当前登录用户信息
        if(\Auth::attempt($user,$is_remember)){
            //登录成功跳转到文章列表页
            return redirect('/posts');
        }else{
            //登录失败重定位到上一页 并提示用户名或密码填写错误
            return \Redirect::back()->withErrors('邮箱及密码不破匹配，请核对！');
        }
    }
}
