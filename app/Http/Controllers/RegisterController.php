<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class RegisterController extends Controller
{
    //  注册行为
    public function register(){
        //验证
        $this->validate(\request(),[
            'name'      =>  'required|min:3|unique:users,name',
            //验证表单提交过来的账户名 满足必填，最短三位，在users表中的name字段必须唯一
            'email'     =>  'required|unique:users,email|email',
            //验证表单提交过来的邮箱 满足必填，在users表中的email字段必须唯一, 符合email格式
            'password'  =>  'required|min:5|max:10|confirmed'
            //验证表单提交过来的密码 满足必填，最短5位最长10位，两次填写必须一致
        ],[
            'name.required'=>'账户名必须填写',
            'name.min'=>'账户名最短填写三位',
            'name.unique'=>'该账户名已注册',
            'email.required'=>'邮箱必须填写',
            'email.unique'=>'该邮箱已注册',
            'email.email'=>'请输入正确的邮箱格式',
            'password.required'=>'密码必须填写',
            'password.min'=>'密码最短填写5位',
            'password.max'=>'密码最长填写10位',
            'password.confirmed'=>'很抱歉，两次密码填写必须一致',
        ]);

        //逻辑    提取验证过后的数据存储到数据表中
        $name = \request('name');
        $email = \request('email');
        $password = bcrypt(\request('password'));//使用bcrypt()方法将密码进行加密
        $user = User::create(compact('name','email','password'));
        //渲染    注册成功导向到登录页面去
        return redirect('/login');
    }

    //  注册页面
    public function index(){
        return view('register.index');
    }
}
