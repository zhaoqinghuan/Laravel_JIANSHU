<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    //  注册页面
    public function index(){
        return view('register.index');
    }

    //  注册行为
    public function register(){
        //验证
        $this->validate(\request(),[
            'name'=>'required|min:3|unique:users,name',
            //验证表单提交过来的用户名 满足必填，最短三位，在users表中的name字段必须唯一
        ]);
        //逻辑
        //渲染
    }


}
