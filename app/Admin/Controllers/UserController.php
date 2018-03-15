<?php
namespace App\Admin\Controllers;
//  引入模型文件
use App\AdminUser;
class UserController extends Controller {
    //  管理员列表
    public function index(){
        //  应用模型文件中的方法获取出管理员列表 每页展示10条
        $users = AdminUser::paginate(10);
        return view('admin.user.index',compact('users'));
    }
    //  管理人员添加静态页
    public function create(){
        return view('admin.user.add');
    }
    //  管理人员添加逻辑页
    public function store(){
        //  验证
        $this->validate(request(),[
            'name' => 'required|min:3',
            'password' => 'required'
        ],[
            'name.required'=>'用户名必须填写',
            'name.min'=>'用户名最短3个字符',
            'password.required'=>'密码必须填写',
        ]);
        //  逻辑
        $name = request('name');//用户名
        $password = bcrypt(request('password'));//使用bcrypt加密后的密码
        AdminUser::create(compact('name','password'));//使用模型进行创建操作
        //  渲染
        return redirect("/admin/users");
    }
}