<?php

namespace App;
//  修改其继承模型基类
use App\Model;
class AdminRole extends Model
{
    //  指定模型文件对应的数据表
    protected $table = "admin_roles";
    
    
    //  获取当前角色的所有权限
    public function permissions(){
        return $this->belongsToMany(\App\AdminPermission::class,
            'admin_permission_role', 'permission_id', 'role_id')
            ->withPivot(['permission_id', 'role_id']);
    }

    //  给角色赋予权限
    public function grantPermission($permission){
        //  当前方法调用获取角色权限的方法直接执行写入操作
        return $this->permissions()->save($permission);
    }

    //  取消角色赋予的权限
    public function deletePermission($permission){
        //  当前方法直接调用获取角色权限的方法直接在角色和权限的关联表中删除这个关联关系
        return $this->permissions()->detach($permission);
    }

    //  判断当前角色是否具有权限
    public function hasPermission($permission){
        //  调用查看当前角色的权限
        return $this->permissions->contains($permission);
    }
}
