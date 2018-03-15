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
}
