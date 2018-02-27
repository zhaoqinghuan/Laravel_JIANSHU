<?php

namespace App;

use App\Model;

//默认指定Xxxs表
class Post extends Model
{
    //手动指定表
    //protected $table = "xxxx";

    //指定不可以使用数组注入哪些字段
    //protected $guarded = [];
    //指定可以使用数组注入哪些字段
    //protected $fillable = ['title','content'];

}
