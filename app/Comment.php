<?php

namespace App;

use App\Model;

class Comment extends Model
{
    // 创建评论所属文章的一对多反向模型
    public function post(){
        return $this->belongsTo('App\Post');
    }

    // 创建评论所属用户的一对多反向模型
    public function user(){
        return $this->belongsTo('App\User');
    }
}
