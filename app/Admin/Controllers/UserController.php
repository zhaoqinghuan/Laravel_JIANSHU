<?php
namespace App\Admin\Controllers;
//  引入模型文件
use App\AdminUser;
class UserController extends Controller {
    //  用户角色页面
    public function role(\App\AdminUser $user){ //因为路由中有参数绑定所以这里进行路由绑定
        //所有角色查询并展示
        $roles = \App\AdminRole::all();
        //我的角色查询并展示
        $myRoles = $user->roles;
        return view('admin.user.role',compact('roles','myRoles','user'));
    }
    //  用户角色储存
    public function storeRole(\App\AdminUser $user){ //因为路由中有参数绑定所以这里进行路由绑定
        //  验证
        $this->validate(request(),[
            'roles'=>'required|array'
        ]);
        //  处理
        //      获取当前用户传递上来的角色
        $roles = \App\AdminRole::findMany(request('roles'));
        //      当前用户的角色
        $myRoles = $user->roles;
        //      要增加的角色
        $addRoles = $roles->diff($myRoles);//使用diff方法取在roles中却不在myRoles中的值
        foreach ($addRoles as $role){
            $user->assignRole($role);
            //执行存储
        }
        //      要删除的角色
        $delRoles = $myRoles->diff($roles);//使用diff方法取在myRoles中却不在roles中的值
        foreach ($delRoles as $role){
            $user->deleteRole($role);
            //执行删除
        }
        //  渲染
        return back();
    }
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