<?php
namespace App\Admin\Controllers;
class LoginController extends Controller{
    //  登出行为
    public function logout(){
        //  使用组件完成登出行为
        \Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }
    //  登录页面
    public function index(){
        return view('admin.login.index');
    }
    //  登录行为
    public function login(){
        //  验证
        $this->validate(\request(),[
            'name' => 'required|min:2',
            //  验证表单提交过来的账户名 满足必填，最短2位
            'password' => 'required|min:5|max:10',
            //  验证表单提交过来的密码 满足必填，最短5位最长10位，两次填写必须一致
        ],[
            'name.required'=>'账户名必须填写',
            'name.min'=>'账户名最短2位',
            'password.required'=>'密码必须填写',
            'password.min'=>'密码最短填写5位',
            'password.max'=>'密码最长填写10位',
        ]);
        //  逻辑
        $user = \request(['name','password']);
        if(\Auth::guard("admin")->attempt($user)){
            //  使用Auth组件下guard定义为admin的部分来进行登录操作
            return redirect('/admin/home');
            //  登录成功跳转到后台首页
        }else{
            return \Redirect::back()->withErrors('账户及密码不匹配，请核对！');
            //  登录失败重定位到上一页 并提示用户名或密码填写错误
        }
    }
}