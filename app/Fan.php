<?php

namespace App;
//修改继承关系
use App\Model;
class Fan extends Model
{
    // 获取我的粉丝
    public function fuser(){
        return $this->hasOne(\App\User::class, 'id', 'fan_id');
    }
    //获取我关注的人
    public function suser(){
        return $this->hasOne(\App\User::class, 'id', 'star_id');
    }
}
