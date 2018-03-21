<?php
namespace App\Admin\Controllers;
use Illuminate\Http\Request;
class RoleController extends Controller
{
    //  角色列表
    public function index(){
        $roles = \App\AdminRole::paginate(10);
        return view('admin.role.index',compact('roles'));
    }

    //  创建角色页面
    public function create(){
        return view('admin.role.add');
    }

    //  创建角色行为
    public function store(){
        //  验证
        $this->validate(\request(),[
            'name' => 'required|min:3',
            'description' => 'required'
        ]);
        //  逻辑
        \App\AdminRole::create(\request(['name','description']));
        //  渲染
        return redirect('/admin/roles');//  跳转回角色列表页
    }

    //  角色和权限关系页
    public function permission(\App\AdminRole $role){//参数绑定所有在路由中有进行参数绑定的方法都需要进行参数绑定
        //  获取所有权限
        $permissions = \App\AdminPermission::all();
        //  获取当前角色的权限
        $myPermissions = $role->permissions;
        return view('admin.role.permission',
            compact('permissions','myPermissions','role'));
    }
    //  角色和权限关系行为
    public function storePermission(\App\AdminRole $role){//参数绑定
        //  验证
        $this->validate(\request(),[
            'permissions'=>'required|array'
        ]);
        //  逻辑
        $permissions = \App\AdminPermission::findMany(\request('permissions'));
        $myPermissions = $role->permissions;

        //      新增权限部分
        $addPermissions = $permissions->diff($myPermissions);
        foreach ($addPermissions as $permission){
            $role->grantPermission($permission);
        }
        //      删除权限部分
        $deletePermissions = $myPermissions->diff($permissions);
        foreach ( $deletePermissions as $permission){
            $role->deletePermission($permissions);
        }
        //  渲染
        return back();
    }
}