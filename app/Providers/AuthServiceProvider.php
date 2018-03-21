<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        //'App\Model' => 'App\Policies\ModelPolicy',
        //将策略类与模型文件相关联
        'App\Post' => 'App\Policies\PostPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        //  注册Gate
        $permissions = \App\AdminPermission::all();
            //  先获取数据表中的所有的权限关联关系
        foreach ($permissions as $permission){
            Gate::define($permission->name,function($user) use($permission){
                //  循环出每一个权限关联关系 注册Gate的时候使用权限关联关系的名称作为Gate的名称
                //  匿名函数需要传入当前登录的用户信息 以及当前的权限关联关系
                return $user->hasPermission($permission);
                //  返回当前用户是否具有这个权限
            });
        }
    }
}



















