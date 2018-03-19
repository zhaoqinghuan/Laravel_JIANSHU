<?php

namespace App;
//  修改其继承模型基类
use App\Model;
class AdminPermission extends Model
{
    //指定模型文件对应的数据表
    protected $table = "admin_permissions";

    //  权限属于哪个角色
    public function roles(){
        //  权限和角色是多对多关系使用belongsToMany，第一个参数对应模型文件，第二个参数关联关系存放表，第三个是当前表在关系表中的外键
        //  第四个参数是对方表在关联表中的外键 使用withPivot将关系表中的内容也获取出来
        return $this->belongsToMany(\App\AdminRole::class, 'admin_permission_role',
            'role_id', 'permission_id')->withPivot(['permission_id', 'role_id']);
    }
}
