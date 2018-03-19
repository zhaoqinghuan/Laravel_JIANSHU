<?php

namespace App;

// 修改为引入自定义的模型基类
use App\Model;
//因为这个模型需要做后台注册用户的注册认证 所以必须要继承这个基类
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminUser extends Authenticatable
{
    //  在模型文件中重写规则
    //  protected $rememberTokenName = 'remember_token';
    protected $rememberTokenName = '';

    //  修改模型文件的注入字段限制
    protected $guarded = [];

    //  用户有哪些角色
    public function roles(){
        return $this->belongsToMany(\App\AdminRole::class,
            'admin_role_user', 'user_id', 'role_id')
            ->withPivot(['user_id', 'role_id']);
        //  用户和角色是多对多关系使用belongsToMany，第一个参数对应模型文件，第二个参数关联关系存放表，第三个是当前表在关系表中的外键
        //  第四个参数是对方表在关联表中的外键 使用withPivot将关系表中的内容也获取出来
    }

    //  判断用户是否具有某个角色
    public function isInRoles($roles){
        //  查询当前用户的某一橘色在角色表中的角色是否存在使用count查询
        //  使用!!在count查询后返回布尔值
        return !! $roles->intersect($this->roles)->count();
    }

    //  给用户分配角色
    public function assignRole($role){
        //  直接调用角色表给用户添加一个权限
        return $this->roles()->save($role);
    }

    //  取消用户的某一角色
    public function deleteRole($role){
        //  直接调用角色表删除角色和用户关联表中的关联关系
        return $this->roles()->detach($role);
    }

    //  用户是否具有权限
    public function hasPermission($permission){
        //  判断当前用户是否有权限只需要去查询当前用户的角色是否和目标权限之间有关联关系
        return $this->isInRoles($permission->roles);
    }
}
