<?php
namespace App\Admin\Controllers;
use Illuminate\Http\Request;
class PermissionController extends Controller
{
    //  权限列表页
    public function index(){
        //获取所有的权限
        $permissions = \App\AdminPermission::paginate(10);
        return view('admin.permission.index',compact('permissions'));
    }
    //  权限创建页
    public function create(){
        return view('admin.permission.add');
    }
    //  创建权限行为
    public function store(){
        //  验证
        $this->validate(\request(),[
           'name'=>'required|min:3',
            'description' => 'required'
        ]);
        //  逻辑
        \App\AdminPermission::create(\request(['name','description']));
        //  渲染
        return redirect('/admin/permissions');
    }
}